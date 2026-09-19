<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class VocaBisnisService
{
    private string $baseUrl;

    private string $merchantId;

    private string $secretKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.vocabisnis.base_url'), '/');
        $this->merchantId = config('services.vocabisnis.merchant_id');
        $this->secretKey = config('services.vocabisnis.secret_key');

        if (! $this->merchantId || ! $this->secretKey) {
            throw new RuntimeException('VocaBisnis merchant credentials are not configured.');
        }
    }

    public function getProducts(): array
    {
        return $this->get('/products');
    }

    public function getProductDetail(int $productId): array
    {
        return $this->get("/products/{$productId}");
    }

    public function getProductItems(int $productId): array
    {
        return $this->get("/products/{$productId}/items", "/products/{$productId}/items");
    }

    public function createTransaction(array $payload): array
    {
        $reference = $payload['reference'];

        return $this->post('/transaction', "/transaction/{$reference}", $payload);
    }

    public function getTransactionDetail(string $invoiceId): array
    {
        return $this->get("/transaction/{$invoiceId}/detail", "/transaction/{$invoiceId}/detail");
    }

    private function get(string $path, ?string $signatureEndpoint = null): array
    {
        $signature = $this->signature($signatureEndpoint ?? $path);

        $response = $this->client()->get("{$path}?signature={$signature}");

        return $this->handle($response);
    }

    private function post(string $path, string $signatureEndpoint, array $payload): array
    {
        $signature = $this->signature($signatureEndpoint);

        $response = $this->client()->post("{$path}?signature={$signature}", $payload);

        return $this->handle($response);
    }

    private function client(): PendingRequest
    {
        $client = Http::baseUrl("{$this->baseUrl}/v1/core")
            ->withHeaders(['X-Merchant' => $this->merchantId])
            ->acceptJson();

        if ($proxy = config('services.vocabisnis.proxy')) {
            $client->withOptions(['proxy' => $proxy]);
        }

        return $client;
    }

    private function signature(string $endpoint): string
    {
        return hash_hmac('sha256', $this->merchantId.$endpoint, $this->secretKey);
    }

    private function handle(\Illuminate\Http\Client\Response $response): array
    {
        if ($response->failed()) {
            throw new RuntimeException(
                'VocaBisnis API error: '.($response->json('message') ?? $response->body()),
                $response->status()
            );
        }

        return $response->json('data') ?? [];
    }
}
