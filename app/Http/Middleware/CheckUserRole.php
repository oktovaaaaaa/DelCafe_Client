<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'user') {
            return $next($request);
        }

        // Jika bukan 'user', kembalikan response error atau redirect
        abort(403, 'Unauthorized.'); // Contoh: Menampilkan error 403
        // Atau, redirect ke halaman lain:
        // return redirect('/home');
    }
}
