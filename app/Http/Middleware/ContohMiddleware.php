<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContohMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->query('token');

        // Jika token sesuai, izinkan akses masuk ke aplikasi
        if ($token === 'admin123') {
            return $next($request);
        }

        // Jika salah/tidak ada token, tolak aksesnya
        return response('Access Denied: Token Invalid atau Belum Login!', 401);
    }
}
