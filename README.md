# 📸 Web Gallery Sekolah - SMK Negeri 4 Bogor

Sistem manajemen galeri foto digital berbasis **Laravel + PHP** untuk mengelola dan menampilkan koleksi foto kegiatan, prestasi, dan fasilitas sekolah.

## 🚀 Teknologi

- **Framework**: Laravel 12
- **Backend**: PHP 8.2+
- **Database**: MySQL
- **Template Engine**: Blade
- **Styling**: TailwindCSS
- **Image Processing**: Intervention Image

## ✨ Fitur Utama

### 🌐 Public (Tanpa Login)
- Galeri foto dengan 17 kategori
- Informasi dan pengumuman sekolah
- Sistem komentar dan likes
- Filter berdasarkan kategori
- Download foto

### 🔐 Admin Dashboard
- Manajemen foto (Upload, Edit, Delete)
- Manajemen informasi sekolah
- Monitoring performa sistem
- Statistik dan analytics
- Storage management

## 📋 Persyaratan Sistem

- PHP >= 8.2
- Composer
- MySQL/MariaDB
- XAMPP/WAMP (untuk development lokal)

## 🛠️ Instalasi

1. **Clone Repository**
```bash
git clone [repository-url]
cd ujikomrasya
```

2. **Install Dependencies**
```bash
composer install
```

3. **Konfigurasi Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Setup Database**
- Buat database MySQL
- Update `.env` dengan kredensial database
```env
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

5. **Migrasi Database**
```bash
php artisan migrate
php artisan db:seed
```

6. **Storage Link**
```bash
php artisan storage:link
```

7. **Jalankan Server**
```bash
php artisan serve
```

Akses aplikasi di: http://127.0.0.1:8000

## 🔐 Login Admin

- **URL**: http://127.0.0.1:8000/login
- **Username**: admin
- **Password**: admin123

## 📁 Struktur Project

```
ujikomrasya/
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/               # Models
│   ├── Services/             # Business logic
│   └── Helpers/              # Helper functions
├── resources/
│   └── views/                # Blade templates
│       ├── admin/            # Admin dashboard
│       ├── auth/             # Login/Register
│       └── public/           # Public pages
├── routes/
│   └── web.php               # Web routes
└── public/
    └── storage/              # Uploaded files
```

## 📚 Dokumentasi

- [Quick Start Guide](QUICK_START.md)
- [Information Feature](INFORMATION_FEATURE_README.md)
- [Categories Guide](CATEGORIES_README.md)

## 🔒 Keamanan

- CSRF Protection
- Admin-only access untuk management
- Role-based authentication
- Secure file upload validation

## 📝 License

Project ini dibuat untuk keperluan ujian kompetensi SMK Negeri 4 Bogor.
