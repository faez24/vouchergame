<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'batch_id',
        'item_index',
        'kategori_pembelian',
        'batch_name',
        'reference',
        'invoice_id',
        'product_id',
        'product_item_id',
        'product_name',
        'product_item_name',
        'total_amount',
        'status',
        'payment_status',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'payment_type',
        'paid_at',
        'granted_at',
        'data',
        'sn',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'paid_at' => 'datetime',
            'granted_at' => 'datetime',
        ];
    }

    public const PAYMENT_WAITING = 'WAITING';

    /** Midtrans capture (kartu kredit, pre-fraud-check). */
    public const PAYMENT_VERIFY = 'VERIFY';

    public const PAYMENT_SUCCESS = 'SUCCESS';

    public const PAYMENT_FAILED = 'FAILED';

    public const PAYMENT_EXPIRED = 'EXPIRED';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
