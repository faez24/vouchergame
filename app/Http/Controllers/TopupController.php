<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\VocaBisnisService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopupController extends Controller
{
    public function __construct(private readonly VocaBisnisService $vocaBisnis) {}

    public function show(int $productId)
    {
        $product = $this->vocaBisnis->getProductDetail($productId);
        $items = $this->vocaBisnis->getProductItems($productId);

        return view('topupgame.topupml', compact('product', 'items'));
    }

    public function store(Request $request, int $productId)
    {
        $validated = $request->validate([
            'product_item_id' => ['required', 'integer'],
            'user_id_ingame' => ['nullable', 'string'],
            'zone_id' => ['nullable', 'string'],
        ]);

        $items = $this->vocaBisnis->getProductItems($productId);
        $item = collect($items)->firstWhere('id', $validated['product_item_id']);

        abort_if(! $item, 422, 'Item tidak ditemukan.');

        $reference = (string) Str::uuid();

        $result = $this->vocaBisnis->createTransaction([
            'productId' => $productId,
            'productItemId' => $validated['product_item_id'],
            'data' => array_filter([
                'userId' => $validated['user_id_ingame'] ?? null,
                'zoneId' => $validated['zone_id'] ?? null,
            ]),
            'price' => $item['price'],
            'clientIp' => $request->ip(),
            'reference' => $reference,
            'callbackUrl' => route('vocabisnis.callback'),
        ]);

        $transaction = Transaction::create([
            'user_id' => $request->user()?->id,
            'reference' => $result['reference'],
            'invoice_id' => $result['invoiceId'],
            'product_id' => $productId,
            'product_item_id' => $validated['product_item_id'],
            'product_name' => $result['productName'] ?? null,
            'product_item_name' => $result['productItemName'] ?? null,
            'total_amount' => $result['totalAmount'],
            'status' => 'Processing',
            'data' => $result['data'] ?? null,
            'sn' => $result['sn'] ?? null,
        ]);

        return redirect()->route('transaction.show', $transaction->invoice_id);
    }
}
