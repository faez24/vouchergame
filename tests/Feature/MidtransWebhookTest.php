<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Services\VocaBisnisService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MidtransWebhookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.midtrans.webhook_api_key' => 'test-secret-key',
            'services.midtrans.order_id_prefix' => 'GAME-',
        ]);
    }

    private function makeBatch(string $batchId, int $price = 19500): Transaction
    {
        return Transaction::create([
            'batch_id' => $batchId,
            'item_index' => 0,
            'kategori_pembelian' => 'individu',
            'batch_name' => 'Individual Order',
            'reference' => (string) \Illuminate\Support\Str::uuid(),
            'product_id' => 15,
            'product_item_id' => 6,
            'product_item_name' => '86 Diamonds',
            'total_amount' => $price,
            'status' => 'Pending',
            'payment_status' => Transaction::PAYMENT_WAITING,
            'midtrans_order_id' => 'GAME-'.$batchId,
        ]);
    }

    public function test_missing_api_key_is_rejected(): void
    {
        $this->postJson('/payment/midtrans/update', [
            'order_id' => 'GAME-IND-1',
            'transaction_status' => 'settlement',
            'gross_amount' => 19500,
        ])->assertStatus(401);
    }

    public function test_invalid_api_key_is_rejected(): void
    {
        $this->postJson('/payment/midtrans/update', [
            'order_id' => 'GAME-IND-1',
            'transaction_status' => 'settlement',
            'gross_amount' => 19500,
        ], ['X-API-KEY' => 'wrong-key'])->assertStatus(401);
    }

    public function test_missing_webhook_config_fails_closed(): void
    {
        config(['services.midtrans.webhook_api_key' => null]);

        $this->postJson('/payment/midtrans/update', [
            'order_id' => 'GAME-IND-1',
            'transaction_status' => 'settlement',
            'gross_amount' => 19500,
        ], ['X-API-KEY' => 'anything'])->assertStatus(503);
    }

    public function test_unknown_order_id_is_rejected(): void
    {
        $this->postJson('/payment/midtrans/update', [
            'order_id' => 'GAME-does-not-exist',
            'transaction_status' => 'settlement',
            'gross_amount' => 19500,
        ], ['X-API-KEY' => 'test-secret-key'])->assertStatus(404);
    }

    public function test_amount_mismatch_is_rejected_and_status_not_changed(): void
    {
        $batch = $this->makeBatch('IND-1', 19500);

        $this->postJson('/payment/midtrans/update', [
            'order_id' => $batch->midtrans_order_id,
            'transaction_status' => 'settlement',
            'gross_amount' => 10000,
        ], ['X-API-KEY' => 'test-secret-key'])->assertStatus(422);

        $this->assertSame(Transaction::PAYMENT_WAITING, $batch->fresh()->payment_status);
    }

    public function test_unknown_status_is_rejected(): void
    {
        $batch = $this->makeBatch('IND-2', 19500);

        $this->postJson('/payment/midtrans/update', [
            'order_id' => $batch->midtrans_order_id,
            'transaction_status' => 'some_unknown_status',
            'gross_amount' => 19500,
        ], ['X-API-KEY' => 'test-secret-key'])->assertStatus(422);
    }

    public function test_settlement_transitions_to_success_and_grants_once(): void
    {
        $batch = $this->makeBatch('IND-3', 19500);

        $vocaMock = \Mockery::mock(VocaBisnisService::class);
        $vocaMock->shouldReceive('createTransaction')->once()->andReturn([
            'invoiceId' => 'ML-TEST-1',
            'productName' => 'Mobile Legend',
            'productItemName' => '86 Diamonds',
            'sn' => 'IGN: TEST. Ref: ML-TEST-1',
        ]);
        $this->app->instance(VocaBisnisService::class, $vocaMock);

        $payload = [
            'order_id' => $batch->midtrans_order_id,
            'transaction_id' => 'mt-trx-1',
            'transaction_status' => 'settlement',
            'payment_type' => 'qris',
            'gross_amount' => 19500,
        ];

        $this->postJson('/payment/midtrans/update', $payload, ['X-API-KEY' => 'test-secret-key'])
            ->assertStatus(200);

        $fresh = $batch->fresh();
        $this->assertSame(Transaction::PAYMENT_SUCCESS, $fresh->payment_status);
        $this->assertNotNull($fresh->granted_at);
        $this->assertSame('ML-TEST-1', $fresh->invoice_id);

        // Replay: same notification again must be a no-op, not re-grant.
        $this->postJson('/payment/midtrans/update', $payload, ['X-API-KEY' => 'test-secret-key'])
            ->assertStatus(200);

        $this->assertSame(Transaction::PAYMENT_SUCCESS, $fresh->fresh()->payment_status);
    }

    public function test_success_is_terminal_and_is_not_downgraded(): void
    {
        $batch = $this->makeBatch('IND-4', 19500);
        $batch->update(['payment_status' => Transaction::PAYMENT_SUCCESS, 'granted_at' => now()]);

        $this->postJson('/payment/midtrans/update', [
            'order_id' => $batch->midtrans_order_id,
            'transaction_status' => 'expire',
            'gross_amount' => 19500,
        ], ['X-API-KEY' => 'test-secret-key'])->assertStatus(200);

        $this->assertSame(Transaction::PAYMENT_SUCCESS, $batch->fresh()->payment_status);
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }
}
