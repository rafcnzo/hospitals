<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestOrPemilik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Jika User BELUM LOGIN (Tamu) -> Izinkan Lewat
        if (! Auth::check()) {
            return $next($request);
        }

        // 2. Jika User SUDAH LOGIN, Cek apakah dia 'pemilik'?
        if (Auth::user()->hasRole('pemilik')) {
            return $next($request);
        }

        // 3. Jika Login TAPI BUKAN Pemilik (Admin/Dokter/dll) -> TOLAK
        abort(403, 'Halaman ini hanya untuk Tamu atau Pemilik.');
    }
}
