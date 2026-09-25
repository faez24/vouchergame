<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $staticUrls = [
            ['loc' => url('/'), 'priority' => '1.0'],
            ['loc' => url('/games'), 'priority' => '0.8'],
            ['loc' => url('/voucher'), 'priority' => '0.6'],
        ];

        $productUrls = Product::query()
            ->where('is_maintenance', false)
            ->get()
            ->map(fn (Product $product) => [
                'loc' => url("/topup/{$product->voca_product_id}"),
                'priority' => '0.7',
                'lastmod' => optional($product->updated_at)->toAtomString(),
            ]);

        $urls = collect($staticUrls)->concat($productUrls);

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
