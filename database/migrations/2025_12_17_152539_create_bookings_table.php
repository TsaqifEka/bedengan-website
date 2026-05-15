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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // Data Diri
            $table->string('name');
            $table->string('email');
            $table->string('phone');

            // Detail Kunjungan
            $table->date('visit_date');
            $table->integer('ticket_price'); // Harga satuan
            $table->integer('quantity');     // Jumlah tiket
            $table->integer('total_price');  // Total bayar

            // Status & Pembayaran
            $table->enum('status', ['unpaid', 'waiting_verification', 'paid', 'rejected'])->default('unpaid');
            $table->string('payment_proof')->nullable(); // Nama file gambar pembayaran

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
