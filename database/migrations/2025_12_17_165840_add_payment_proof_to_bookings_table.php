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
// Cek dulu, jika kolom payment_proof BELUM ada di tabel bookings, baru tambahkan.
    if (!Schema::hasColumn('bookings', 'payment_proof')) {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('total_price');
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
};
