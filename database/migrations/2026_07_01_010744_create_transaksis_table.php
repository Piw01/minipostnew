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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique(); // ID Nota unik
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Kasir yang bertugas
            $table->integer('total'); // Total belanja seluruhnya
            $table->integer('bayar'); // Uang tunai yang diserahkan pembeli
            $table->integer('kembalian'); // Sisa kembalian uang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
