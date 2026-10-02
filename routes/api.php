<?php

use App\Http\Controllers\MidtransWebhookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Internal API Routes — hanya dapat diakses oleh service internal DigiLabs
|--------------------------------------------------------------------------
|
| Endpoint ini TIDAK diakses langsung oleh user atau Midtrans.
| Midtrans → servicedigilab (verify signature) → POST /api/payment/midtrans/update
|
*/

Route::post('/payment/midtrans/update', MidtransWebhookController::class)
    ->name('api.midtrans.webhook');
