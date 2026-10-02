<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use App\Services\VocaBisnisService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TopupController extends Controller
{
    public function __construct(
        private readonly VocaBisnisService $vocaBisnis,
        private readonly CheckoutService $checkout,
    ) {}

    public function show(int $productId)
    {
        $product = $this->vocaBisnis->getProductDetail($productId);
        $items = $this->vocaBisnis->getProductItems($productId);

        return Inertia::render('Topup', compact('product', 'items'));
    }

    public function store(Request $request, int $productId)
    {
        $validated = $request->validate([
            'product_item_id' => ['required', 'integer'],
            'user_id_ingame' => ['nullable', 'string'],
            'zone_id' => ['nullable', 'string'],
        ]);

        $transaction = $this->checkout->createIndividualBatch(
            $productId,
            $validated['product_item_id'],
            [
                'userId' => $validated['user_id_ingame'] ?? null,
                'zoneId' => $validated['zone_id'] ?? null,
            ],
            $request->user()?->id,
        );

        return redirect()->route('checkout', ['batch' => $transaction->batch_id]);
    }
}
