# 📸 Dokumentasi Kategori Foto Galeri Sekolah

## Overview
Sistem galeri foto sekolah telah diperbarui dengan kategori yang lebih lengkap dan terorganisir untuk memudahkan pengelolaan dan pencarian foto.

## 🏷️ Daftar Kategori Foto

### 1. Aktivitas Sekolah
- **Kegiatan Sekolah** (`kegiatan`) - Kegiatan pembelajaran, rapat guru, acara sekolah
- **Ekstrakurikuler** (`ekstrakurikuler`) - Kegiatan ekstrakurikuler siswa
- **Olahraga & Kesehatan** (`olahraga`) - Kegiatan olahraga, UKS, senam
- **Seni & Budaya** (`seni`) - Pentas seni, musik, drama, tari
- **Upacara & Acara Resmi** (`upacara`) - Upacara bendera, peringatan hari besar
- **Study Tour & Kunjungan** (`study_tour`) - Kunjungan industri, study tour
- **Wisuda & Kelulusan** (`graduation`) - Acara wisuda, kelulusan siswa
- **Kompetisi & Lomba** (`competition`) - Lomba antar sekolah, olimpiade

### 2. SDM & Peserta Didik
- **Guru & Staff** (`guru`) - Foto guru, staff, dan kegiatan pengembangan
- **Siswa & Kegiatan Belajar** (`siswa`) - Aktivitas belajar siswa, praktikum
- **Prestasi & Penghargaan** (`prestasi`) - Penghargaan, sertifikat, prestasi

### 3. Infrastruktur
- **Fasilitas & Infrastruktur** (`fasilitas`) - Gedung, ruang kelas, aula
- **Teknologi & Lab** (`teknologi`) - Laboratorium komputer, lab IPA, multimedia
- **Perpustakaan** (`perpustakaan`) - Perpustakaan sekolah, kegiatan membaca
- **Kantin & UKS** (`kantin`) - Kantin sekolah, UKS, kesehatan
- **Lingkungan & Taman** (`environment`) - Taman sekolah, lingkungan hijau

### 4. Lainnya
- **Umum & Lainnya** (`general`) - Foto-foto yang tidak masuk kategori spesifik

## 🔧 Cara Penggunaan

### Untuk Admin
1. **Upload Foto Baru**: Pilih kategori yang sesuai saat upload foto
2. **Edit Foto**: Ubah kategori foto yang sudah ada jika diperlukan
3. **Filter & Cari**: Gunakan filter kategori untuk mengelola foto

### Untuk Pengunjung Website
1. **Galeri Publik**: Akses `/gallery` untuk melihat semua foto
2. **Filter Kategori**: Gunakan dropdown kategori untuk filter foto
3. **Pencarian**: Cari foto berdasarkan judul atau deskripsi
4. **Kategori Spesifik**: Akses `/gallery/category/{nama-kategori}`

## 📁 Struktur File

```
app/
├── Helpers/
│   └── CategoryHelper.php          # Helper untuk mengelola kategori
├── Http/Controllers/
│   ├── PhotoController.php         # Controller admin untuk foto
│   └── GalleryController.php       # Controller publik untuk galeri
└── Models/
    └── Photo.php                   # Model foto dengan field category

resources/views/
├── admin/photos/
│   ├── index.blade.php            # Halaman admin - daftar foto
│   └── edit.blade.php             # Halaman admin - edit foto
└── gallery.blade.php               # Halaman publik - galeri foto

routes/
└── web.php                         # Route untuk galeri publik
```

## 🚀 Fitur Baru

### 1. CategoryHelper
- **getCategories()**: Mendapatkan semua kategori
- **getCategoryName()**: Mendapatkan nama kategori dari key
- **getGroupedCategories()**: Kategori dikelompokkan berdasarkan jenis
- **getSelectOptions()**: Format untuk dropdown select

### 2. Galeri Publik
- Tampilan foto berdasarkan kategori
- Pencarian dan filter
- Statistik foto
- Layout responsive dan modern

### 3. Pengelompokan Kategori
- **Aktivitas Sekolah**: Semua kegiatan dan acara
- **SDM & Peserta Didik**: Guru, siswa, dan prestasi
- **Infrastruktur**: Fasilitas dan bangunan
- **Lainnya**: Kategori umum

## 📱 Responsive Design
- Mobile-friendly layout
- Grid responsive untuk foto
- Navigation yang mudah digunakan
- Loading yang cepat

## 🔍 Fitur Pencarian
- Pencarian berdasarkan judul foto
- Pencarian berdasarkan deskripsi
- Filter berdasarkan kategori
- Kombinasi pencarian dan filter

## 📊 Statistik
- Total foto dalam sistem
- Jumlah kategori tersedia
- Foto terbaru (30 hari terakhir)
- Distribusi foto per kategori

## 🎨 UI/UX Features
- Hover effects pada foto
- Smooth transitions
- Color-coded kategori
- Modern card design
- Loading states

## 🔐 Keamanan
- Admin-only untuk upload/edit/delete
- Public access untuk viewing
- Validasi input kategori
- Sanitasi data

## 📈 Maintenance
- Kategori mudah ditambah/diubah
- Centralized category management
- Consistent naming convention
- Easy to extend

## 🚀 Cara Menambah Kategori Baru

1. Edit `app/Helpers/CategoryHelper.php`
2. Tambahkan kategori baru di method `getCategories()`
3. Update method `getGroupedCategories()` jika perlu
4. Jalankan aplikasi

## 📝 Contoh Penggunaan

```php
// Mendapatkan semua kategori
$categories = CategoryHelper::getCategories();

// Mendapatkan nama kategori
$name = CategoryHelper::getCategoryName('kegiatan'); // "Kegiatan Sekolah"

// Mendapatkan kategori dikelompokkan
$grouped = CategoryHelper::getGroupedCategories();

// Mendapatkan opsi untuk select
$options = CategoryHelper::getSelectOptions();
```

## 🔄 Update History

- **v1.0**: Kategori dasar (6 kategori)
- **v2.0**: Kategori lengkap (17 kategori)
- **v2.1**: Pengelompokan kategori
- **v2.2**: Galeri publik dengan filter
- **v2.3**: CategoryHelper untuk maintenance

## 📞 Support

Untuk pertanyaan atau bantuan teknis, silakan hubungi tim pengembang.
