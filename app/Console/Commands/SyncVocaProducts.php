<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductItem;
use App\Services\VocaBisnisService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SyncVocaProducts extends Command
{
    protected $signature = 'app:sync-voca-products';

    protected $description = 'Sync products, categories and product items from the VocaBisnis API into the local database';

    public function handle(VocaBisnisService $voca): int
    {
        $now = now();

        $products = collect($voca->getProducts())
            ->sortBy(fn (array $productData) => $productData['sortOrder'] ?? 0)
            ->values();

        foreach ($products as $productData) {
            $categoryId = null;

            if (! empty($productData['category']['name'])) {
                $category = Category::firstOrCreate(
                    ['slug' => Str::slug($productData['category']['name'])],
                    ['name' => $productData['category']['name']]
                );
                $categoryId = $category->id;
            }

            $detail = $voca->getProductDetail($productData['id']);
            $logoUrl = $detail['logoUrl'] ?? null;

            $product = Product::updateOrCreate(
                ['voca_product_id' => $productData['id']],
                [
                    'category_id' => $categoryId,
                    'title' => $productData['title'],
                    'code' => $productData['code'] ?? null,
                    'type' => $productData['type'] ?? null,
                    'logo_url' => $logoUrl,
                    'is_maintenance' => $productData['isMaintenance'] ?? false,
                    'sort_order' => $productData['sortOrder'] ?? 0,
                    'synced_at' => $now,
                ]
            );

            $this->syncItems($voca, $product);
        }

        $this->info('VocaBisnis products synced.');

        return self::SUCCESS;
    }

    private function syncItems(VocaBisnisService $voca, Product $product): void
    {
        $now = now();
        $items = $voca->getProductItems($product->voca_product_id);

        foreach ($items as $index => $itemData) {
            ProductItem::updateOrCreate(
                ['voca_item_id' => $itemData['id']],
                [
                    'product_id' => $product->id,
                    'name' => $itemData['name'],
                    'price' => $itemData['price'],
                    'icon_url' => $itemData['iconUrl'] ?? null,
                    'variant_name' => $itemData['variant']['name'] ?? null,
                    'is_active' => $itemData['isActive'] ?? true,
                    'is_maintenance' => $itemData['isMaintenance'] ?? false,
                    'voucher_stock' => $itemData['voucherStock'] ?? 0,
                    'sort_order' => $index,
                    'synced_at' => $now,
                ]
            );
        }
    }
}
