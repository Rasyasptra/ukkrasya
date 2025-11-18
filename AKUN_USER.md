# 👥 Informasi Akun User - Web Gallery Sekolah

## ✅ Status: User Sudah Tersedia!

Database sudah memiliki **4 akun user** yang siap digunakan untuk login ke gallery.

---

## 🔐 Daftar Akun User

### 1. User Demo
- **Username**: `user`
- **Password**: `user123`
- **Email**: user@smkn4bogor.sch.id
- **Role**: User
- **Keterangan**: Akun demo untuk testing

### 2. Siswa SMK
- **Username**: `siswa`
- **Password**: `siswa123`
- **Email**: siswa@smkn4bogor.sch.id
- **Role**: User
- **Keterangan**: Akun untuk siswa

### 3. Alumni SMK
- **Username**: `alumni`
- **Password**: `alumni123`
- **Email**: alumni@smkn4bogor.sch.id
- **Role**: User
- **Keterangan**: Akun untuk alumni

### 4. Rasya
- **Username**: `rasya`
- **Password**: `rasya123`
- **Email**: rasya@example.com
- **Role**: User
- **Keterangan**: Akun testing khusus

---

## 🎯 Cara Login

### Langkah 1: Akses Halaman Login User
Buka browser dan kunjungi:
```
http://127.0.0.1:8000/user/login
```

### Langkah 2: Masukkan Kredensial
Pilih salah satu akun di atas, misalnya:
- **Username**: `user`
- **Password**: `user123`

### Langkah 3: Klik "Masuk ke Gallery"
Setelah login berhasil, Anda akan:
- Diarahkan ke halaman gallery utama
- Melihat notifikasi "Selamat datang, [Nama]!"
- Nama Anda muncul di navigation bar
- Dapat melakukan like dan comment pada foto

---

## 🔑 Akun Admin (Untuk Perbandingan)

### Administrator
- **Username**: `admin`
- **Password**: `admin123`
- **Email**: admin@sekolah.com
- **Role**: Admin
- **Login URL**: http://127.0.0.1:8000/login
- **Redirect**: Dashboard Admin

---

## 📝 Perbedaan User vs Admin

| Fitur | User | Admin |
|-------|------|-------|
| **URL Login** | `/user/login` | `/login` |
| **Redirect Setelah Login** | Gallery | Admin Dashboard |
| **Akses Gallery** | ✅ View, Like, Comment | ✅ Full Access |
| **Kelola Foto** | ❌ | ✅ CRUD |
| **Kelola Informasi** | ❌ | ✅ CRUD |
| **Kelola User** | ❌ | ✅ (jika ada fitur) |

---

## 🆕 Membuat Akun Baru

Jika ingin membuat akun user baru:

### Via Registrasi (Recommended)
1. Kunjungi: http://127.0.0.1:8000/register
2. Isi form registrasi dengan data lengkap
3. Klik "Daftar"
4. Otomatis login dan redirect ke gallery

### Via Seeder (Developer)
Jalankan command:
```bash
php artisan db:seed --class=UserSeeder
```

---

## 🧪 Testing Login

### Test User Login
```bash
# Akses halaman login
http://127.0.0.1:8000/user/login

# Gunakan kredensial:
Username: user
Password: user123
```

### Test Admin Login
```bash
# Akses halaman login admin
http://127.0.0.1:8000/login

# Gunakan kredensial:
Username: admin
Password: admin123
```

---

## 📊 Statistik Database

- **Total Users**: 5 akun
  - Admin: 1 akun
  - User: 4 akun

---

## ⚠️ Catatan Keamanan

1. **Password Default**: Semua akun menggunakan password sederhana untuk testing
2. **Production**: Ganti semua password dengan yang lebih kuat
3. **Email Verification**: Saat ini belum aktif
4. **Role**: User tidak bisa mengakses admin dashboard

---

## 🔄 Reset Password (Jika Lupa)

Untuk saat ini, reset password dilakukan manual via database atau seeder.
Fitur forgot password belum diimplementasikan.

---

## 📞 Bantuan

Jika ada masalah login:
1. Pastikan XAMPP sudah running (Apache & MySQL)
2. Pastikan sudah di direktori project yang benar
3. Cek apakah user ada di database: `php check_users.php`
4. Clear cache Laravel: `php artisan cache:clear`

---

**Dibuat**: 8 November 2025  
**Update Terakhir**: 8 November 2025
