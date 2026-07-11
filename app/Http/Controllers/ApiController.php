<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // 1. Endpoint API untuk menarik seluruh daftar stok kargo produk
    public function getProduk()
    {
        $produk = Produk::all();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data kargo berhasil ditarik dari Node Subang',
            'data'    => $produk
        ], 200);
    }

    // 2. Endpoint API untuk menarik detail spesifik satu nota transaksi
    public function getDetailTransaksi($id)
    {
        // Mengambil transaksi lengkap dengan relasi kasir dan detail itemnya
        $transaksi = Transaksi::with(['user', 'detailTransaksi.produk'])->find($id);

        // Proteksi jika ID transaksi yang dicari tidak ada di database
        if (!$transaksi) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Manifest kargo dengan ID tersebut tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Detail manifest kargo berhasil ditemukan',
            'data'    => $transaksi
        ], 200);
    }

    // API Advance: Simulasi Respon Enkripsi Payment Gateway
    public function checkPaymentStatus(Request $request)
    {
        // Validasi input kiriman dari pemanggil API
        $request->validate([
            'kode_transaksi' => 'required'
        ]);

        // Cari data transaksi di database kita
        $transaksi = Transaksi::where('kode_transaksi', '=', $request->input('kode_transaksi'), 'and')->first();

        if (!$transaksi) {
            return response()->json([
                'status_code' => '404',
                'status_message' => 'Transaction manifest not found in Bridges Network'
            ], 404);
        }

        // MOCK DATA: Mensimulasikan data struktur kompleks dari Midtrans Core API
        return response()->json([
            'status_code'        => '200',
            'status_message'     => 'Midtrans payment notification received successfully',
            'transaction_id'     => 'chiral-pay-' . bin2hex(random_bytes(8)),
            'order_id'           => $transaksi->kode_transaksi,
            'gross_amount'       => (string) $transaksi->total,
            'payment_type'       => 'qris',
            'transaction_status' => 'settlement', // Status lunas di payment gateway
            'fraud_status'       => 'accept',
            'settlement_time'    => now()->format('Y-m-d H:i:s'),
            'gateway_provider'   => 'MIDTRANS_MOCK_SANDBOX_V2',
            'client_node'        => [
                'operator' => 'Administrator Qi',
                'terminal' => 'Subang Distribution Node'
            ]
        ], 200);
    }
}