<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role user saat ini ada di dalam daftar role yang diizinkan rute
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request); // Lolos, silakan masuk rute
        }

        // 3. Jika tidak diizinkan, kembalikan ke halaman utama dengan pesan penolakan
        return response('⚠️ [ ACCESS DENIED: Tingkat Otorisasi Komando Anda Tidak Mencukupi ]', 403);
    }
}
