# 🔐 Panduan Login Admin

## Kredensial Login yang Benar

**Gunakan salah satu kombinasi berikut:**

### Opsi 1: Login dengan Username
- **Username:** `admin`
- **Password:** `admin123`

### Opsi 2: Login dengan Email  
- **Email:** `admin@sekolah.com`
- **Password:** `admin123`

---

## Langkah-Langkah Login

1. **Buka halaman login:**
   ```
   http://localhost:5175/login
   ```
   atau
   ```
   http://127.0.0.1:5175/login
   ```

2. **Masukkan kredensial:**
   - Di field "Email atau Username", masukkan: `admin` atau `admin@sekolah.com`
   - Di field "Password", masukkan: `admin123`

3. **Klik tombol "Masuk ke Sistem"**

4. **Anda akan diarahkan ke:** `http://localhost:5175/admin/dashboard`

---

## Jika Login Masih Gagal

### Solusi 1: Clear Browser Cache
1. Tekan `Ctrl + Shift + Delete`
2. Pilih "Cookies and other site data"
3. Pilih "Cached images and files"
4. Klik "Clear data"
5. Refresh halaman login (F5)

### Solusi 2: Gunakan Incognito/Private Mode
1. Tekan `Ctrl + Shift + N` (Chrome) atau `Ctrl + Shift + P` (Firefox)
2. Buka halaman login di mode incognito
3. Coba login lagi

### Solusi 3: Clear Laravel Cache
Jalankan command berikut di terminal:
```bash
cd c:\xampp\htdocs\ujikomrasya
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan session:flush
```

### Solusi 4: Restart Development Server
Jika menggunakan `php artisan serve`:
1. Stop server (Ctrl + C)
2. Start ulang: `php artisan serve --port=5175`

Jika menggunakan XAMPP:
1. Stop Apache di XAMPP Control Panel
2. Start ulang Apache

### Solusi 5: Cek Log Error
Buka file log untuk melihat error detail:
```
c:\xampp\htdocs\ujikomrasya\storage\logs\laravel.log
```

---

## Verifikasi Database

Untuk memastikan data admin sudah benar, jalankan:
```bash
php test_login_detailed.php
```

Output yang benar:
```
Test 1: Find by username 'admin'
✓ Found user: Administrator

Test 2: Find by email 'admin@sekolah.com'
✓ Found user: Administrator

Test 4: Password verification for user ID 1
  Password 'admin123': ✓ MATCH
```

---

## Troubleshooting Tambahan

### Cek apakah server berjalan:
- Buka browser dan akses: `http://localhost:5175`
- Jika tidak bisa diakses, server belum berjalan

### Pastikan port yang benar:
- Cek URL di browser Anda
- Sesuaikan dengan port yang digunakan server

### Cek file .env:
- Pastikan `APP_URL` sesuai dengan URL yang Anda gunakan
- Pastikan database connection sudah benar

---

## Kontak Support

Jika masih mengalami masalah, screenshot error yang muncul dan berikan informasi:
1. Pesan error yang muncul
2. URL yang digunakan
3. Browser yang digunakan
4. Apakah menggunakan XAMPP atau `php artisan serve`
