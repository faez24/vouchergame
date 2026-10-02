<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MidtransWebhookController extends Controller
{
    public function __construct(private readonly CheckoutService $checkout) {}

    /**
     * Menerima notification Midtrans yang sudah diverifikasi dan di-forward
     * oleh centralized payment service DigiLabs (servicedigilab).
     *
     * Flow: Midtrans → servicedigilab (verify SHA-512) → POST /api/payment/midtrans/update
     *
     * Endpoint ini diamankan dengan X-API-KEY yang berbeda dari Midtrans Server Key.
     * Signature verification Midtrans adalah TANGGUNG JAWAB servicedigilab, bukan endpoint ini.
     */
    public function __invoke(Request $request)
    {
        $expected = config('services.midtrans.webhook_api_key');

        if (! $expected) {
            return response()->json(['message' => 'Webhook is not configured'], Response::HTTP_SERVICE_UNAVAILABLE);
        }

        $provided = (string) $request->header('X-API-KEY', '');

        if (! hash_equals($expected, $provided)) {
            return response()->json(['message' => 'Invalid API key'], Response::HTTP_UNAUTHORIZED);
        }

        $payload = $request->validate([
            'order_id'           => ['required', 'string'],
            'transaction_id'     => ['nullable', 'string'],
            'transaction_status' => ['required', 'string'],
            'payment_type'       => ['nullable', 'string'],
            'fraud_status'       => ['nullable', 'string'],
            'gross_amount'       => ['required'],
        ]);

        $outcome = $this->checkout->handleNotification($payload);

        return response()->json(['message' => $outcome['message']], $outcome['http']);
    }
}
