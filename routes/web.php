<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;


// 1. Basic Routing sederhana
Route::get('/coba', function () {
    return "Ini adalah halaman Coba untuk MiniPost";
});

// 2. Route Parameter untuk menangkap data dinamis (misal ID Produk/Post)
Route::get('/coba2/{id}', function ($id) {
    return "Ini adalah data dengan ID: " . $id;
});

// 3. Fallback Route untuk menangani alamat 404 (Halaman Tidak Ditemukan)
Route::fallback(function () {
    return "404 - Alamat tidak ditemukan di sistem MiniPost!";
});
Route::get('/', function () {
    return view('home');
});
Route::get('/', [HomeController::class, 'index']);

// Rute untuk melihat manajemen kargo produk
Route::get('/produk', [ProdukController::class, 'index']);