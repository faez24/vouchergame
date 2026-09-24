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

    private function snapBaseUrl(): string
    {
        return $this->isProduction
            ? 'https://app.midtrans.com'
            : 'https://app.sandbox.midtrans.com';
    }
}
