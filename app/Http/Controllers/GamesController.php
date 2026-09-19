<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class GamesController extends Controller
{
    public function __invoke(): Response
    {
        $games = Product::query()
            ->orderBy('sort_order')
            ->get()
            ->map(fn (Product $product) => [
                'id' => $product->voca_product_id,
                'name' => $product->title,
                'image' => $product->logo_url,
                'badge' => $product->is_featured ? 'Populer' : '',
                'badgeStyle' => $product->is_featured ? 'bg-orange-500' : '',
            ]);

        return Inertia::render('Games', [
            'games' => $games,
        ]);
    }
}
