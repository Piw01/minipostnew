<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan halaman antarmuka kasir (Point of Sale)
    public function create()
    {
        // Hanya memanggil produk kargo yang stoknya tidak kosong (lebih dari 0)
        $produk = Produk::where('stok', '>', 0, 'and')->get();
        return view('transaksi.create', compact('produk'));
    }
}