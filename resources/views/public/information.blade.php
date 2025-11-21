<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Sekolah - Web Gallery Sekolah</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
</head>
<body>
    <div class="public-layout">
        <!-- Header -->
        <header class="public-header">
            <div class="container">
                <div class="header-content">
                    <div class="header-brand">
                        <a href="{{ route('home') }}" class="brand-link">
                            <div class="brand-logo"><i class="fas fa-school"></i></div>
                            <span class="brand-text">Web Gallery Sekolah</span>
                        </a>
                    </div>
                    
                    <nav class="header-nav">
                        <a href="{{ route('home') }}" class="nav-link">Beranda</a>
                        <a href="{{ route('gallery.index') }}" class="nav-link">Galeri</a>
                        <a href="{{ route('public.information') }}" class="nav-link active">Informasi</a>
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Page Header -->
            <section class="page-hero">
                <div class="container">
                    <div class="hero-content">
                        <h1 class="hero-title">Informasi Sekolah</h1>
                        <p class="hero-description">Lihat semua informasi dan pengumuman terbaru dari sekolah</p>
                    </div>
                </div>
            </section>

            <!-- Information Content -->
            <section class="information-section">
                <div class="container">
                    <!-- Filter Section -->
                    <div class="filter-section">
                        <div class="filter-controls">
                            <div class="filter-group">
                                <label for="type-filter" class="filter-label">Tipe Informasi:</label>
                                <select id="type-filter" class="form-control">
                                    <option value="">Semua Tipe</option>
                                    <option value="announcement">Pengumuman</option>
                                    <option value="news">Berita</option>
                                    <option value="event">Event</option>
                                    <option value="general">Umum</option>
                                </select>
                            </div>
                            
                            <div class="filter-group">
                                <label for="priority-filter" class="filter-label">Prioritas:</label>
                                <select id="priority-filter" class="form-control">
                                    <option value="">Semua Prioritas</option>
                                    <option value="urgent">Urgent</option>
                                    <option value="high">Tinggi</option>
                                    <option value="medium">Sedang</option>
                                    <option value="low">Rendah</option>
                                </select>
                            </div>
                            
                            <div class="filter-group">
                                <label for="search-input" class="filter-label">Cari:</label>
                                <input type="text" id="search-input" class="form-control" placeholder="Cari informasi...">
                            </div>
                        </div>
                    </div>

                    <!-- Information List -->
                    <div class="information-list">
                        @php
                            $informations = App\Models\Information::where('is_published', true)
                                ->where(function($query) {
                                    $query->whereNull('expires_at')
                                          ->orWhere('expires_at', '>', now());
                                })
                                ->orderBy('priority', 'desc')
                                ->orderBy('created_at', 'desc')
                                ->get();
                        @endphp
                        
                        @if($informations->count() > 0)
                            <div class="info-grid">
                                @foreach($informations as $info)
                                <div class="info-card" 
                                     data-type="{{ $info->type }}" 
                                     data-priority="{{ $info->priority }}"
                                     data-title="{{ strtolower($info->title) }}"
                                     data-content="{{ strtolower($info->content) }}">
                                    <div class="info-header">
                                        <span class="info-type badge badge-{{ $info->type === 'announcement' ? 'warning' : ($info->type === 'news' ? 'info' : 'secondary') }}">
                                            {{ ucfirst($info->type) }}
                                        </span>
                                        <span class="info-priority badge badge-{{ $info->priority === 'urgent' ? 'danger' : ($info->priority === 'high' ? 'warning' : 'success') }}">
                                            {{ ucfirst($info->priority) }}
                                        </span>
                                    </div>
                                    
                                    <div class="info-content">
                                        <h3 class="info-title">{{ $info->title }}</h3>
                                        <p class="info-text">{{ $info->content }}</p>
                                        
                                        @if($info->expires_at)
                                            <div class="info-expiry">
                                                <i class="fas fa-clock"></i>
                                                <span>Berlaku hingga: {{ $info->expires_at->format('d M Y H:i') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="info-footer">
                                        <div class="info-meta">
                                            <small>
                                                <i class="fas fa-calendar"></i>
                                                {{ $info->created_at->format('d M Y') }}
                                            </small>
                                            <small>
                                                <i class="fas fa-user"></i>
                                                {{ $info->creator->name ?? 'Admin' }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-bullhorn" style="font-size: 4rem; opacity: 0.5;"></i></div>
                                <h3>Belum ada informasi</h3>
                                <p>Informasi sekolah akan muncul di sini setelah admin membuat pengumuman</p>
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Login sebagai Admin
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="public-footer">
            <div class="container">
                    <div class="footer-content">
                        <div class="footer-brand">
                            <div class="brand-logo"><i class="fas fa-school"></i></div>
                            <div class="brand-info">
                            <h3>Web Gallery Sekolah</h3>
                            <p>Portal galeri foto digital untuk sekolah</p>
                        </div>
                    </div>
                    
                    <div class="footer-links">
                        <div class="link-group">
                            <h4>Menu Utama</h4>
                            <ul>
                                <li><a href="{{ route('home') }}">Beranda</a></li>
                                <li><a href="{{ route('gallery.index') }}">Galeri Foto</a></li>
                                <li><a href="{{ route('public.information') }}">Informasi</a></li>
                            </ul>
                        </div>
                        
                        <div class="link-group">
                            <h4>Akses</h4>
                            <ul>
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <p>&copy; 2024 Web Gallery Sekolah. Hak Cipta Dilindungi.</p>
                </div>
            </div>
        </footer>
    </div>

    <style>
    .public-layout {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Header */
    .public-header {
        background: white;
        border-bottom: 1px solid var(--secondary-200);
        box-shadow: var(--shadow-sm);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: var(--spacing-4) 0;
    }

    .header-brand {
        display: flex;
        align-items: center;
    }

    .brand-link {
        display: flex;
        align-items: center;
        gap: var(--spacing-3);
        text-decoration: none;
        color: inherit;
    }

    .brand-logo {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }

    .brand-text {
        font-size: var(--font-size-lg);
        font-weight: var(--font-weight-semibold);
        color: var(--secondary-900);
    }

    .header-nav {
        display: flex;
        gap: var(--spacing-6);
    }

    .nav-link {
        padding: var(--spacing-2) var(--spacing-4);
        color: var(--secondary-600);
        text-decoration: none;
        border-radius: var(--radius-md);
        transition: all var(--transition-fast);
        font-weight: var(--font-weight-medium);
    }

    .nav-link:hover {
        background-color: var(--secondary-50);
        color: var(--primary-600);
    }

    .nav-link.active {
        background-color: var(--primary-50);
        color: var(--primary-700);
    }

    /* Page Hero */
    .page-hero {
        background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
        color: white;
        padding: var(--spacing-16) 0;
        text-align: center;
    }

    .hero-title {
        font-size: var(--font-size-4xl);
        font-weight: var(--font-weight-bold);
        margin: 0 0 var(--spacing-4) 0;
    }

    .hero-description {
        font-size: var(--font-size-xl);
        margin: 0;
        opacity: 0.9;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        background-color: var(--secondary-50);
    }

    .information-section {
        padding: var(--spacing-12) 0;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: var(--radius-lg);
        padding: var(--spacing-6);
        margin-bottom: var(--spacing-8);
        border: 1px solid var(--secondary-200);
    }

    .filter-controls {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: var(--spacing-4);
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-label {
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        color: var(--secondary-700);
        margin-bottom: var(--spacing-2);
    }

    /* Information List */
    .information-list {
        margin-bottom: var(--spacing-8);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: var(--spacing-6);
    }

    .info-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--secondary-200);
        overflow: hidden;
        transition: all var(--transition-normal);
        box-shadow: var(--shadow-sm);
    }

    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-300);
    }

    .info-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: var(--spacing-4);
        background: var(--secondary-50);
        border-bottom: 1px solid var(--secondary-200);
    }

    .info-type,
    .info-priority {
        font-size: var(--font-size-xs);
        padding: var(--spacing-1) var(--spacing-2);
        border-radius: var(--radius-sm);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: var(--font-weight-medium);
    }

    /* Badge colors for Bootstrap compatibility */
    .badge-success {
        background-color: #f0f9ff !important;
        color: #0c4a6e !important;
        border: 1px solid #7dd3fc;
    }

    .info-content {
        padding: var(--spacing-6);
    }

    .info-title {
        font-size: var(--font-size-xl);
        font-weight: var(--font-weight-semibold);
        color: var(--secondary-900);
        margin: 0 0 var(--spacing-4) 0;
        line-height: 1.3;
    }

    .info-text {
        font-size: var(--font-size-base);
        color: var(--secondary-700);
        line-height: 1.6;
        margin: 0 0 var(--spacing-4) 0;
    }

    .info-expiry {
        display: flex;
        align-items: center;
        gap: var(--spacing-2);
        padding: var(--spacing-3);
        background: var(--warning-50);
        border: 1px solid var(--warning-200);
        border-radius: var(--radius-md);
        color: var(--warning-700);
        font-size: var(--font-size-sm);
    }

    .info-footer {
        padding: var(--spacing-4);
        background: var(--secondary-50);
        border-top: 1px solid var(--secondary-200);
    }

    .info-meta {
        display: flex;
        justify-content: space-between;
        font-size: var(--font-size-xs);
        color: var(--secondary-600);
    }

    .info-meta small {
        display: flex;
        align-items: center;
        gap: var(--spacing-1);
    }

    .empty-state {
        text-align: center;
        padding: var(--spacing-12);
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--secondary-200);
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: var(--spacing-4);
    }

    .empty-state h3 {
        font-size: var(--font-size-xl);
        color: var(--secondary-700);
        margin: 0 0 var(--spacing-2) 0;
    }

    .empty-state p {
        color: var(--secondary-500);
        margin: 0 0 var(--spacing-4) 0;
    }

    /* Footer */
    .public-footer {
        background: white;
        border-top: 1px solid var(--secondary-200);
        margin-top: auto;
    }

    .footer-content {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: var(--spacing-8);
        padding: var(--spacing-8) 0;
    }

    .footer-brand {
        display: flex;
        align-items: flex-start;
        gap: var(--spacing-4);
    }

    .footer-brand .brand-logo {
        width: 48px;
        height: 48px;
        font-size: 24px;
    }

    .footer-brand h3 {
        font-size: var(--font-size-lg);
        margin-bottom: var(--spacing-2);
    }

    .footer-brand p {
        color: var(--secondary-600);
        margin: 0;
    }

    .footer-links {
        display: flex;
        gap: var(--spacing-8);
    }

    .link-group h4 {
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-semibold);
        color: var(--secondary-900);
        margin-bottom: var(--spacing-3);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .link-group ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .link-group li {
        margin-bottom: var(--spacing-2);
    }

    .link-group a {
        color: var(--secondary-600);
        text-decoration: none;
        font-size: var(--font-size-sm);
        transition: color var(--transition-fast);
    }

    .link-group a:hover {
        color: var(--primary-600);
    }

    .footer-bottom {
        padding: var(--spacing-4) 0;
        border-top: 1px solid var(--secondary-200);
        text-align: center;
    }

    .footer-bottom p {
        color: var(--secondary-500);
        font-size: var(--font-size-sm);
        margin: 0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: var(--spacing-4);
        }
        
        .header-nav {
            gap: var(--spacing-3);
        }
        
        .hero-title {
            font-size: var(--font-size-3xl);
        }
        
        .hero-description {
            font-size: var(--font-size-lg);
        }
        
        .filter-controls {
            grid-template-columns: 1fr;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .footer-content {
            grid-template-columns: 1fr;
            gap: var(--spacing-6);
            text-align: center;
        }
        
        .footer-links {
            justify-content: center;
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        .public-header,
        .filter-section,
        .info-card,
        .empty-state,
        .public-footer {
            background: var(--secondary-100);
            border-color: var(--secondary-200);
        }
        
        .info-header,
        .info-footer {
            background: var(--secondary-200);
            border-color: var(--secondary-300);
        }
    }
    </style>

    <script>
    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const typeFilter = document.getElementById('type-filter');
        const priorityFilter = document.getElementById('priority-filter');
        const searchInput = document.getElementById('search-input');
        const infoCards = document.querySelectorAll('.info-card');
        
        function filterCards() {
            const typeValue = typeFilter.value.toLowerCase();
            const priorityValue = priorityFilter.value.toLowerCase();
            const searchValue = searchInput.value.toLowerCase();
            
            infoCards.forEach(card => {
                const type = card.dataset.type;
                const priority = card.dataset.priority;
                const title = card.dataset.title;
                const content = card.dataset.content;
                
                const typeMatch = !typeValue || type === typeValue;
                const priorityMatch = !priorityValue || priority === priorityValue;
                const searchMatch = !searchValue || 
                    title.includes(searchValue) || 
                    content.includes(searchValue);
                
                if (typeMatch && priorityMatch && searchMatch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        typeFilter.addEventListener('change', filterCards);
        priorityFilter.addEventListener('change', filterCards);
        searchInput.addEventListener('input', filterCards);
    });
    </script>
</body>
</html>

