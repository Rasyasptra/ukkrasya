# 👥 Akun User untuk Login

## 🔐 Kredensial Login

### **Admin Account**
```
Username: admin
Password: admin123
Role: Admin
URL: http://127.0.0.1:8000/login
Dashboard: http://127.0.0.1:8000/admin/dashboard
```

**Akses Admin:**
- ✅ Manajemen Foto (Upload, Edit, Delete)
- ✅ Manajemen Informasi
- ✅ Dashboard dengan statistik lengkap
- ✅ Monitoring performa sistem
- ✅ Lihat semua komentar dan likes

---

### **User Account 1 - Demo User**
```
Username: user
Password: user123
Role: User
URL: http://127.0.0.1:8000/login
Redirect: http://127.0.0.1:8000/gallery
```

### **User Account 2 - Siswa**
```
Username: siswa
Password: siswa123
Role: User
URL: http://127.0.0.1:8000/login
Redirect: http://127.0.0.1:8000/gallery
```

### **User Account 3 - Alumni**
```
Username: alumni
Password: alumni123
Role: User
URL: http://127.0.0.1:8000/login
Redirect: http://127.0.0.1:8000/gallery
```

**Akses User:**
- ✅ Lihat galeri foto
- ✅ Komentar pada foto
- ✅ Like/Unlike foto
- ✅ Lihat informasi sekolah
- ❌ Tidak ada dashboard user (langsung ke gallery)
- ❌ Tidak bisa upload foto
- ❌ Tidak bisa akses admin panel

---

## 📝 Cara Login

### **Login sebagai Admin:**
1. Buka: http://127.0.0.1:8000/login
2. Masukkan username: `admin`
3. Masukkan password: `admin123`
4. Klik "Login"
5. Redirect ke Admin Dashboard

### **Login sebagai User:**
1. Buka: http://127.0.0.1:8000/login
2. Masukkan username: `user` / `siswa` / `alumni`
3. Masukkan password: `user123` / `siswa123` / `alumni123`
4. Klik "Login"
5. Redirect ke Gallery (http://127.0.0.1:8000/gallery)

---

## 🆕 Registrasi User Baru

Jika ingin membuat akun user baru:

1. **Via Web:**
   - Buka: http://127.0.0.1:8000/register
   - Isi form registrasi
   - Submit
   - Login dengan akun baru

2. **Via Seeder:**
   ```bash
   php artisan db:seed --class=DemoUserSeeder
   ```

---

## 🔄 Reset Password

Jika lupa password, bisa reset via database:

```bash
php artisan tinker
```

Kemudian:
```php
$user = App\Models\User::where('username', 'user')->first();
$user->password = Hash::make('password_baru');
$user->save();
```

---

## 📊 Perbedaan Admin vs User

| Fitur | Admin | User |
|-------|-------|------|
| Upload Foto | ✅ | ❌ |
| Edit/Delete Foto | ✅ | ❌ |
| Manajemen Informasi | ✅ | ❌ |
| Lihat Galeri | ✅ | ✅ |
| Komentar | ✅ | ✅ |
| Like Foto | ✅ | ✅ |
| Dashboard | Admin Dashboard | ❌ (Langsung ke Gallery) |
| Monitoring Sistem | ✅ | ❌ |
| Edit Profil | ✅ | ❌ |

---

## 🚀 Testing

### Test Login Admin:
```bash
curl -X POST http://127.0.0.1:8000/login \
  -d "username=admin&password=admin123"
```

### Test Login User:
```bash
curl -X POST http://127.0.0.1:8000/login \
  -d "username=user&password=user123"
```

---

## 📝 Catatan

- Semua password menggunakan bcrypt hash
- Role: `admin` atau `user`
- User tidak bisa akses admin routes
- Admin bisa akses semua routes
- Session timeout: 120 menit (default Laravel)
