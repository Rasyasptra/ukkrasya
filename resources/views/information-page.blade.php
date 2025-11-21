<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Sekolah - SMK Negeri 4 Bogor</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #f1f5f9;
            min-height: 100vh;
        }

        /* Navigation */
        nav {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.5rem;
            font-weight: 700;
            color: #3b82f6;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            color: #d1d5db;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #60a5fa;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #d1d5db;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 8px;
            transition: color 0.3s ease;
        }

        .mobile-menu-toggle:hover {
            color: #60a5fa;
        }

        /* Mobile Menu Overlay */
        .mobile-nav-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 998;
        }

        .mobile-nav-overlay.active {
            display: block;
        }

        /* Mobile Navigation */
        .mobile-nav {
            display: none;
            position: fixed;
            top: 0;
            right: -100%;
            width: 280px;
            height: 100%;
            background: rgba(30, 41, 59, 0.98);
            backdrop-filter: blur(10px);
            z-index: 999;
            transition: right 0.3s ease;
            overflow-y: auto;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.3);
        }

        .mobile-nav.active {
            right: 0;
        }

        .mobile-nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .mobile-nav-close {
            background: none;
            border: none;
            color: #d1d5db;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 8px;
            transition: color 0.3s ease;
        }

        .mobile-nav-close:hover {
            color: #60a5fa;
        }

        .mobile-nav-links {
            list-style: none;
            padding: 20px 0;
        }

        .mobile-nav-links li {
            margin: 0;
        }

        .mobile-nav-links a,
        .mobile-nav-links button {
            display: block;
            padding: 16px 20px;
            color: #d1d5db;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            font-size: 1rem;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        .mobile-nav-links a:hover,
        .mobile-nav-links button:hover,
        .mobile-nav-links a.active {
            color: #60a5fa;
            background: rgba(59, 130, 246, 0.1);
            border-left-color: #60a5fa;
        }

        .mobile-user-section {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }

        .mobile-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .mobile-user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        /* Main Content */
        .main-content {
            padding-top: 80px;
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 24px;
            padding-right: 24px;
        }

        .page-header {
            text-align: center;
            padding: 60px 0 40px;
        }

        .page-title {
            font-family: 'Poppins', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 16px;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: #94a3b8;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Filter Section */
        .filter-section {
            background: #374151;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
            border: 1px solid #4b5563;
        }

        .filter-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .filter-btn {
            padding: 10px 20px;
            border: 1px solid #6b7280;
            border-radius: 8px;
            background: #4b5563;
            color: #f1f5f9;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }

        /* Information Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
            margin-bottom: 60px;
        }

        .info-card {
            background: #374151;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #4b5563;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
            border-color: #60a5fa;
        }

        .info-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .info-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-announcement {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-news {
            background: #dbeafe;
            color: #1e3a8a;
        }

        .badge-event {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-general {
            background: #f1f5f9;
            color: #334155;
        }

        .badge-urgent {
            background: #fee2e2;
            color: #dc2626;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .info-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .info-content {
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .info-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid #4b5563;
            font-size: 0.85rem;
            color: #94a3b8;
            flex-wrap: wrap;
            gap: 8px;
        }

        .info-date {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-expires {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #fbbf24;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 24px;
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 24px;
            opacity: 0.5;
        }

        .empty-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 12px;
        }

        .empty-text {
            font-size: 1rem;
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                padding: 12px 16px;
            }

            .logo {
                font-size: 1.2rem;
            }

            .nav-links {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .mobile-nav {
                display: block;
            }

            .main-content {
                padding-left: 16px;
                padding-right: 16px;
            }

            .page-header {
                padding: 40px 0 30px;
            }

            .page-title {
                font-size: 2rem;
                line-height: 1.2;
            }

            .page-subtitle {
                font-size: 1rem;
            }

            .filter-section {
                padding: 16px;
            }

            .filter-buttons {
                justify-content: flex-start;
            }

            .filter-btn {
                font-size: 0.9rem;
                padding: 8px 16px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .info-card {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.75rem;
            }

            .page-subtitle {
                font-size: 0.9rem;
            }

            .filter-btn {
                font-size: 0.85rem;
                padding: 8px 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <span style="color: #3b82f6;">SMK Negeri 4 Bogor</span>
            </a>
            
            <!-- Desktop Navigation -->
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('gallery.photos') }}">Galeri Foto</a></li>
                <li><a href="{{ route('information.page') }}" class="active">Informasi</a></li>
                @auth
                    <li><a href="{{ route('user.profile') }}">Profil</a></li>
                    @if(Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                    @endif
                    <li class="user-menu" style="display: flex; align-items: center; gap: 12px;">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('avatars/' . Auth::user()->avatar) }}" alt="Profile" class="user-avatar" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                        @else
                            <div class="user-avatar" style="width: 32px; height: 32px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 12px;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <form action="{{ route('gallery.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: #d1d5db; cursor: pointer; font-weight: 500; font-size: 0.95rem;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('user.login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Daftar</a></li>
                @endauth
            </ul>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Navigation Overlay -->
    <div class="mobile-nav-overlay" onclick="toggleMobileMenu()"></div>

    <!-- Mobile Navigation -->
    <div class="mobile-nav">
        <div class="mobile-nav-header">
            <a href="{{ route('home') }}" class="logo">
                <span style="color: #3b82f6;">SMK Negeri 4 Bogor</span>
            </a>
            <button class="mobile-nav-close" onclick="toggleMobileMenu()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <ul class="mobile-nav-links">
            <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a></li>
            <li><a href="{{ route('gallery.photos') }}"><i class="fas fa-images"></i> Galeri Foto</a></li>
            <li><a href="{{ route('information.page') }}" class="active"><i class="fas fa-info-circle"></i> Informasi</a></li>
            @auth
                <li><a href="{{ route('user.profile') }}"><i class="fas fa-user"></i> Profil</a></li>
                @if(Auth::user()->role === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</a></li>
                @endif
            @else
                <li><a href="{{ route('user.login') }}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Daftar</a></li>
            @endauth
        </ul>

        @auth
        <div class="mobile-user-section">
            <div class="mobile-user-info">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('avatars/' . Auth::user()->avatar) }}" alt="Profile" class="mobile-user-avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                @else
                    <div class="mobile-user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <div style="color: #f1f5f9; font-weight: 600; font-size: 0.95rem;">{{ Auth::user()->name }}</div>
                    <div style="color: #94a3b8; font-size: 0.85rem;">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <form action="{{ route('gallery.logout') }}" method="POST">
                @csrf
                <button type="submit" style="width: 100%; padding: 12px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
        @endauth
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Informasi Sekolah</h1>
            <p class="page-subtitle">Berita, pengumuman, dan informasi terbaru dari sekolah</p>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-buttons">
                <button class="filter-btn active" onclick="filterInfo('all')">
                    <i class="fas fa-th"></i> Semua
                </button>
                <button class="filter-btn" onclick="filterInfo('announcement')">
                    <i class="fas fa-bullhorn"></i> Pengumuman
                </button>
                <button class="filter-btn" onclick="filterInfo('news')">
                    <i class="fas fa-newspaper"></i> Berita
                </button>
                <button class="filter-btn" onclick="filterInfo('event')">
                    <i class="fas fa-calendar-alt"></i> Acara
                </button>
                <button class="filter-btn" onclick="filterInfo('general')">
                    <i class="fas fa-info-circle"></i> Umum
                </button>
            </div>
        </div>

        <!-- Information Grid -->
        @if($informations->count() > 0)
            <div class="info-grid" id="infoGrid">
                @foreach($informations as $info)
                    <div class="info-card" data-type="{{ $info->type }}">
                        <div class="info-header">
                            <div class="info-badges">
                                <span class="badge badge-{{ $info->type }}">
                                    @if($info->type == 'announcement')
                                        <i class="fas fa-bullhorn"></i> Pengumuman
                                    @elseif($info->type == 'news')
                                        <i class="fas fa-newspaper"></i> Berita
                                    @elseif($info->type == 'event')
                                        <i class="fas fa-calendar-alt"></i> Acara
                                    @else
                                        <i class="fas fa-info-circle"></i> Umum
                                    @endif
                                </span>
                                @if($info->priority == 'urgent')
                                    <span class="badge badge-urgent">
                                        <i class="fas fa-exclamation-circle"></i> Urgent
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h3 class="info-title">{{ $info->title }}</h3>
                        <p class="info-content">{{ Str::limit($info->content, 200) }}</p>
                        <div class="info-meta">
                            <span class="info-date">
                                <i class="far fa-calendar"></i>
                                {{ $info->created_at->format('d M Y') }}
                            </span>
                            @if($info->expires_at)
                                <span class="info-expires">
                                    <i class="far fa-clock"></i>
                                    Berlaku hingga {{ $info->expires_at->format('d M Y') }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-bullhorn" style="font-size: 4rem; opacity: 0.5;"></i></div>
                <h2 class="empty-title">Belum Ada Informasi</h2>
                <p class="empty-text">Informasi sekolah akan ditampilkan di sini</p>
            </div>
        @endif
    </div>

    <script>
        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const mobileNav = document.querySelector('.mobile-nav');
            const overlay = document.querySelector('.mobile-nav-overlay');
            mobileNav.classList.toggle('active');
            overlay.classList.toggle('active');
            
            // Prevent body scroll when menu is open
            if (mobileNav.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.mobile-nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                toggleMobileMenu();
            });
        });

        // Filter information cards
        function filterInfo(type) {
            const cards = document.querySelectorAll('.info-card');
            const buttons = document.querySelectorAll('.filter-btn');
            
            // Update active button
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.closest('.filter-btn').classList.add('active');
            
            // Filter cards
            cards.forEach(card => {
                if (type === 'all' || card.dataset.type === type) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
