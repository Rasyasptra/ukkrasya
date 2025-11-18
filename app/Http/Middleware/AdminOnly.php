<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access admin area.');
        }

        $user = Auth::user();
        
        // If user is not admin, redirect to login with admin access message
        if ($user->role !== 'admin') {
            // Store the intended URL for after admin login
            session(['url.intended' => $request->fullUrl()]);
            
            // Redirect to admin login with message
            return redirect()->route('login')
                ->with('info', 'Admin access required. Please login with administrator credentials.')
                ->with('show_admin_login', true);
        }

        return $next($request);
    }
}
