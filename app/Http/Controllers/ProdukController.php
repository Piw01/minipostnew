<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // 1. Menampilkan semua kargo
    public function index()
    {
        $data_produk = Produk::all();
        return view('produk.index', compact('data_produk'));
    }

    // 2. Menampilkan Form Tambah Kargo
    public function create()
    {
        return view('produk.create');
    }

    // 3. Memproses Penyimpanan Kargo Baru
    public function store(Request $request)
    {
        // Validasi input data kargo sesuai aturan militer Bridges
        $request->validate([
            'kode_produk' => 'required|unique:produks,kode_produk',
            'nama_produk' => 'required',
            'harga_beli'  => 'required|numeric',
            'harga_jual'  => 'required|numeric',
            'stok'        => 'required|numeric',
        ]);

        // Simpan ke database menggunakan Eloquent Mass Assignment
        Produk::create($request->all());

        // Kembalikan ke halaman utama kargo dengan pesan sukses
        return redirect('/produk')->with('success', 'New Cargo Registered Successfully!');
    }

    // 4. Menampilkan Form Edit Kargo
    public function edit($id)
    {
        // Mencari data kargo berdasarkan ID, jika tidak ada langsung memunculkan 404
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    // 5. Memproses Pembaruan Data Kargo
    public function update(Request $request, $id)
    {
        $request->validate([
            // Validasi unik dikecualikan untuk ID kargo ini sendiri agar bisa disimpan
            'kode_produk' => 'required|unique:produks,kode_produk,' . $id,
            'nama_produk' => 'required',
            'harga_beli'  => 'required|numeric',
            'harga_jual'  => 'required|numeric',
            'stok'        => 'required|numeric',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect('/produk')->with('success', 'Cargo Manifest Updated!');
    }

    // 6. Menghapus Kargo dari Jaringan
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect('/produk')->with('success', 'Cargo Decommissioned Successfully!');
    }
    
}