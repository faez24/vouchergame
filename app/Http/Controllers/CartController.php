<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private readonly CheckoutService $checkout) {}

    /**
     * Create a bulk payment batch from the items the client selected in the cart.
     *
     * NOTE: the cart's current "add to cart" storage (resources/js/Pages/Cart.jsx,
     * localStorage `gv_cart`) does not yet persist `product_id`/`product_item_id`
     * per item — only display fields. Whatever writes to `gv_cart` must be updated
     * to include both, otherwise this validation will reject the request.
     */
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer'],
            'items.*.product_item_id' => ['required', 'integer'],
            'items.*.user_id_ingame' => ['nullable', 'string'],
            'items.*.zone_id' => ['nullable', 'string'],
        ]);

        $transactions = $this->checkout->createBulkBatch($validated['items'], $request->user()?->id);

        return redirect()->route('checkout', ['batch' => $transactions->first()->batch_id]);
    }
}
