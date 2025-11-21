# Halaman Login User - Web Gallery Sekolah

## 📋 Deskripsi
Halaman login khusus untuk user yang dapat mengakses landing page utama (gallery) website SMK Negeri 4 Bogor.

## 🔗 URL Akses

### Login User
- **URL**: http://127.0.0.1:8000/user/login
- **Fungsi**: Login untuk user biasa yang ingin mengakses gallery dengan fitur interaktif (like, comment)

### Login Admin
- **URL**: http://127.0.0.1:8000/login
- **Fungsi**: Login untuk admin yang mengelola konten website

### Registrasi User
- **URL**: http://127.0.0.1:8000/register
- **Fungsi**: Pendaftaran akun user baru

### Gallery Publik
- **URL**: http://127.0.0.1:8000/gallery
- **Fungsi**: Halaman utama gallery yang dapat diakses tanpa login

## ✨ Fitur Halaman Login User

### Desain Modern
- Layout split screen dengan gradient background
- Animasi smooth dan interaktif
- Responsive untuk semua ukuran layar
- Dark mode support

### Informasi Fitur
Halaman login menampilkan 3 fitur utama:
1. **Galeri Lengkap** - Akses koleksi foto kegiatan sekolah
2. **Informasi Terkini** - Update pengumuman dan berita sekolah
3. **Interaksi Sosial** - Like dan komentar pada foto favorit

### Form Login
- Input username atau email
- Input password
- Icon visual untuk setiap field
- Validasi real-time
- Loading state saat submit

### Navigasi
- Link ke halaman registrasi
- Link kembali ke gallery publik

## 🎯 Alur Penggunaan

### Untuk User Baru:
1. Kunjungi http://127.0.0.1:8000/gallery
2. Klik tombol "Login" di navigation bar
3. Klik "Belum punya akun? Daftar sekarang"
4. Isi form registrasi
5. Setelah registrasi, otomatis login dan redirect ke gallery
6. Notifikasi sukses akan muncul: "Selamat datang, [Nama]!"

### Untuk User yang Sudah Terdaftar:
1. Kunjungi http://127.0.0.1:8000/user/login
2. Masukkan username/email dan password
3. Klik "Masuk ke Gallery"
4. Redirect ke gallery dengan status login
5. Nama user akan muncul di navigation bar

## 🔐 Perbedaan User vs Admin

### User Biasa:
- Login via: `/user/login`
- Redirect ke: Gallery (`/gallery`)
- Akses: View, like, comment pada foto
- Tampilan: Nama user di navbar + tombol logout

### Admin:
- Login via: `/login`
- Redirect ke: Admin Dashboard (`/admin/dashboard`)
- Akses: Full control (CRUD foto, informasi, dll)
- Tampilan: "Dashboard Admin" button di navbar

## 📱 Fitur Responsif
- Desktop: Layout split screen
- Tablet: Layout split screen (adjusted)
- Mobile: Single column layout, fitur sidebar tersembunyi

## 🎨 Teknologi
- Pure HTML/CSS/JavaScript (no framework dependencies)
- Laravel Blade templating
- Font Awesome icons
- Google Fonts (Inter)
- CSS animations & transitions

## 🔄 Session Management
- Auto-login setelah registrasi
- Remember me functionality
- Session regeneration untuk keamanan
- Logout redirect ke gallery publik

## 📝 Catatan Penting
1. User yang login akan melihat nama mereka di navbar
2. User dapat logout kapan saja dengan tombol "Logout"
3. Setelah logout, user tetap bisa mengakses gallery publik
4. Admin dan user memiliki halaman login terpisah untuk keamanan
5. Registrasi otomatis membuat akun dengan role "user"
