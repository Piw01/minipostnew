<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Menampilkan Halaman Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Memproses Validasi Verifikasi Akun
    public function authenticate(Request $request)
    {
        // Validasi format input data login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Mencoba mencocokkan data dengan database (Metode Auth bawaan Laravel)
        if (Auth::attempt($credentials)) {
            // Jika cocok, buat ulang token session demi keamanan
            $request->session()->regenerate();

            // Lemparkan masuk ke halaman utama (Dashboard)
            return redirect()->intended('/');
        }

        // Jika gagal/tidak cocok, kembalikan ke form login dengan pesan peringatan
        return back()->withErrors([
            'email' => '[ ACCESS DENIED: Manifes Identitas Tidak Ditemukan di Jaringan Chiral ]',
        ])->onlyInput('email');
    }

    // 3. Memproses Keluar Sistem (Logout)
    public function logout(Request $request)
    {
        Auth::logout();

        // Hancurkan session lama agar tidak disalahgunakan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}