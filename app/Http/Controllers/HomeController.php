<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Hitung total seluruh omset pendapatan dari tabel transaksi
        $totalPendapatan = Transaksi::sum('total');

        // 2. Hitung jumlah total pengiriman/nota transaksi yang tercipta
        $jumlahTransaksi = Transaksi::count();

        // 3. Hitung berapa banyak jenis komoditas produk di gudang
        $totalProduk = Produk::count();

        // Kirim ketiga variabel statistik ke halaman depan dasbor
        return view('home', compact('totalPendapatan', 'jumlahTransaksi', 'totalProduk'));
    }
}