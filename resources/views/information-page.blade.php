<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Sekolah - SMK Negeri 4 Bogor</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            color: #60a5fa;
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
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 50%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
            .page-title {
                font-size: 2rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }

            .filter-buttons {
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <i class="fas fa-graduation-cap"></i>
                SMK Negeri 4 Bogor
            </a>
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
                        <div class="user-avatar" style="width: 32px; height: 32px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 12px;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
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
        </div>
    </nav>

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
