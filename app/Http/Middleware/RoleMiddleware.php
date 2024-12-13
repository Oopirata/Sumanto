<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $roleName): Response
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please login first');
        }

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Ambil role aktif dari session
        $activeRole = Session::get('active_role');

        // Periksa apakah role aktif sesuai dengan yang diminta
        if ($activeRole !== $roleName) {
            // Jika role aktif tidak sesuai, arahkan ke halaman pemilihan role atau login ulang
            return redirect()->back();
        }

        // Periksa apakah pengguna memiliki role yang dibutuhkan
        $hasRole = $user->hasRole($roleName);

        if (!$hasRole) {
            return redirect()->back();
        }

        return $next($request);
    }
}
