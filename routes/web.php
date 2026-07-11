<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiController;

/* ==========================================================================
   1. RUTE KHUSUS TAMU (GUEST) - HANYA BISA DIAKSES JIKA BELUM LOGIN
   ========================================================================== */
Route::middleware('guest')->group(function () {
    // Menampilkan halaman login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    // Memproses data login yang dikirim
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/* ===================================================  =======================
   2. RUTE TERPROTEKSI (AUTH) - WAJIB LOGIN TERLEBIH DAHULU UNTUK MASUK
   ========================================================================== */
Route::middleware('auth')->group(function () {
    
    // Memproses fungsi keluar dari aplikasi
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Rute Dashboard Utama
    Route::get('/', [HomeController::class, 'index']);

    
    // Rute Manajemen Kargo Produk (CRUD)
    Route::middleware('role:admin,kepala toko')->group(function () {
        Route::get('/produk', [ProdukController::class, 'index']);
        Route::get('/produk/create', [ProdukController::class, 'create']);
        Route::post('/produk/store', [ProdukController::class, 'store']);
        Route::get('/produk/{id}/edit', [ProdukController::class, 'edit']);
        Route::post('/produk/{id}/update', [ProdukController::class, 'update']);
        Route::get('/produk/{id}/delete', [ProdukController::class, 'destroy']);
        // Rute untuk membuka aplikasi kasir
        Route::get('/transaksi', [\App\Http\Controllers\TransaksiController::class, 'create']);
        // Rute memproses penyimpanan data dari kasir (POST)
        Route::post('/transaksi/store', [\App\Http\Controllers\TransaksiController::class, 'store']);
        // Rute riwayat list nota transaksi
        Route::get('/transaksi/history', [\App\Http\Controllers\TransaksiController::class, 'index']);
        // Rute memanggil halaman cetak nota thermal berdasarkan ID transaksi
        Route::get('/transaksi/print/{id}', [\App\Http\Controllers\TransaksiController::class, 'print']);
        // Rute mendownload laporan spreadsheet berdasarkan filter tanggal
        Route::get('/transaksi/export', [\App\Http\Controllers\TransaksiController::class, 'export']);
    });  

    // 🌐 JALUR ENDPOINT API PUBLIC (Materi Pertemuan 13)
    Route::prefix('api')->group(function () {
    // Jalur untuk cek daftar produk: http://localhost:8080/api/produk
    Route::get('/produk', [ApiController::class, 'getProduk']);
    
    // Jalur untuk cek satu transaksi: http://localhost:8080/api/transaksi/{id}
    Route::get('/transaksi/{id}', [ApiController::class, 'getDetailTransaksi']);
    });

    // Halaman HTML Monitor Utama untuk berinteraksi dengan API
    Route::get('/gateway-monitor', function () {
        return view('api.simulation');
    });

    // Endpoint API Advance: Simulasi Check Status Pembayaran Pihak Ketiga
    Route::post('/api/v1/payment/check-status', [\App\Http\Controllers\ApiController::class, 'checkPaymentStatus']);
});