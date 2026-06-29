<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Menyuntikkan kargo dummy komoditas Bridges
        Produk::create([
            'kode_produk' => 'CR-001',
            'nama_produk' => 'Chiral Crystals Container',
            'harga_beli' => 5000,
            'harga_jual' => 8500,
            'stok' => 45,
            'gambar' => null
        ]);

        Produk::create([
            'kode_produk' => 'RS-002',
            'nama_produk' => 'High-Density Resin',
            'harga_beli' => 3000,
            'harga_jual' => 4500,
            'stok' => 120,
            'gambar' => null
        ]);
    }
}