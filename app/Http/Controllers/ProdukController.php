<?php

namespace App\Http\Controllers;

use App\Models\Produk; // Import model Produk
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel produks menggunakan Eloquent ORM
        $data_produk = Produk::all();

        // Melempar data ke halaman view produk
        return view('produk.index', [
            'data_produk' => $data_produk
        ]);
    }
}