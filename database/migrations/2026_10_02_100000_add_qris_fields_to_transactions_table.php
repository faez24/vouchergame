<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->text('midtrans_qr_string')->nullable()->after('payment_type');
            $table->timestamp('midtrans_qr_expiry_at')->nullable()->after('midtrans_qr_string');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['midtrans_qr_string', 'midtrans_qr_expiry_at']);
        });
    }
};
