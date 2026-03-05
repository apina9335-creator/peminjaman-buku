<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Perbaikan: Cek kolom is_admin, bukan role
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        // Jika bukan admin, arahkan ke dashboard user
        return redirect('/dashboard')->with('error', 'Akses ditolak! Anda bukan Admin.'); 
    }
}