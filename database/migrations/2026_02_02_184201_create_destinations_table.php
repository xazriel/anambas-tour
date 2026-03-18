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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Tempat Wisata
            $table->text('description'); // Penjelasan/Cerita
            $table->string('category'); // Pantai, Kuliner, atau Budaya
            $table->string('price_info')->nullable(); // Harga tiket/sewa kapal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
