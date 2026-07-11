<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['kode_transaksi', 'user_id', 'total', 'bayar', 'kembalian'];

    // Relasi ke User (Kasir)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ⚡ TAMBAHKAN FUNGSI INI AGAR ERROR DI CONTROLLER HILANG BERSIH
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }
}