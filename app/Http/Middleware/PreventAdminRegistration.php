<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventAdminRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Contracts\Queue\ShouldQueue): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika user sudah login dan role-nya admin, redirect ke dashboard admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('warning', 'Admin tidak dapat mengakses halaman registrasi. Silakan gunakan dashboard admin.');
        }

        return $next($request);
    }
}
