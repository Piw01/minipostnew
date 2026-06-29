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
        Schema::create('produks', function (Blueprint $table) {
            $table->id(); // Auto-increment ID utama
            $table->string('kode_produk')->unique(); // Kode kargo unik
            $table->string('nama_produk'); // Nama barang
            $table->integer('harga_beli'); // Harga modal
            $table->integer('harga_jual'); // Harga jual ke kurir
            $table->integer('stok')->default(0); // Jumlah stok barang
            $table->string('gambar')->nullable(); // Lokasi file foto produk
            $table->timestamps(); // create_at & updated_at otomatis
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
