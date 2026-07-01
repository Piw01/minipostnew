<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $fillable = ['transaksi_id', 'produk_id', 'harga', 'qty', 'subtotal'];

    // Relasi: Detail barang ini merujuk ke produk kargo tertentu
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}