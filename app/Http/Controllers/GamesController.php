<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GamesController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $categorySlug = $request->query('category');

        $games = Product::query()
            ->when($categorySlug, fn ($query) => $query->whereHas(
                'category',
                fn ($q) => $q->where('slug', $categorySlug)
            ))
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
            'categories' => Category::orderBy('name')->get(['name', 'slug']),
            'activeCategory' => $categorySlug,
        ]);
    }
}
