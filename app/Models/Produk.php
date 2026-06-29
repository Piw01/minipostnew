<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // Mendaftarkan kolom yang boleh diisi datanya
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'harga_beli',
        'harga_jual',
        'stok',
        'gambar'
    ];
}