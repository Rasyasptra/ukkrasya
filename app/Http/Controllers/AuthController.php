<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showUserLogin()
    {
        return view('auth.user-login');
    }

    public function login(Request $request)
    {
        // Enhanced logging - START
        Log::info('=== LOGIN REQUEST START ===');
        Log::info('Request method: ' . $request->method());
        Log::info('Request URL: ' . $request->fullUrl());
        Log::info('Request IP: ' . $request->ip());
        
        $request->validate([
            'username' => ['required','string'],
            'password' => ['required','string'],
        ]);

        $remember = (bool) $request->boolean('remember');

        $username = trim((string) $request->input('username'));
        $password = (string) $request->input('password');

        // Debug logging
        Log::info('Login attempt', [
            'username' => $username,
            'password_length' => strlen($password),
            'password_first_char' => substr($password, 0, 1),
            'remember' => $remember,
            'session_id' => session()->getId()
        ]);

        // Try to find user by username or email
        $user = User::where('username', $username)
                    ->orWhere('email', $username)
                    ->first();
        
        if ($user) {
            Log::info('User found', [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_role' => $user->role,
                'password_hash_length' => strlen($user->password)
            ]);
            
            // Test password
            $passwordMatch = Hash::check($password, $user->password);
            Log::info('Password check result: ' . ($passwordMatch ? 'MATCH' : 'NO MATCH'));
            
            if ($passwordMatch) {
                Log::info('Password verified successfully - attempting login');
                
                try {
                    Auth::login($user, $remember);
                    Log::info('Auth::login executed');
                    
                    $request->session()->regenerate();
                    Log::info('Session regenerated');
                    
                    // Check if user is authenticated
                    $isAuthenticated = Auth::check();
                    Log::info('Auth::check() result: ' . ($isAuthenticated ? 'TRUE' : 'FALSE'));
                    
                    if ($isAuthenticated) {
                        Log::info('Authenticated user ID: ' . Auth::id());
                    }

                    // Redirect based on user role
                    if ($user->role === 'admin') {
                        Log::info('User is admin - redirecting to admin dashboard');
                        
                        // Check if there's an intended URL
                        $intendedUrl = session()->pull('url.intended', route('admin.dashboard'));
                        Log::info('Redirect URL: ' . $intendedUrl);
                        
                        return redirect()->intended(route('admin.dashboard'));
                    } else {
                        // Regular user - redirect to home
                        Log::info('User is regular user - redirecting to home');
                        $redirectUrl = route('home');
                        Log::info('Redirect URL: ' . $redirectUrl);
                        return redirect()->route('home')->with('success', 'Selamat datang, ' . $user->name . '!');
                    }
                } catch (\Exception $e) {
                    Log::error('Exception during login process', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    return back()->withErrors([
                        'username' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
                    ])->withInput($request->only('username'));
                }
            } else {
                Log::warning('Password verification failed', [
                    'user_id' => $user->id,
                    'username' => $username,
                    'provided_password_length' => strlen($password)
                ]);
            }
        } else {
            Log::warning('User not found', [
                'username' => $username,
                'searched_by' => 'username OR email'
            ]);
        }

        Log::warning('Login gagal - returning error', [
            'reason' => $user ? 'password_mismatch' : 'user_not_found',
            'username' => $username,
        ]);
        Log::info('=== LOGIN REQUEST END ===');

        return back()->withErrors([
            'username' => 'Login gagal, periksa kembali username dan password.',
        ])->withInput($request->only('username'));
    }

    public function userLogin(Request $request)
    {
        Log::info('=== USER LOGIN REQUEST START ===');
        
        // Validate the request
        $validator = Validator::make($request->all(), [
            'username' => ['required','string'],
            'password' => ['required','string'],
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->only('username'));
        }

        $username = trim((string) $request->input('username'));
        $password = (string) $request->input('password');

        Log::info('User login attempt', [
            'username' => $username,
            'session_id' => session()->getId()
        ]);

        // Try to find user by username or email
        $user = User::where('username', $username)
                    ->orWhere('email', $username)
                    ->first();
        
        if ($user) {
            Log::info('User found', [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role,
            ]);
            
            // Test password
            $passwordMatch = Hash::check($password, $user->password);
            
            if ($passwordMatch) {
                Log::info('Password verified - logging in user');
                
                try {
                    Auth::login($user, true);
                    $request->session()->regenerate();
                    
                    // Check if user is admin
                    if ($user->role === 'admin') {
                        Log::info('User is admin - redirecting to admin dashboard');
                        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
                    }
                    
                    Log::info('User logged in successfully - redirecting to home');
                    return redirect()->route('home')->with('success', 'Selamat datang, ' . $user->name . '!');
                    
                } catch (\Exception $e) {
                    Log::error('Exception during user login', [
                        'error' => $e->getMessage(),
                    ]);
                    return back()->withErrors([
                        'username' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
                    ])->withInput($request->only('username'));
                }
            } else {
                Log::warning('Password verification failed for user', [
                    'username' => $username,
                ]);
            }
        } else {
            Log::warning('User not found', [
                'username' => $username,
            ]);
        }

        Log::info('=== USER LOGIN REQUEST END ===');

        return back()->withErrors([
            'username' => 'Login gagal. Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout. Silakan login kembali untuk mengakses fitur.');
    }

    public function galleryLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('gallery.index')->with('success', 'Anda telah berhasil logout.');
    }
}