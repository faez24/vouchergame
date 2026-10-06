<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class MidtransService
{
    private string $serverKey;

    private bool $isProduction;

    public function __construct()
    {
        $this->serverKey = (string) config('services.midtrans.server_key');
        $this->isProduction = (bool) config('services.midtrans.is_production');

        if (! $this->serverKey) {
            throw new RuntimeException('Midtrans server key is not configured.');
        }
    }

    /**
     * Create a Snap transaction and return the decoded response
     * (contains at least `token` and `redirect_url`).
     */
    public function createSnapTransaction(array $payload): array
    {
        $response = Http::withBasicAuth($this->serverKey, '')
            ->acceptJson()
            ->post("{$this->snapBaseUrl()}/snap/v1/transactions", $payload);

        if ($response->failed()) {
            throw new RuntimeException(
                'Midtrans Snap error: '.($response->json('error_messages.0') ?? $response->body()),
                $response->status()
            );
        }

        return $response->json();
    }

    /**
     * Charge a QRIS payment via the Midtrans Core API and return the decoded
     * response (contains `transaction_id`, `qr_string`, `expiry_time`, …).
     */
    public function chargeQris(array $payload): array
    {
        $response = Http::withBasicAuth($this->serverKey, '')
            ->acceptJson()
            ->post("{$this->coreApiBaseUrl()}/v2/charge", [
                ...$payload,
                'payment_type' => 'qris',
                'qris' => ['acquirer' => 'gopay'],
            ]);

        if ($response->failed()) {
            throw new RuntimeException(
                'Midtrans QRIS charge error: '.($response->json('status_message') ?? $response->json('error_messages.0') ?? $response->body()),
                $response->status()
            );
        }

        return $response->json();
    }

    private function snapBaseUrl(): string
    {
        return $this->isProduction
            ? 'https://app.midtrans.com'
            : 'https://app.sandbox.midtrans.com';
    }

    private function coreApiBaseUrl(): string
    {
        return $this->isProduction
            ? 'https://api.midtrans.com'
            : 'https://api.sandbox.midtrans.com';
    }
}
