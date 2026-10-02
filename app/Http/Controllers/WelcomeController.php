<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class WelcomeController extends Controller
{
    /**
     * voca_product_id of the games to feature in the flash sale rail
     * (Valorant, Mobile Legends, Free Fire).
     */
    private const FLASH_SALE_PRODUCT_IDS = [84, 15, 1];

    public function __invoke(): Response
    {
        $flashDeals = Product::query()
            ->whereIn('voca_product_id', self::FLASH_SALE_PRODUCT_IDS)
            ->with(['items' => function ($query) {
                $query->where('is_active', true)
                    ->where('is_maintenance', false)
                    ->where('voucher_stock', '>', 0)
                    ->orderBy('price')
                    ->limit(1);
            }])
            ->get()
            ->sortBy(fn (Product $product) => array_search($product->voca_product_id, self::FLASH_SALE_PRODUCT_IDS))
            ->values()
            ->map(function (Product $product) {
                $item = $product->items->first();

                return $item ? [
                    'id' => $product->voca_product_id,
                    'title' => $product->title,
                    'subtitle' => $item->name,
                    'price' => $item->price,
                    'image' => $product->logo_url,
                ] : null;
            })
            ->filter()
            ->values();

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

        $entertainmentProducts = Product::query()
            ->whereHas('category', fn ($q) => $q->where('slug', 'entertainment'))
            ->where('is_maintenance', false)
            ->orderBy('sort_order')
            ->limit(5)
            ->get()
            ->map(fn (Product $product) => $this->toCard($product));

        $newestProducts = Product::query()
            ->where('is_maintenance', false)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get()
            ->map(fn (Product $product) => $this->toCard($product, 'Baru', 'bg-green-500'));

        $voucherProducts = Product::query()
            ->whereHas('category', fn ($q) => $q->where('slug', 'voucher'))
            ->where('is_maintenance', false)
            ->orderBy('sort_order')
            ->limit(5)
            ->get()
            ->map(fn (Product $product) => $this->toCard($product));

        $categories = Category::query()
            ->withCount('products')
            ->with(['products' => function ($query) {
                $query->whereNotNull('logo_url')
                    ->orderByDesc('is_featured')
                    ->orderBy('sort_order')
                    ->limit(1);
            }])
            ->having('products_count', '>', 0)
            ->get()
            ->map(fn (Category $category) => [
                'slug' => $category->slug,
                'name' => $category->name,
                'count' => $category->products_count,
                'image' => $category->products->first()?->logo_url,
            ]);

        return Inertia::render('Welcome', [
            'appName' => 'WarGame',
            'message' => 'Marketplace game top up dan voucher digital dengan tampilan premium dark.',
            'popularGames' => $popularGames,
            'flashDeals' => $flashDeals,
            'categories' => $categories,
            'entertainmentProducts' => $entertainmentProducts,
            'newestProducts' => $newestProducts,
            'voucherProducts' => $voucherProducts,
        ]);
    }

    private function toCard(Product $product, string $badge = '', string $badgeStyle = ''): array
    {
        return [
            'id' => $product->voca_product_id,
            'name' => $product->title,
            'image' => $product->logo_url,
            'badge' => $badge,
            'badgeStyle' => $badgeStyle,
        ];
    }
}
