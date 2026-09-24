<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentNotification extends Model
{
    protected $fillable = [
        'midtrans_order_id',
        'batch_id',
        'transaction_status',
        'payment_type',
        'fraud_status',
        'gross_amount',
        'raw_payload',
        'signature_valid',
        'received_at',
        'processed_at',
        'processing_result',
        'processing_error',
    ];

    protected function casts(): array
    {
        return [
            'raw_payload' => 'array',
            'signature_valid' => 'boolean',
            'received_at' => 'datetime',
            'processed_at' => 'datetime',
        ];
    }
}
