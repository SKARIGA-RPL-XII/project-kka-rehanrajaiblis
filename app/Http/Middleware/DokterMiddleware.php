<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DokterMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'doktor') {
            abort(403, 'Akses ditolak. Hanya dokter yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}