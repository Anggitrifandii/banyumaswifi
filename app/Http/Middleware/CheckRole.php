<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login, atau role-nya tidak ada dalam daftar yang diizinkan ($roles), tendang ke halaman error 403
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            abort(403, 'Akses Ditolak! Anda tidak memiliki izin untuk melihat halaman ini.');
        }

        return $next($request);
    }
}