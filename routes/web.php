<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;

/* ==========================================================================
   1. RUTE KHUSUS TAMU (GUEST) - HANYA BISA DIAKSES JIKA BELUM LOGIN
   ========================================================================== */
Route::middleware('guest')->group(function () {
    // Menampilkan halaman login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    // Memproses data login yang dikirim
    Route::post('/login', [AuthController::class, 'authenticate']);
});

/* ==========================================================================
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
    });    
});