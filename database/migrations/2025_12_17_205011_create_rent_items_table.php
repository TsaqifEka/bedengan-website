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
        Schema::create('rent_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rent_id')->constrained('rents')->onDelete('cascade');
            $table->unsignedBigInteger('equipment_id');
            
            $table->integer('quantity');
            $table->integer('price_per_day');
            $table->integer('subtotal');
            
            $table->timestamps();
            
            // Foreign key ditambah di constraint terpisah setelah semua tabel ada
            $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_items');
    }
};
