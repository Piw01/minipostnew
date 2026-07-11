<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function create()
    {
        $produk = Produk::query()->where('stok', '>', 0)->get();
        return view('transaksi.create', compact('produk'));
    }

    // Memproses data manifest keranjang ke database
    public function store(Request $request)
    {
        // Validasi data masukan dari kasir
        $request->validate([
            'total' => 'required|numeric',
            'bayar' => 'required|numeric',
            'kembalian' => 'required|numeric',
            'produk_id' => 'required|array',
        ]);

        // Proteksi database tingkat militer dengan DB Transaction
        DB::transaction(function () use ($request) {
            
            // 1. Membuat Kode Nota Otomatis Unik (Contoh: TR-20260710-XYZ)
            $kodeTransaksi = 'TR-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(10));

            // 2. Simpan Data ke Tabel Utama 'transaksis'
            $transaksi = Transaksi::create([
                'kode_transaksi' => $kodeTransaksi,
                'user_id' => Auth::id(), // ID Kasir yang sedang login
                'total' => $request->total,
                'bayar' => $request->bayar,
                'kembalian' => $request->kembalian,
            ]);

            // 3. Looping untuk mengambil array kiriman produk dari JavaScript keranjang
            foreach ($request->produk_id as $index => $produkId) {
                $qtyBeli = $request->qty[$index];
                $hargaBeli = $request->harga[$index];
                $subtotal = $qtyBeli * $hargaBeli;

                // Ambil data produk asli dari DB untuk dicek dan dikurangi stoknya
                $produk = Produk::lockForUpdate()->findOrFail($produkId);

                if ($produk->stok < $qtyBeli) {
                    // Jika di tengah jalan stok tiba-tiba habis, batalkan seluruh transaksi!
                    throw new \Exception("[ FAILED: Stok untuk komoditas {$produk->nama_produk} tidak mencukupi! ]");
                }

                // Simpan Rincian Barang ke tabel 'detail_transaksis'
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produkId,
                    'harga' => $hargaBeli,
                    'qty' => $qtyBeli,
                    'subtotal' => $subtotal,
                ]);

                // 4. Potong Stok Kargo Asli di Gudang
                $produk->decrement('stok', $qtyBeli);
            }
        });

        // Jika lolos tanpa Exception eror, kembalikan ke kasir dengan pesan sukses
        return redirect('/transaksi')->with('success', 'Chiral Cargo Transaction Committed Successfully!');
    }
    // Menampilkan daftar seluruh riwayat dengan fitur filter tanggal
    public function index(Request $request)
    {
        // Membuat query dasar mengambil transaksi beserta data kasir
        $query = Transaksi::with('user');

        // Jika user mengisi filter tanggal mulai
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        // Jika user mengisi filter tanggal selesai
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_selesai);
        }

        // Ambil data terbaru berdasarkan hasil filter
        $transaksi = $query->latest()->get();

        return view('transaksi.index', compact('transaksi'));
    }    
    
    // Menyiapkan data manifest nota spesifik untuk dicetak
    public function print($id)
    {
        // Mengambil transaksi berdasarkan ID beserta relasi kasir dan detail produknya
        $transaksi = Transaksi::with(['user', 'detailTransaksi.produk'])->findOrFail($id);
        return view('transaksi.print', compact('transaksi'));
    }
}