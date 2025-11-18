# 🚀 Quick Start Guide

## Cara Menjalankan Aplikasi

**Jalankan Laravel Server:**
```bash
php artisan serve
```

## 🌐 Akses Aplikasi

- **Galeri Publik**: http://127.0.0.1:8000/gallery
- **Halaman Utama**: http://127.0.0.1:8000/
- **Admin Dashboard**: http://127.0.0.1:8000/admin/dashboard
- **Login Admin**: http://127.0.0.1:8000/login

## 🔐 Login Admin

Gunakan kredensial admin yang sudah ada di database:
- Username: admin
- Password: admin123

Login hanya tersedia di: http://127.0.0.1:8000/login

## 📱 Fitur yang Tersedia

### Public (Tanpa Login)
- ✅ Lihat galeri foto
- ✅ Lihat informasi sekolah
- ✅ Browse by kategori
- ✅ Lihat detail foto
- ✅ Komentar dan likes

### Admin (Setelah Login)
- ✅ Dashboard dengan statistik
- ✅ Kelola foto (CRUD)
- ✅ Kelola informasi (CRUD)
- ✅ Monitoring performa sistem
- ✅ Manajemen storage

## 🛠️ Troubleshooting

### Database error?
Pastikan:
1. XAMPP MySQL sudah running
2. Database sudah dibuat
3. File `.env` sudah dikonfigurasi dengan benar
4. Migrasi sudah dijalankan: `php artisan migrate`

### Port 8000 sudah digunakan?
Gunakan port lain: `php artisan serve --port=8080`

## 📝 Catatan

Project ini menggunakan **Laravel + PHP murni** tanpa frontend framework terpisah. 
Semua tampilan menggunakan Blade templates.
