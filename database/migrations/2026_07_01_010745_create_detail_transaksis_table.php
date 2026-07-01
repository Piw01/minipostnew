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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade'); // Terhubung ke nota induk
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade'); // Terhubung ke barang kargo
            $table->integer('harga'); // Harga jual barang saat transaksi
            $table->integer('qty'); // Jumlah item kargo yang diambil
            $table->integer('subtotal'); // Hasil kalkulasi harga x qty
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};
