<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        // Jika mengakses halaman register, izinkan meskipun sudah login
        if ($request->is('register') || $request->routeIs('register*')) {
            return $next($request);
        }

        // Jika mengakses admin routes, izinkan lanjut tanpa redirect
        if ($request->is('admin/*') || $request->routeIs('admin.*')) {
            return $next($request);
        }

        // Hanya redirect jika mengakses halaman login atau guest routes
        if ($request->is('login') || $request->routeIs('login') || $request->is('/')) {
            foreach ($guards as $guard) {
                if (Auth::guard($guard)->check()) {
                    // Jika user sudah login, redirect berdasarkan role
                    $user = Auth::user();
                    if ($user->role === 'admin') {
                        return redirect()->route('admin.dashboard');
                    } else {
                        return redirect()->route('gallery.index');
                    }
                }
            }
        }

        return $next($request);
    }
}
