<?php

namespace App\Http\Controllers;

use App\Models\Produk; // <-- PASTIKAN BARIS INI ADA AGAR TIDAK MERAH
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $jumlah_produk = Produk::count('*');
        return view('home', [
            'jumlah_produk' => $jumlah_produk
        ]);
    }
}