<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('voca_item_id')->unique();
            $table->string('name');
            $table->unsignedBigInteger('price');
            $table->string('icon_url')->nullable();
            $table->string('variant_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_maintenance')->default(false);
            $table->integer('voucher_stock')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_items');
    }
};
