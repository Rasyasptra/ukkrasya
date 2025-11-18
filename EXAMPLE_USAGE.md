# 📸 Contoh Penggunaan Kategori Foto Baru

## 🚀 Cara Menggunakan Fitur Kategori

### 1. Upload Foto dengan Kategori Baru

```php
// Di PhotoController atau form upload
$request->validate([
    'title' => 'required|string|max:255',
    'description' => 'nullable|string',
    'category' => 'required|string|max:100', // Kategori baru
    'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
]);

// Contoh kategori yang bisa digunakan:
$categories = [
    'kegiatan' => 'Kegiatan Sekolah',
    'ekstrakurikuler' => 'Ekstrakurikuler',
    'olahraga' => 'Olahraga & Kesehatan',
    'seni' => 'Seni & Budaya',
    'teknologi' => 'Teknologi & Lab',
    'perpustakaan' => 'Perpustakaan',
    'kantin' => 'Kantin & UKS',
    'upacara' => 'Upacara & Acara Resmi',
    'study_tour' => 'Study Tour & Kunjungan',
    'graduation' => 'Wisuda & Kelulusan',
    'competition' => 'Kompetisi & Lomba',
    'environment' => 'Lingkungan & Taman'
];
```

### 2. Menggunakan CategoryHelper

```php
use App\Helpers\CategoryHelper;

// Mendapatkan semua kategori
$allCategories = CategoryHelper::getCategories();

// Mendapatkan nama kategori dari key
$categoryName = CategoryHelper::getCategoryName('ekstrakurikuler');
// Output: "Ekstrakurikuler"

// Mendapatkan kategori dikelompokkan
$groupedCategories = CategoryHelper::getGroupedCategories();

// Mendapatkan opsi untuk dropdown
$selectOptions = CategoryHelper::getSelectOptions();
```

### 3. Filter Foto berdasarkan Kategori

```php
// Di controller
public function index(Request $request)
{
    $query = Photo::with('user');
    
    // Filter berdasarkan kategori
    if ($request->filled('category') && $request->category !== 'all') {
        $query->where('category', $request->category);
    }
    
    $photos = $query->orderBy('created_at', 'desc')->get();
    
    return view('photos.index', compact('photos'));
}
```

### 4. Menampilkan Kategori di View

```blade
{{-- Di Blade template --}}
<select name="category" required>
    <option value="">Pilih Kategori</option>
    @foreach(\App\Helpers\CategoryHelper::getCategories() as $key => $name)
        <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
            {{ $name }}
        </option>
    @endforeach
</select>

{{-- Menampilkan nama kategori --}}
<div class="photo-category">
    {{ \App\Helpers\CategoryHelper::getCategoryName($photo->category) }}
</div>
```

## 🎯 Contoh Kategori untuk Berbagai Jenis Foto

### 📚 Kegiatan Pembelajaran
- **Kategori**: `kegiatan`
- **Contoh Foto**: 
  - Siswa belajar di kelas
  - Praktikum laboratorium
  - Diskusi kelompok
  - Presentasi siswa

### 🏆 Ekstrakurikuler
- **Kategori**: `ekstrakurikuler`
- **Contoh Foto**:
  - Latihan pramuka
  - Kegiatan PMR
  - Klub sains
  - Tim olahraga

### ⚽ Olahraga & Kesehatan
- **Kategori**: `olahraga`
- **Contoh Foto**:
  - Pertandingan basket
  - Senam pagi
  - UKS sekolah
  - Kegiatan fitness

### 🎭 Seni & Budaya
- **Kategori**: `seni`
- **Contoh Foto**:
  - Pentas drama
  - Konser musik
  - Pameran seni
  - Tarian tradisional

### 💻 Teknologi & Lab
- **Kategori**: `teknologi`
- **Contoh Foto**:
  - Lab komputer
  - Praktikum IPA
  - Workshop coding
  - Robotik

### 📖 Perpustakaan
- **Kategori**: `perpustakaan`
- **Contoh Foto**:
  - Ruang baca
  - Kegiatan literasi
  - Pojok baca
  - Storytelling

### 🏫 Fasilitas & Infrastruktur
- **Kategori**: `fasilitas`
- **Contoh Foto**:
  - Gedung sekolah
  - Ruang kelas
  - Aula serbaguna
  - Lapangan olahraga

### 🎓 Upacara & Acara Resmi
- **Kategori**: `upacara`
- **Contoh Foto**:
  - Upacara bendera
  - Hari kemerdekaan
  - Hari guru
  - Acara sekolah

### 🚌 Study Tour & Kunjungan
- **Kategori**: `study_tour`
- **Contoh Foto**:
  - Kunjungan industri
  - Study tour ke museum
  - Field trip
  - Wisata edukasi

### 🎉 Wisuda & Kelulusan
- **Kategori**: `graduation`
- **Contoh Foto**:
  - Acara wisuda
  - Foto bersama lulusan
  - Serah terima ijazah
  - Perpisahan kelas

### 🏆 Kompetisi & Lomba
- **Kategori**: `competition`
- **Contoh Foto**:
  - Olimpiade sains
  - Lomba cerdas cermat
  - Kompetisi debat
  - Festival sekolah

### 🌱 Lingkungan & Taman
- **Kategori**: `environment`
- **Contoh Foto**:
  - Taman sekolah
  - Tanaman hidroponik
  - Kebun sekolah
  - Program penghijauan

## 🔍 Fitur Pencarian dan Filter

### Pencarian Berdasarkan Judul
```php
if ($request->filled('search')) {
    $search = $request->search;
    $query->where('title', 'like', "%{$search}%");
}
```

### Filter Berdasarkan Kategori
```php
if ($request->filled('category') && $request->category !== 'all') {
    $query->where('category', $request->category);
}
```

### Kombinasi Pencarian dan Filter
```php
// Bisa menggunakan keduanya bersamaan
$photos = Photo::with('user')
    ->when($request->search, function($query, $search) {
        $query->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    })
    ->when($request->category && $request->category !== 'all', function($query, $category) {
        $query->where('category', $category);
    })
    ->orderBy('created_at', 'desc')
    ->get();
```

## 📱 Responsive Design

### Mobile-First Approach
```css
.photos-grid {
    display: grid;
    grid-template-columns: 1fr; /* Mobile: 1 kolom */
    gap: 16px;
}

@media (min-width: 768px) {
    .photos-grid {
        grid-template-columns: repeat(2, 1fr); /* Tablet: 2 kolom */
        gap: 24px;
    }
}

@media (min-width: 1024px) {
    .photos-grid {
        grid-template-columns: repeat(3, 1fr); /* Desktop: 3 kolom */
        gap: 32px;
    }
}
```

### Hover Effects
```css
.photo-card {
    transition: all 0.3s ease;
}

.photo-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.photo-image {
    transition: transform 0.3s ease;
}

.photo-card:hover .photo-image {
    transform: scale(1.05);
}
```

## 🎨 UI Components

### Category Badge
```css
.photo-category {
    background: #dbeafe;
    color: #1e40af;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    display: inline-block;
}
```

### Search Form
```css
.search-section {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.search-input {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    transition: border-color 0.3s ease;
}

.search-input:focus {
    border-color: #3b82f6;
}
```

## 📊 Statistik dan Analytics

### Menghitung Total Foto per Kategori
```php
$categoryStats = Photo::selectRaw('category, COUNT(*) as total')
    ->groupBy('category')
    ->get()
    ->pluck('total', 'category')
    ->toArray();
```

### Foto Terbaru (30 Hari Terakhir)
```php
$recentPhotos = Photo::where('created_at', '>=', now()->subDays(30))->count();
```

### Distribusi Kategori
```php
$categoryDistribution = Photo::selectRaw('category, COUNT(*) as count')
    ->groupBy('category')
    ->orderBy('count', 'desc')
    ->get();
```

## 🔐 Keamanan dan Validasi

### Validasi Input
```php
$request->validate([
    'category' => 'required|string|max:100|in:' . implode(',', array_keys(CategoryHelper::getCategories()))
]);
```

### Sanitasi Data
```php
$category = strip_tags($request->category);
$category = trim($category);
```

## 🚀 Performance Optimization

### Eager Loading
```php
$photos = Photo::with('user')->get(); // Load user data sekali
```

### Database Indexing
```sql
-- Tambahkan index untuk kategori
ALTER TABLE photos ADD INDEX idx_category (category);

-- Index untuk pencarian
ALTER TABLE photos ADD INDEX idx_title_description (title, description);
```

### Caching
```php
// Cache kategori untuk 1 jam
$categories = Cache::remember('photo_categories', 3600, function () {
    return CategoryHelper::getCategories();
});
```

## 📝 Best Practices

1. **Konsistensi Nama**: Gunakan nama kategori yang konsisten
2. **Validasi**: Selalu validasi input kategori
3. **Error Handling**: Handle kasus kategori tidak ditemukan
4. **Performance**: Gunakan eager loading dan indexing
5. **Responsive**: Design mobile-first
6. **Accessibility**: Tambahkan alt text dan label yang jelas
7. **SEO**: Gunakan meta tags yang sesuai

## 🔄 Maintenance

### Menambah Kategori Baru
1. Edit `CategoryHelper::getCategories()`
2. Update `CategoryHelper::getGroupedCategories()`
3. Test dengan foto baru
4. Update dokumentasi

### Update Kategori Existing
1. Backup data foto
2. Update nama kategori
3. Migrate data lama
4. Test fungsionalitas

### Monitoring
- Track penggunaan kategori
- Monitor performance
- User feedback
- Analytics data
