# 🎨 Design System - Web Gallery Sekolah

## 🎯 **Overview**
Design System yang konsisten untuk seluruh aplikasi Web Gallery Sekolah, memastikan UI dan tema yang seragam di semua halaman.

## ✨ **Fitur Utama**

### **1. Konsistensi Visual**
- ✅ **Color Palette** - Skema warna yang seragam
- ✅ **Typography** - Font dan ukuran yang konsisten
- ✅ **Spacing** - Sistem spacing yang terstandarisasi
- ✅ **Components** - Komponen UI yang dapat digunakan ulang

### **2. Responsive Design**
- ✅ **Mobile First** - Pendekatan mobile-first
- ✅ **Breakpoints** - Breakpoint yang konsisten
- ✅ **Grid System** - Sistem grid yang fleksibel

### **3. Accessibility**
- ✅ **Dark Mode** - Dukungan mode gelap otomatis
- ✅ **Focus States** - State fokus yang jelas
- ✅ **Color Contrast** - Kontras warna yang baik

## 🎨 **Color System**

### **Primary Colors (Blue)**
```css
--primary-50: #eff6ff   /* Lightest */
--primary-100: #dbeafe
--primary-200: #bfdbfe
--primary-300: #93c5fd
--primary-400: #60a5fa
--primary-500: #3b82f6  /* Base */
--primary-600: #2563eb
--primary-700: #1d4ed8
--primary-800: #1e40af
--primary-900: #1e3a8a  /* Darkest */
```

### **Secondary Colors (Gray)**
```css
--secondary-50: #f8fafc   /* Background */
--secondary-100: #f1f5f9
--secondary-200: #e2e8f0  /* Borders */
--secondary-300: #cbd5e1
--secondary-400: #94a3b8
--secondary-500: #64748b
--secondary-600: #475569
--secondary-700: #334155
--secondary-800: #1e293b  /* Text */
--secondary-900: #0f172a
```

### **Semantic Colors**
```css
--success-600: #16a34a   /* Green */
--warning-600: #d97706   /* Orange */
--danger-600: #dc2626    /* Red */
```

## 🔤 **Typography System**

### **Font Family**
```css
--font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
```

### **Font Sizes**
```css
--font-size-xs: 0.75rem;    /* 12px */
--font-size-sm: 0.875rem;   /* 14px */
--font-size-base: 1rem;     /* 16px */
--font-size-lg: 1.125rem;   /* 18px */
--font-size-xl: 1.25rem;    /* 20px */
--font-size-2xl: 1.5rem;    /* 24px */
--font-size-3xl: 1.875rem;  /* 30px */
--font-size-4xl: 2.25rem;   /* 36px */
```

### **Font Weights**
```css
--font-weight-light: 300;
--font-weight-normal: 400;
--font-weight-medium: 500;
--font-weight-semibold: 600;
--font-weight-bold: 700;
```

## 📏 **Spacing System**

### **Spacing Scale**
```css
--spacing-1: 0.25rem;   /* 4px */
--spacing-2: 0.5rem;    /* 8px */
--spacing-3: 0.75rem;   /* 12px */
--spacing-4: 1rem;      /* 16px */
--spacing-5: 1.25rem;   /* 20px */
--spacing-6: 1.5rem;    /* 24px */
--spacing-8: 2rem;      /* 32px */
--spacing-10: 2.5rem;   /* 40px */
--spacing-12: 3rem;     /* 48px */
--spacing-16: 4rem;     /* 64px */
--spacing-20: 5rem;     /* 80px */
```

## 🔲 **Component System**

### **Buttons**
```html
<!-- Primary Button -->
<button class="btn btn-primary">Primary Button</button>

<!-- Secondary Button -->
<button class="btn btn-secondary">Secondary Button</button>

<!-- Success Button -->
<button class="btn btn-success">Success Button</button>

<!-- Warning Button -->
<button class="btn btn-warning">Warning Button</button>

<!-- Danger Button -->
<button class="btn btn-danger">Danger Button</button>

<!-- Outline Button -->
<button class="btn btn-outline">Outline Button</button>
```

### **Button Sizes**
```html
<button class="btn btn-primary btn-sm">Small</button>
<button class="btn btn-primary">Default</button>
<button class="btn btn-primary btn-lg">Large</button>
<button class="btn btn-primary btn-xl">Extra Large</button>
```

### **Forms**
```html
<div class="form-group">
    <label for="email" class="form-label">Email</label>
    <input type="email" id="email" class="form-control" placeholder="Enter email">
    <div class="form-text">We'll never share your email.</div>
</div>
```

### **Cards**
```html
<div class="card">
    <div class="card-header">
        <h3>Card Header</h3>
    </div>
    <div class="card-body">
        <p>Card content goes here.</p>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary">Action</button>
    </div>
</div>
```

### **Alerts**
```html
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i>
    Success message here!
</div>

<div class="alert alert-danger">
    <i class="fas fa-exclamation-triangle"></i>
    Error message here!
</div>
```

### **Badges**
```html
<span class="badge badge-primary">Primary</span>
<span class="badge badge-success">Success</span>
<span class="badge badge-warning">Warning</span>
<span class="badge badge-danger">Danger</span>
```

### **Tables**
```html
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>John Doe</td>
            <td>john@example.com</td>
            <td>Admin</td>
        </tr>
    </tbody>
</table>
```

## 📱 **Grid System**

### **Grid Classes**
```html
<div class="grid grid-cols-1">   <!-- 1 column -->
<div class="grid grid-cols-2">   <!-- 2 columns -->
<div class="grid grid-cols-3">   <!-- 3 columns -->
<div class="grid grid-cols-4">   <!-- 4 columns -->
```

### **Responsive Grid**
```css
/* Mobile: 1 column */
@media (max-width: 640px) {
    .grid-cols-2, .grid-cols-3, .grid-cols-4 {
        grid-template-columns: repeat(1, 1fr);
    }
}

/* Tablet: 2 columns */
@media (max-width: 768px) {
    .grid-cols-3, .grid-cols-4 {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Desktop: 3+ columns */
@media (max-width: 1024px) {
    .grid-cols-4 {
        grid-template-columns: repeat(3, 1fr);
    }
}
```

## 🎭 **Layout Templates**

### **Admin Layout**
- **Sidebar Navigation** - Menu vertikal dengan icon
- **Top Header** - Breadcrumb dan actions
- **Main Content** - Area konten utama
- **Responsive** - Sidebar collapse di mobile

### **User Layout**
- **Top Navigation** - Menu horizontal
- **Page Header** - Judul dan deskripsi
- **Main Content** - Area konten utama
- **Footer** - Informasi dan links

### **Public Layout**
- **Header** - Logo dan navigation
- **Hero Section** - Call-to-action utama
- **Content** - Area konten
- **Footer** - Links dan copyright

## 🌙 **Dark Mode Support**

### **Automatic Detection**
```css
@media (prefers-color-scheme: dark) {
    :root {
        --secondary-50: #0f172a;
        --secondary-100: #1e293b;
        /* ... other dark colors */
    }
}
```

### **Manual Toggle** (Future Feature)
```javascript
// Toggle dark mode
document.body.classList.toggle('dark-mode');
```

## 🚀 **Usage Examples**

### **1. Basic Page Structure**
```html
@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="container">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="card">
            <div class="card-body">
                <h3>Welcome</h3>
                <p>Welcome to admin dashboard</p>
                <button class="btn btn-primary">Get Started</button>
            </div>
        </div>
    </div>
</div>
@endsection
```

### **2. Form with Validation**
```html
<form method="POST" action="{{ route('admin.photos.store') }}">
    @csrf
    
    <div class="form-group">
        <label for="title" class="form-label">Title</label>
        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror">
        @error('title')
            <div class="form-error">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Save Photo</button>
</form>
```

### **3. Data Table**
```html
<div class="card">
    <div class="card-header">
        <h3>Photo List</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($photos as $photo)
                <tr>
                    <td>{{ $photo->title }}</td>
                    <td><span class="badge badge-primary">{{ $photo->category }}</span></td>
                    <td>
                        <button class="btn btn-sm btn-info">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
```

## 📁 **File Structure**

```
public/css/
├── app.css                    # Main CSS file dengan design system
└── components/               # Component-specific CSS (future)

resources/views/
├── admin/layouts/
│   └── app.blade.php        # Admin layout template
├── user/layouts/
│   └── app.blade.php        # User layout template
└── layouts/
    └── app.blade.php        # Public layout template (future)
```

## 🔧 **Customization**

### **1. Color Override**
```css
:root {
    --primary-600: #your-color;
    --secondary-50: #your-bg-color;
}
```

### **2. Component Extension**
```css
.btn-custom {
    background: linear-gradient(45deg, var(--primary-600), var(--primary-700));
    border-radius: var(--radius-xl);
}
```

### **3. Layout Modification**
```css
.admin-layout .sidebar {
    width: 320px; /* Override default width */
}
```

## 📱 **Responsive Breakpoints**

```css
/* Mobile */
@media (max-width: 640px) { /* ... */ }

/* Tablet */
@media (max-width: 768px) { /* ... */ }

/* Desktop */
@media (max-width: 1024px) { /* ... */ }

/* Large Desktop */
@media (max-width: 1280px) { /* ... */ }
```

## 🎯 **Best Practices**

### **1. Consistency**
- Gunakan class yang sudah didefinisikan
- Jangan override CSS variables secara langsung
- Ikuti naming convention yang ada

### **2. Accessibility**
- Selalu gunakan semantic HTML
- Pastikan contrast ratio yang baik
- Test dengan screen reader

### **3. Performance**
- CSS variables untuk dynamic values
- Minimal CSS overrides
- Optimize untuk mobile

### **4. Maintenance**
- Update design system secara berkala
- Dokumentasikan perubahan
- Test di berbagai browser

## 🚀 **Getting Started**

### **1. Include CSS**
```html
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
```

### **2. Use Layout Template**
```html
@extends('admin.layouts.app')
```

### **3. Apply Classes**
```html
<button class="btn btn-primary btn-lg">Large Button</button>
```

## 🔮 **Future Enhancements**

- **CSS-in-JS** - Dynamic styling
- **Theme Switcher** - Manual theme toggle
- **Component Library** - React/Vue components
- **Design Tokens** - JSON-based tokens
- **Storybook** - Component documentation

---

**Status**: ✅ **IMPLEMENTED** - Design system yang konsisten telah dibuat dan siap digunakan di seluruh aplikasi.
