# 🔧 Troubleshooting Fitur Registrasi

## ❌ Error yang Ditemui dan Solusinya

### **Error 1: Call to undefined method App\Http\Controllers\RegisterController::middleware()**

**Penyebab:**
- Di Laravel 12, method `middleware()` tidak tersedia di controller secara langsung
- Middleware harus didefinisikan di route atau menggunakan attribute

**Solusi:**
1. **Hapus middleware dari constructor controller:**
```php
// SEBELUM (Error):
public function __construct()
{
    $this->middleware('guest'); // ❌ Tidak tersedia di Laravel 12
}

// SESUDAH (Benar):
public function __construct()
{
    // Middleware didefinisikan di route
}
```

2. **Pindahkan middleware ke route:**
```php
// Di routes/web.php
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    Route::post('/register/check-username', [RegisterController::class, 'checkUsername'])->name('register.checkUsername');
    Route::post('/register/check-email', [RegisterController::class, 'checkEmail'])->name('register.checkEmail');
});
```

3. **Buat middleware RedirectIfAuthenticated:**
```php
// app/Http/Middleware/RedirectIfAuthenticated.php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('user.dashboard');
                }
            }
        }

        return $next($request);
    }
}
```

4. **Daftarkan middleware alias di bootstrap/app.php:**
```php
// bootstrap/app.php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    ]);
})
```

## 🔍 Langkah-langkah Verifikasi

### **1. Periksa File yang Dibutuhkan:**
```bash
# Pastikan file-file berikut ada:
✓ app/Http/Controllers/RegisterController.php
✓ resources/views/auth/register.blade.php
✓ app/Http/Middleware/RedirectIfAuthenticated.php
✓ routes/web.php (dengan route registrasi)
✓ bootstrap/app.php (dengan middleware alias)
```

### **2. Clear Cache Laravel:**
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

### **3. Test Routes:**
```bash
php artisan route:list | findstr register
```

### **4. Test Middleware:**
```bash
# Pastikan middleware guest terdaftar
php artisan route:list --middleware=guest
```

## 🚨 Error Lain yang Mungkin Terjadi

### **Error 2: Route [user.dashboard] not defined**

**Solusi:**
- Pastikan route `user.dashboard` sudah didefinisikan di `routes/web.php`
- Route harus ada sebelum digunakan di controller

### **Error 3: View [auth.register] not found**

**Solusi:**
- Pastikan file `resources/views/auth/register.blade.php` ada
- Periksa struktur folder `resources/views/auth/`

### **Error 4: Class [App\Http\Middleware\RedirectIfAuthenticated] not found**

**Solusi:**
- Pastikan namespace di middleware benar
- Jalankan `composer dump-autoload`
- Periksa apakah file middleware ada di lokasi yang benar

## 🔧 Perbaikan yang Telah Dilakukan

### **1. RegisterController:**
- ✅ Hapus `$this->middleware('guest')` dari constructor
- ✅ Tambahkan komentar penjelasan untuk Laravel 12

### **2. Routes:**
- ✅ Tambahkan middleware `guest` di level route
- ✅ Group semua route registrasi dengan middleware yang sama

### **3. Middleware:**
- ✅ Buat `RedirectIfAuthenticated` middleware
- ✅ Implementasi logic redirect berdasarkan role user
- ✅ Daftarkan alias `guest` di `bootstrap/app.php`

### **4. Konfigurasi:**
- ✅ Update `bootstrap/app.php` dengan middleware alias
- ✅ Clear semua cache Laravel

## 📋 Checklist Verifikasi

- [ ] RegisterController tidak menggunakan `$this->middleware()`
- [ ] Route registrasi menggunakan `Route::middleware('guest')`
- [ ] File `RedirectIfAuthenticated.php` ada dan benar
- [ ] Middleware alias `guest` terdaftar di `bootstrap/app.php`
- [ ] Route `user.dashboard` sudah didefinisikan
- [ ] View `auth.register` ada dan benar
- [ ] Cache Laravel sudah di-clear
- [ ] Server bisa dijalankan tanpa error

## 🎯 Testing

### **Test 1: Akses Halaman Registrasi**
1. Buka browser
2. Akses `http://127.0.0.1:8000/register`
3. Pastikan halaman registrasi muncul
4. Pastikan tidak ada error

### **Test 2: Test Middleware Guest**
1. Login sebagai user/admin
2. Coba akses `http://127.0.0.1:8000/register`
3. Pastikan di-redirect ke dashboard yang sesuai

### **Test 3: Test Form Registrasi**
1. Isi form registrasi dengan data valid
2. Submit form
3. Pastikan user terbuat dan auto-login
4. Pastikan redirect ke `user.dashboard`

## 🆘 Jika Masih Ada Error

### **1. Periksa Log Laravel:**
```bash
tail -f storage/logs/laravel.log
```

### **2. Debug Mode:**
```bash
# Di .env, pastikan:
APP_DEBUG=true
APP_ENV=local
```

### **3. Periksa Versi Laravel:**
```bash
php artisan --version
```

### **4. Composer Dependencies:**
```bash
composer install
composer dump-autoload
```

## 📞 Support

Jika masih mengalami masalah setelah mengikuti troubleshooting guide ini:

1. **Periksa error log** di `storage/logs/laravel.log`
2. **Pastikan semua file** sudah dibuat dengan benar
3. **Clear cache** Laravel
4. **Restart server** Laravel
5. **Periksa versi** Laravel dan PHP

---

**Catatan:** Troubleshooting guide ini dibuat berdasarkan error yang ditemui di Laravel 12.25.0 dengan PHP 8.2.12.
