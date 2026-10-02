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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('batch_id')->nullable()->after('user_id');
            $table->unsignedInteger('item_index')->default(0)->after('batch_id');
            $table->string('kategori_pembelian')->default('individu')->after('item_index');
            $table->string('batch_name')->nullable()->after('kategori_pembelian');

            $table->string('payment_status')->default('WAITING')->after('status');
            $table->string('midtrans_order_id')->nullable()->after('payment_status');
            $table->string('midtrans_transaction_id')->nullable()->after('midtrans_order_id');
            $table->string('payment_type')->nullable()->after('midtrans_transaction_id');
            $table->timestamp('paid_at')->nullable()->after('payment_type');
            $table->timestamp('granted_at')->nullable()->after('paid_at');

            $table->unique(['batch_id', 'item_index']);
            $table->index('midtrans_order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropUnique(['batch_id', 'item_index']);
            $table->dropIndex(['midtrans_order_id']);

            $table->dropColumn([
                'batch_id',
                'item_index',
                'kategori_pembelian',
                'batch_name',
                'payment_status',
                'midtrans_order_id',
                'midtrans_transaction_id',
                'payment_type',
                'paid_at',
                'granted_at',
            ]);
        });
    }
};
