<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class WelcomeController extends Controller
{
    public function __invoke(): Response
    {
        $popularGames = Product::query()
            ->where('is_maintenance', false)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->limit(11)
            ->get()
            ->map(fn (Product $product) => [
                'id' => $product->voca_product_id,
                'name' => $product->title,
                'image' => $product->logo_url,
                'badge' => $product->is_featured ? 'Populer' : '',
                'badgeStyle' => $product->is_featured ? 'bg-orange-500' : '',
            ]);

        return Inertia::render('Welcome', [
            'appName' => 'WarGame',
            'message' => 'Marketplace game top up dan voucher digital dengan tampilan premium dark.',
            'popularGames' => $popularGames,
        ]);
    }
}
