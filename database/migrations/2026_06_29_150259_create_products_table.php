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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('nama')->nullable();
            $table->string('kategori')->nullable();
            $table->string('harga')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status',['tersedia','hampir habis','habis'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
