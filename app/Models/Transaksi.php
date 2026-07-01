<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['kode_transaksi', 'user_id', 'total', 'bayar', 'kembalian'];

    // Relasi: Satu transaksi memiliki banyak rincian barang yang dibeli (One to Many)
    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }

    // Relasi: Transaksi ini dicatat oleh seorang user/kasir
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}