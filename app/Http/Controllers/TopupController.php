<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\VocaBisnisService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TopupController extends Controller
{
    public function __construct(private readonly VocaBisnisService $vocaBisnis) {}

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

        $product = $this->vocaBisnis->getProductDetail($productId);
        $items = $this->vocaBisnis->getProductItems($productId);
        $item = collect($items)->firstWhere('id', $validated['product_item_id']);

        abort_if(! $item, 422, 'Item tidak ditemukan.');

        // PENTING: belum panggil VocaBisnisService::createTransaction() di sini.
        // Alur pembayaran (Midtrans) belum terpasang di branch ini, jadi transaksi
        // cuma disimpan lokal berstatus "Pending Payment" dulu — VocaBisnis (yang
        // benar-benar mengirim diamond) baru boleh dipanggil SETELAH pembayaran
        // dikonfirmasi. Jangan panggil createTransaction sebelum itu terpasang.
        $transaction = Transaction::create([
            'user_id' => $request->user()?->id,
            'reference' => (string) Str::uuid(),
            'invoice_id' => null,
            'product_id' => $productId,
            'product_item_id' => $validated['product_item_id'],
            'product_name' => $product['title'] ?? null,
            'product_item_name' => $item['name'] ?? null,
            'total_amount' => $item['price'],
            'status' => 'Pending Payment',
            'data' => array_filter([
                'userId' => $validated['user_id_ingame'] ?? null,
                'zoneId' => $validated['zone_id'] ?? null,
            ]),
        ]);

        return redirect()->route('transaction.show', $transaction->reference);
    }
}
