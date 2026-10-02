<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'voca_product_id',
        'title',
        'code',
        'type',
        'logo_url',
        'is_maintenance',
        'is_featured',
        'sort_order',
        'synced_at',
    ];

    protected $casts = [
        'is_maintenance' => 'boolean',
        'is_featured' => 'boolean',
        'synced_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ProductItem::class);
    }
}
