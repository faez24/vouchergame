<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function __construct(private readonly CheckoutService $checkout) {}

    public function show(Request $request)
    {
        $batchId = $request->query('batch');
        abort_if(! $batchId, 404);

        $transactions = $this->checkout->batchTransactions($batchId);
        abort_if($transactions->isEmpty(), 404);

        $snapToken = null;
        $first = $transactions->first();

        if (! $first->midtrans_order_id && $first->payment_status === Transaction::PAYMENT_WAITING) {
            $snap = $this->checkout->createSnapForBatch($batchId);
            $snapToken = $snap['snap_token'];
        }

        return Inertia::render('Checkout', [
            'batchId' => $batchId,
            'items' => $transactions->map(fn (Transaction $t) => [
                'name' => $t->product_item_name,
                'price' => $t->total_amount,
            ]),
            'total' => $transactions->sum('total_amount'),
            'paymentStatus' => $first->payment_status,
            'snapToken' => $snapToken,
            'clientKey' => config('services.midtrans.client_key'),
            'isProduction' => config('services.midtrans.is_production'),
        ]);
    }

    public function status(string $batch)
    {
        $transactions = $this->checkout->batchTransactions($batch);
        abort_if($transactions->isEmpty(), 404);

        return response()->json([
            'paymentStatus' => $transactions->first()->payment_status,
            'items' => $transactions->map(fn (Transaction $t) => [
                'name' => $t->product_item_name,
                'invoiceId' => $t->invoice_id,
                'fulfillmentStatus' => $t->status,
                'granted' => $t->granted_at !== null,
            ]),
        ]);
    }
}
