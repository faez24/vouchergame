<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Transaction;
use App\Services\MidtransService;
use App\Services\VocaBisnisService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartCheckoutTest extends TestCase
{
    use RefreshDatabase;

    private function mockVocaBisnisDetail(array $requiredFieldNames = []): void
    {
        $fields = collect($requiredFieldNames)->map(fn (string $name) => [
            'tag' => 'input',
            'attrs' => ['name' => $name],
        ])->all();

        $mock = \Mockery::mock(VocaBisnisService::class);
        $mock->shouldReceive('getProductDetail')->andReturn([
            'userInput' => ['fields' => $fields],
        ]);
        $this->app->instance(VocaBisnisService::class, $mock);
    }

    private function makeProduct(int $vocaProductId = 15, string $title = 'Mobile Legends'): Product
    {
        return Product::create([
            'voca_product_id' => $vocaProductId,
            'title' => $title,
            'code' => 'ml',
            'is_maintenance' => false,
            'is_featured' => false,
            'sort_order' => 0,
        ]);
    }

    private function makeItem(Product $product, int $vocaItemId, int $price, array $overrides = []): ProductItem
    {
        return ProductItem::create(array_merge([
            'product_id' => $product->id,
            'voca_item_id' => $vocaItemId,
            'name' => "Item {$vocaItemId}",
            'price' => $price,
            'is_active' => true,
            'is_maintenance' => false,
            'voucher_stock' => 100,
            'sort_order' => 0,
        ], $overrides));
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }

    // --- 4/5: reject missing product_id / product_item_id ---

    public function test_cart_checkout_rejects_missing_product_id(): void
    {
        $this->mockVocaBisnisDetail();

        $this->postJson('/cart/checkout', [
            'items' => [
                ['product_item_id' => 6, 'user_id_ingame' => '123', 'zone_id' => '1'],
            ],
        ])->assertStatus(422)->assertJsonValidationErrors(['items.0.product_id']);
    }

    public function test_cart_checkout_rejects_missing_product_item_id(): void
    {
        $this->mockVocaBisnisDetail();

        $this->postJson('/cart/checkout', [
            'items' => [
                ['product_id' => 15, 'user_id_ingame' => '123', 'zone_id' => '1'],
            ],
        ])->assertStatus(422)->assertJsonValidationErrors(['items.0.product_item_id']);
    }

    // --- 6/7: price is never trusted from client, always re-fetched from DB ---

    public function test_price_is_resolved_from_database_not_client(): void
    {
        $this->mockVocaBisnisDetail();
        $product = $this->makeProduct();
        $this->makeItem($product, 6, 19500);

        $response = $this->postJson('/cart/checkout', [
            'items' => [
                [
                    'product_id' => 15,
                    'product_item_id' => 6,
                    // client attempts to smuggle a bogus price; the endpoint has
                    // no `price`/`total_amount` field at all, so this is simply ignored.
                    'total_amount' => 1,
                    'price' => 1,
                ],
            ],
        ]);

        $response->assertRedirect();

        $transaction = Transaction::first();
        $this->assertSame(19500, $transaction->total_amount);
        $this->assertSame('Item 6', $transaction->product_item_name);
    }

    // --- 8/9/10: bulk cart creates N rows, same batch_id, sequential item_index ---

    public function test_cart_checkout_with_two_items_creates_two_linked_transactions(): void
    {
        $this->mockVocaBisnisDetail();
        $ml = $this->makeProduct(15, 'Mobile Legends');
        $ff = $this->makeProduct(1, 'Free Fire');
        $this->makeItem($ml, 6, 19500);
        $this->makeItem($ff, 9, 10000);

        $this->postJson('/cart/checkout', [
            'items' => [
                ['product_id' => 15, 'product_item_id' => 6, 'user_id_ingame' => '111', 'zone_id' => '1'],
                ['product_id' => 1, 'product_item_id' => 9, 'user_id_ingame' => '222', 'zone_id' => '2'],
            ],
        ])->assertRedirect();

        $transactions = Transaction::orderBy('item_index')->get();

        $this->assertCount(2, $transactions);
        $this->assertSame('bulk', $transactions[0]->kategori_pembelian);
        $this->assertSame($transactions[0]->batch_id, $transactions[1]->batch_id);
        $this->assertStringStartsWith('BATCH-', $transactions[0]->batch_id);
        $this->assertSame(0, $transactions[0]->item_index);
        $this->assertSame(1, $transactions[1]->item_index);
    }

    // --- 11: one batch produces exactly one Midtrans order across all its rows ---

    public function test_checkout_page_creates_a_single_midtrans_order_for_the_whole_batch(): void
    {
        $this->mockVocaBisnisDetail();
        $ml = $this->makeProduct(15, 'Mobile Legends');
        $ff = $this->makeProduct(1, 'Free Fire');
        $this->makeItem($ml, 6, 19500);
        $this->makeItem($ff, 9, 10000);

        $this->postJson('/cart/checkout', [
            'items' => [
                ['product_id' => 15, 'product_item_id' => 6],
                ['product_id' => 1, 'product_item_id' => 9],
            ],
        ]);

        $batchId = Transaction::first()->batch_id;

        $midtransMock = \Mockery::mock(MidtransService::class);
        $midtransMock->shouldReceive('createSnapTransaction')
            ->once()
            ->withArgs(fn (array $payload) => $payload['transaction_details']['gross_amount'] === 29500)
            ->andReturn(['token' => 'snap-token-xyz', 'redirect_url' => 'https://example.test']);
        $this->app->instance(MidtransService::class, $midtransMock);

        $this->get("/checkout?batch={$batchId}")->assertOk();

        $transactions = Transaction::where('batch_id', $batchId)->get();
        $this->assertCount(2, $transactions);
        $orderIds = $transactions->pluck('midtrans_order_id')->unique();
        $this->assertCount(1, $orderIds);
        $this->assertSame('GAME-'.$batchId, $orderIds->first());
    }

    // --- 12: invalid product/item is rejected, no transaction created ---

    public function test_unknown_product_is_rejected(): void
    {
        $this->mockVocaBisnisDetail();

        $this->postJson('/cart/checkout', [
            'items' => [
                ['product_id' => 999999, 'product_item_id' => 6],
            ],
        ])->assertStatus(422);

        $this->assertSame(0, Transaction::count());
    }

    public function test_unknown_product_item_is_rejected(): void
    {
        $this->mockVocaBisnisDetail();
        $this->makeProduct(15);

        $this->postJson('/cart/checkout', [
            'items' => [
                ['product_id' => 15, 'product_item_id' => 999999],
            ],
        ])->assertStatus(422);

        $this->assertSame(0, Transaction::count());
    }

    public function test_maintenance_item_is_rejected(): void
    {
        $this->mockVocaBisnisDetail();
        $product = $this->makeProduct();
        $this->makeItem($product, 6, 19500, ['is_maintenance' => true]);

        $this->postJson('/cart/checkout', [
            'items' => [
                ['product_id' => 15, 'product_item_id' => 6],
            ],
        ])->assertStatus(422);

        $this->assertSame(0, Transaction::count());
    }

    public function test_out_of_stock_item_is_rejected(): void
    {
        $this->mockVocaBisnisDetail();
        $product = $this->makeProduct();
        $this->makeItem($product, 6, 19500, ['voucher_stock' => 0]);

        $this->postJson('/cart/checkout', [
            'items' => [
                ['product_id' => 15, 'product_item_id' => 6],
            ],
        ])->assertStatus(422);

        $this->assertSame(0, Transaction::count());
    }

    // --- required account fields per product's own userInput spec ---

    public function test_missing_required_account_field_is_rejected(): void
    {
        $this->mockVocaBisnisDetail(['userId', 'zoneId']);
        $product = $this->makeProduct();
        $this->makeItem($product, 6, 19500);

        $this->postJson('/cart/checkout', [
            'items' => [
                ['product_id' => 15, 'product_item_id' => 6, 'user_id_ingame' => '123'],
            ],
        ])->assertStatus(422);

        $this->assertSame(0, Transaction::count());
    }

    public function test_product_without_required_fields_does_not_need_account_data(): void
    {
        $this->mockVocaBisnisDetail([]); // e.g. a voucher product that needs no account fields
        $product = $this->makeProduct();
        $this->makeItem($product, 6, 19500);

        $this->postJson('/cart/checkout', [
            'items' => [
                ['product_id' => 15, 'product_item_id' => 6],
            ],
        ])->assertRedirect();

        $this->assertSame(1, Transaction::count());
    }

    // --- 13: existing Topup -> Checkout individual flow still works ---

    public function test_topup_checkout_still_creates_a_single_individual_batch(): void
    {
        $this->mockVocaBisnisDetail();
        $product = $this->makeProduct();
        $this->makeItem($product, 6, 19500);

        $this->post('/topup/15/checkout', [
            'product_item_id' => 6,
            'user_id_ingame' => '123456',
            'zone_id' => '1234',
        ])->assertRedirect();

        $transaction = Transaction::first();
        $this->assertNotNull($transaction);
        $this->assertSame('individu', $transaction->kategori_pembelian);
        $this->assertStringStartsWith('IND-', $transaction->batch_id);
        $this->assertSame(0, $transaction->item_index);
        $this->assertSame(19500, $transaction->total_amount);
        $this->assertSame(Transaction::PAYMENT_WAITING, $transaction->payment_status);
    }
}
