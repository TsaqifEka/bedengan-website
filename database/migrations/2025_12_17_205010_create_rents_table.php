<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            
            // RELASI KE USERS (PENTING!)
            // onDelete('cascade') artinya jika user dihapus, data sewanya ikut terhapus
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->string('code')->unique(); // Kode Booking: RNT-001
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_days');
            $table->integer('total_price');
            
            // Data kontak backup (tetap disimpan jaga-jaga user ganti profil)
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            
            $table->string('payment_proof')->nullable();
            $table->enum('status', ['unpaid', 'waiting_verification', 'paid', 'rented', 'returned', 'cancelled'])->default('unpaid');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
