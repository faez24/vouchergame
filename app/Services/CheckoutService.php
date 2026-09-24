<?php

namespace App\Services;

use App\Models\PaymentNotification;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class CheckoutService
{
    /** @var array<int, array<int, string>> per-product required userInput field names, memoized per request. */
    private array $requiredFieldCache = [];

    public function __construct(
        private readonly VocaBisnisService $vocaBisnis,
        private readonly MidtransService $midtrans,
    ) {}

    /**
     * Create a single-item pending payment batch (Topup flow).
     */
    public function createIndividualBatch(int $productId, int $productItemId, array $data, ?int $userId): Transaction
    {
        $resolved = $this->resolveLocalItem($productId, $productItemId);
        $this->assertAccountData($productId, $data);

        return Transaction::create([
            'user_id' => $userId,
            'batch_id' => 'IND-'.(string) Str::uuid(),
            'item_index' => 0,
            'kategori_pembelian' => 'individu',
            'batch_name' => 'Individual Order',
            'reference' => (string) Str::uuid(),
            'product_id' => $productId,
            'product_item_id' => $productItemId,
            'product_name' => $resolved['product']->title,
            'product_item_name' => $resolved['item']->name,
            'total_amount' => $resolved['item']->price,
            'status' => 'Pending',
            'payment_status' => Transaction::PAYMENT_WAITING,
            'data' => array_filter($data),
        ]);
    }

    /**
     * Create a multi-item pending payment batch (Cart flow).
     *
     * @param  array<int, array{product_id:int, product_item_id:int, user_id_ingame?:string, zone_id?:string}>  $items
     * @return \Illuminate\Support\Collection<int, Transaction>
     */
    public function createBulkBatch(array $items, ?int $userId): \Illuminate\Support\Collection
    {
        abort_if(empty($items), 422, 'Keranjang kosong.');

        $batchId = 'BATCH-'.(string) Str::uuid();

        $rows = collect($items)->values()->map(function (array $row, int $index) use ($batchId, $userId) {
            $productId = (int) $row['product_id'];
            $resolved = $this->resolveLocalItem($productId, (int) $row['product_item_id']);

            $data = [
                'userId' => $row['user_id_ingame'] ?? null,
                'zoneId' => $row['zone_id'] ?? null,
            ];
            $this->assertAccountData($productId, $data);

            return Transaction::create([
                'user_id' => $userId,
                'batch_id' => $batchId,
                'item_index' => $index,
                'kategori_pembelian' => 'bulk',
                'batch_name' => 'Cart Order',
                'reference' => (string) Str::uuid(),
                'product_id' => $productId,
                'product_item_id' => (int) $row['product_item_id'],
                'product_name' => $resolved['product']->title,
                'product_item_name' => $resolved['item']->name,
                'total_amount' => $resolved['item']->price,
                'status' => 'Pending',
                'payment_status' => Transaction::PAYMENT_WAITING,
                'data' => array_filter($data),
            ]);
        });

        return $rows;
    }

    public function batchTransactions(string $batchId)
    {
        return Transaction::where('batch_id', $batchId)->orderBy('item_index')->get();
    }

    /**
     * Create the Midtrans Snap transaction for a batch and stamp midtrans_order_id
     * on every row. Only callable once per batch (guarded by caller).
     */
    public function createSnapForBatch(string $batchId): array
    {
        $transactions = $this->batchTransactions($batchId);

        abort_if($transactions->isEmpty(), 404, 'Batch tidak ditemukan.');
        abort_if($transactions->contains(fn (Transaction $t) => $t->midtrans_order_id !== null), 409, 'Pembayaran untuk batch ini sudah dibuat.');

        $orderId = config('services.midtrans.order_id_prefix').$batchId;
        $grossAmount = (int) $transactions->sum('total_amount');

        $itemDetails = $transactions->map(fn (Transaction $t) => [
            'id' => (string) $t->product_item_id,
            'price' => (int) $t->total_amount,
            'quantity' => 1,
            'name' => mb_substr($t->product_item_name ?? "Item #{$t->item_index}", 0, 50),
        ])->values()->all();

        $user = $transactions->first()->user;

        $result = $this->midtrans->createSnapTransaction([
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => $itemDetails,
            'customer_details' => array_filter([
                'first_name' => $user?->name ?? 'Guest',
                'email' => $user?->email,
            ]),
        ]);

        Transaction::where('batch_id', $batchId)->update(['midtrans_order_id' => $orderId]);

        return [
            'snap_token' => $result['token'] ?? null,
            'redirect_url' => $result['redirect_url'] ?? null,
            'order_id' => $orderId,
        ];
    }

    /**
     * Handle an incoming (already API-key authenticated) Midtrans notification
     * forwarded by the centralized webhook service.
     *
     * @return array{http:int, message:string}
     */
    public function handleNotification(array $payload): array
    {
        $orderId = $payload['order_id'] ?? null;
        $grossAmount = isset($payload['gross_amount']) ? (int) round((float) $payload['gross_amount']) : null;
        $rawStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        $notification = PaymentNotification::create([
            'midtrans_order_id' => $orderId,
            'transaction_status' => $rawStatus,
            'payment_type' => $payload['payment_type'] ?? null,
            'fraud_status' => $fraudStatus,
            'gross_amount' => $grossAmount,
            'raw_payload' => $payload,
            'signature_valid' => true,
            'received_at' => now(),
        ]);

        $prefix = config('services.midtrans.order_id_prefix');

        if (! $orderId || ! str_starts_with($orderId, $prefix)) {
            $notification->update(['processed_at' => now(), 'processing_result' => 'rejected_invalid_order_id']);

            return ['http' => 422, 'message' => 'Invalid order_id prefix.'];
        }

        $mappedStatus = $this->mapMidtransStatus($rawStatus, $fraudStatus);

        if ($mappedStatus === null) {
            $notification->update(['processed_at' => now(), 'processing_result' => 'rejected_unknown_status']);

            return ['http' => 422, 'message' => 'Unknown transaction_status.'];
        }

        $statusResult = DB::transaction(function () use ($orderId, $grossAmount, $mappedStatus, $payload, $notification, $prefix) {
            $transactions = Transaction::where('midtrans_order_id', $orderId)->lockForUpdate()->orderBy('item_index')->get();

            if ($transactions->isEmpty()) {
                $notification->update(['processed_at' => now(), 'processing_result' => 'rejected_unknown_order']);

                return ['http' => 404, 'message' => 'Order not found.', 'batchId' => null];
            }

            $batchId = $transactions->first()->batch_id;
            $notification->update(['batch_id' => $batchId]);

            $expected = (int) $transactions->sum('total_amount');

            if ($grossAmount !== $expected) {
                $notification->update(['processed_at' => now(), 'processing_result' => 'rejected_amount_mismatch']);

                return ['http' => 422, 'message' => 'Amount mismatch.', 'batchId' => $batchId];
            }

            foreach ($transactions as $transaction) {
                if (in_array($transaction->payment_status, [
                    Transaction::PAYMENT_SUCCESS,
                    Transaction::PAYMENT_EXPIRED,
                    Transaction::PAYMENT_FAILED,
                ], true)) {
                    continue; // terminal state, never downgrade
                }

                $transaction->update([
                    'payment_status' => $mappedStatus,
                    'midtrans_transaction_id' => $payload['transaction_id'] ?? $transaction->midtrans_transaction_id,
                    'payment_type' => $payload['payment_type'] ?? $transaction->payment_type,
                    'paid_at' => $mappedStatus === Transaction::PAYMENT_SUCCESS ? now() : $transaction->paid_at,
                ]);
            }

            $notification->update(['processed_at' => now(), 'processing_result' => 'status_updated:'.$mappedStatus]);

            return ['http' => 200, 'message' => 'Processed.', 'batchId' => $batchId];
        });

        if ($statusResult['http'] !== 200 || $mappedStatus !== Transaction::PAYMENT_SUCCESS) {
            return $statusResult;
        }

        $grantOutcome = $this->grantBatch($statusResult['batchId']);

        if (! $grantOutcome['ok']) {
            $notification->update(['processing_error' => $grantOutcome['error']]);

            return ['http' => 500, 'message' => 'Payment recorded but fulfillment failed.'];
        }

        return ['http' => 200, 'message' => 'Processed.'];
    }

    /**
     * Grant every ungranted, paid item of a batch. Safe to call repeatedly:
     * rows with granted_at already set are skipped (idempotent per item).
     */
    private function grantBatch(string $batchId): array
    {
        $errors = [];

        DB::transaction(function () use ($batchId, &$errors) {
            $transactions = Transaction::where('batch_id', $batchId)
                ->where('payment_status', Transaction::PAYMENT_SUCCESS)
                ->whereNull('granted_at')
                ->lockForUpdate()
                ->get();

            foreach ($transactions as $transaction) {
                try {
                    $result = $this->vocaBisnis->createTransaction([
                        'productId' => $transaction->product_id,
                        'productItemId' => $transaction->product_item_id,
                        'data' => $transaction->data ?? [],
                        'price' => $transaction->total_amount,
                        'clientIp' => request()->ip() ?? '127.0.0.1',
                        'reference' => $transaction->reference,
                        'callbackUrl' => route('vocabisnis.callback'),
                    ]);

                    $transaction->update([
                        'invoice_id' => $result['invoiceId'] ?? $transaction->invoice_id,
                        'product_name' => $result['productName'] ?? $transaction->product_name,
                        'product_item_name' => $result['productItemName'] ?? $transaction->product_item_name,
                        'sn' => $result['sn'] ?? $transaction->sn,
                        'status' => 'Processing',
                        'granted_at' => now(),
                    ]);
                } catch (\Throwable $e) {
                    report($e);
                    $errors[] = "item#{$transaction->item_index}: {$e->getMessage()}";
                }
            }
        });

        return ['ok' => empty($errors), 'error' => implode('; ', $errors)];
    }

    private function mapMidtransStatus(?string $status, ?string $fraudStatus): ?string
    {
        return match ($status) {
            'pending'    => Transaction::PAYMENT_WAITING,
            'settlement' => Transaction::PAYMENT_SUCCESS,
            'capture'    => match ($fraudStatus) {
                'accept'    => Transaction::PAYMENT_SUCCESS,
                'challenge' => Transaction::PAYMENT_VERIFY,
                default     => Transaction::PAYMENT_FAILED,
            },
            'expire'  => Transaction::PAYMENT_EXPIRED,
            'deny', 'cancel', 'failure' => Transaction::PAYMENT_FAILED,
            default => null,
        };
    }

    /**
     * Resolve a product + product item from the local synced catalog (not a
     * live VocaBisnis call), and reject unavailable items. This is the
     * server-side source of truth for price — never trust price/name from
     * the client.
     *
     * @return array{product: Product, item: ProductItem}
     */
    private function resolveLocalItem(int $productId, int $productItemId): array
    {
        $product = Product::where('voca_product_id', $productId)->first();
        abort_if(! $product, 422, 'Produk tidak ditemukan.');
        abort_if($product->is_maintenance, 422, 'Produk sedang maintenance.');

        $item = ProductItem::where('product_id', $product->id)
            ->where('voca_item_id', $productItemId)
            ->first();

        abort_if(! $item, 422, 'Item tidak ditemukan.');
        abort_if(! $item->is_active, 422, 'Item tidak aktif.');
        abort_if($item->is_maintenance, 422, 'Item sedang maintenance.');
        abort_if($item->voucher_stock === 0, 422, 'Stok item habis.');

        return ['product' => $product, 'item' => $item];
    }

    /**
     * Require every account field the product declares via VocaBisnis'
     * userInput.fields spec (e.g. userId/zoneId) to be present and non-empty.
     * Not every product needs the same fields (voucher products need none),
     * so this is checked against the live spec rather than hardcoded.
     */
    private function assertAccountData(int $productId, array $data): void
    {
        foreach ($this->requiredFieldNames($productId) as $name) {
            abort_if(trim((string) ($data[$name] ?? '')) === '', 422, "Field {$name} wajib diisi.");
        }
    }

    /**
     * @return array<int, string>
     */
    private function requiredFieldNames(int $productId): array
    {
        if (! array_key_exists($productId, $this->requiredFieldCache)) {
            $detail = $this->vocaBisnis->getProductDetail($productId);
            $fields = $detail['userInput']['fields'] ?? [];

            $this->requiredFieldCache[$productId] = collect($fields)
                ->pluck('attrs.name')
                ->filter()
                ->values()
                ->all();
        }

        return $this->requiredFieldCache[$productId];
    }
}
