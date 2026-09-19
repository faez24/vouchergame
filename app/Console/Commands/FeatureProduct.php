<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class FeatureProduct extends Command
{
    protected $signature = 'app:feature-product {title? : Partial title to search for} {--off : Unfeature instead of feature} {--list : List currently featured products}';

    protected $description = 'Mark (or unmark) a product as featured on the homepage "Game Populer" rail';

    public function handle(): int
    {
        if ($this->option('list')) {
            Product::where('is_featured', true)->orderBy('sort_order')->get(['id', 'title'])
                ->each(fn (Product $p) => $this->line("#{$p->id}  {$p->title}"));

            return self::SUCCESS;
        }

        $title = $this->argument('title');

        if (! $title) {
            $this->error('Provide a product title to search for, or use --list.');

            return self::FAILURE;
        }

        $matches = Product::where('title', 'like', "%{$title}%")->get();

        if ($matches->isEmpty()) {
            $this->error("No product found matching \"{$title}\".");

            return self::FAILURE;
        }

        if ($matches->count() > 1) {
            $this->warn('Multiple matches found, be more specific:');
            $matches->each(fn (Product $p) => $this->line("#{$p->id}  {$p->title}"));

            return self::FAILURE;
        }

        $product = $matches->first();
        $product->update(['is_featured' => ! $this->option('off')]);

        $this->info(($this->option('off') ? 'Unfeatured: ' : 'Featured: ').$product->title);

        return self::SUCCESS;
    }
}
