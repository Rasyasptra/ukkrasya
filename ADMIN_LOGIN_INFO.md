# 🔐 Cara Akses Login Admin

## 📍 URL Login Admin

**URL Login Admin:**
```
http://127.0.0.1:8000/login
```

## 🔑 Kredensial Admin

**Username:** `admin`  
**Password:** `admin123`

## 📝 Catatan Penting

1. **Login admin TIDAK ditambahkan di navbar** - Hanya bisa diakses langsung via URL `/login`
2. **Login admin berbeda dengan login user** - User login di `/user/login`
3. **Setelah login admin**, akan redirect ke `/admin/dashboard`

## 🚀 Cara Menggunakan

1. Buka browser dan akses: `http://127.0.0.1:8000/login`
2. Masukkan username: `admin`
3. Masukkan password: `admin123`
4. Klik tombol "Masuk"
5. Akan redirect otomatis ke Dashboard Admin

## ⚠️ Keamanan

- Login admin hanya untuk administrator
- Jangan share kredensial admin ke user biasa
- Pastikan password admin kuat dan aman

## 🔄 Perbedaan Login Admin vs User

| Fitur | Admin Login | User Login |
|-------|-------------|------------|
| URL | `/login` | `/user/login` |
| Redirect | `/admin/dashboard` | `/gallery` |
| Akses | Full admin panel | Gallery & profil |
| Navbar | Tidak ada link | Ada link di navbar |

