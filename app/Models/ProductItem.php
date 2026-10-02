<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductItem extends Model
{
    protected $fillable = [
        'product_id',
        'voca_item_id',
        'name',
        'price',
        'icon_url',
        'variant_name',
        'is_active',
        'is_maintenance',
        'voucher_stock',
        'sort_order',
        'synced_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_maintenance' => 'boolean',
        'synced_at' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
