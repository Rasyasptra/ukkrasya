<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - SMK Negeri 4 Bogor</title>
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

        .logo img {
            height: 0.75rem;
            width: auto;
            object-fit: contain;
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

        .nav-links a:hover {
            color: #60a5fa;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.8) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 900px;
            color: white;
            padding: 0 24px;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 16px;
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 50%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 24px;
            color: #e2e8f0;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .hero-description {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 40px;
            color: #cbd5e1;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .hero-btn {
            padding: 16px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .hero-btn.primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .hero-btn.primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .hero-btn.secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .hero-btn.secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        .hero-navigation {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
            z-index: 3;
            padding: 0 40px;
        }

        .hero-nav-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .hero-nav-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .hero-indicators {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 3;
        }

        .indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .indicator.active {
            background: white;
            width: 32px;
            border-radius: 6px;
        }

        /* Informasi Section */
        .info-section {
            padding: 80px 24px;
            background: rgba(30, 41, 59, 0.5);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 16px;
            text-align: center;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #94a3b8;
            text-align: center;
            margin-bottom: 48px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
        }

        .info-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .info-card {
            background: #374151;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #4b5563;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .info-card-link:hover .info-card {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            border-color: #60a5fa;
        }

        .info-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 16px;
        }

        .info-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 8px;
        }

        .info-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-announcement { background: #dbeafe; color: #1e40af; }
        .badge-news { background: #dbeafe; color: #1e3a8a; }
        .badge-event { background: #dcfce7; color: #15803d; }
        .badge-general { background: #f1f5f9; color: #334155; }
        .badge-urgent { background: #fee2e2; color: #dc2626; }

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
        }

        /* Profile Section */
        .profile-section {
            padding: 80px 24px;
            background: rgba(30, 41, 59, 0.5);
        }

        .profile-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            margin-top: 48px;
        }

        .profile-card {
            background: #374151;
            border-radius: 16px;
            padding: 32px;
            border: 1px solid #4b5563;
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            border-color: #60a5fa;
        }

        .profile-card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .profile-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 16px;
        }

        .profile-card-content {
            color: #cbd5e1;
            line-height: 1.8;
            font-size: 1rem;
        }

        .profile-card-content ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .profile-card-content li {
            padding: 8px 0;
            padding-left: 24px;
            position: relative;
        }

        .profile-card-content li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #60a5fa;
            font-weight: bold;
        }

        .profile-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-top: 32px;
        }

        .profile-info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 12px;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .profile-info-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            font-size: 1.2rem;
        }

        .profile-info-text {
            flex: 1;
        }

        .profile-info-label {
            font-size: 0.85rem;
            color: #94a3b8;
            margin-bottom: 4px;
        }

        .profile-info-value {
            font-size: 0.95rem;
            color: #f1f5f9;
            font-weight: 500;
        }

        /* Photo Gallery Section */
        .photo-section {
            padding: 80px 24px;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .photo-card {
            background: #374151;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #4b5563;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .photo-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4);
            border-color: #60a5fa;
        }

        .photo-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .photo-card:hover .photo-image {
            transform: scale(1.05);
        }

        .photo-info {
            padding: 20px;
        }

        .photo-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 8px;
        }

        .photo-description {
            color: #cbd5e1;
            font-size: 0.9rem;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .photo-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid #4b5563;
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .photo-category {
            background: #dbeafe;
            color: #1e40af;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .view-all-btn {
            display: inline-block;
            margin-top: 32px;
            padding: 14px 32px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .view-all-btn:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .text-center {
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .hero-btn {
                width: 100%;
                max-width: 300px;
            }

            .nav-links {
                display: none;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .photo-grid {
                grid-template-columns: 1fr;
            }

            .profile-content {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .profile-info-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 60px 24px 30px;
            margin-top: 80px;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 48px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-section h3 i {
            color: #60a5fa;
        }

        .footer-section p,
        .footer-section li {
            color: #cbd5e1;
            line-height: 1.8;
            font-size: 0.95rem;
            margin-bottom: 12px;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li {
            padding-left: 24px;
            position: relative;
        }

        .footer-section ul li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #60a5fa;
            font-weight: bold;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #60a5fa;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-about {
            color: #cbd5e1;
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .social-links {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .social-link {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: #60a5fa;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .footer-contact-item {
            display: flex;
            align-items: start;
            gap: 12px;
            margin-bottom: 16px;
        }

        .footer-contact-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(59, 130, 246, 0.1);
            color: #60a5fa;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .footer-contact-text {
            flex: 1;
            color: #cbd5e1;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .footer-contact-text a {
            color: #60a5fa;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-contact-text a:hover {
            color: #93c5fd;
            text-decoration: underline;
        }

        .footer-map {
            width: 100%;
            height: 200px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(59, 130, 246, 0.2);
            margin-top: 12px;
        }

        .footer-map iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .footer-bottom {
            max-width: 1400px;
            margin: 0 auto;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .footer-bottom p {
            margin: 0;
        }

        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 32px;
            }
        }

        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .footer {
                padding: 40px 24px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('logo.png') }}" alt="SMK Negeri 4 Bogor" onerror="this.style.display='none';">
                SMK Negeri 4 Bogor
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('gallery.index') }}">Galeri Foto</a></li>
                <li><a href="{{ route('information.page') }}">Informasi</a></li>
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

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-slider">
            @if(isset($heroPhotos) && $heroPhotos->count() > 0)
                @foreach($heroPhotos as $index => $heroPhoto)
                    <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ $heroPhoto->photo_url }}" alt="{{ $heroPhoto->title }}" class="hero-image" onerror="this.src='{{ asset('images/no-image.png') }}';">
                    </div>
                @endforeach
                @if($heroPhotos->count() < 3)
                    @for($i = $heroPhotos->count(); $i < 3; $i++)
                        <div class="hero-slide">
                            <img src="{{ asset('images/no-image.png') }}" alt="Sekolah" class="hero-image">
                        </div>
                    @endfor
                @endif
            @else
                <div class="hero-slide active">
                    <img src="{{ asset('images/no-image.png') }}" alt="Sekolah" class="hero-image">
                </div>
                <div class="hero-slide">
                    <img src="{{ asset('images/no-image.png') }}" alt="Sekolah" class="hero-image">
                </div>
                <div class="hero-slide">
                    <img src="{{ asset('images/no-image.png') }}" alt="Sekolah" class="hero-image">
                </div>
            @endif
        </div>
        
        <div class="hero-overlay"></div>
        
        <div class="hero-content">
            <h1 class="hero-title">SMK Negeri 4 Bogor</h1>
            <p class="hero-subtitle">Sekolah Menengah Kejuruan Terdepan</p>
            <p class="hero-description">
                Membangun generasi yang kompeten, berkarakter, dan siap menghadapi tantangan masa depan 
                melalui pendidikan berkualitas dan teknologi terkini.
            </p>
        </div>
        
        <div class="hero-navigation">
            <button class="hero-nav-btn prev" onclick="changeSlide(-1)">‹</button>
            <button class="hero-nav-btn next" onclick="changeSlide(1)">›</button>
        </div>
        
        <div class="hero-indicators">
            @if(isset($heroPhotos) && $heroPhotos->count() > 0)
                @foreach($heroPhotos as $index => $heroPhoto)
                    <span class="indicator {{ $index === 0 ? 'active' : '' }}" onclick="currentSlide({{ $index + 1 }})"></span>
                @endforeach
                @if($heroPhotos->count() < 3)
                    @for($i = $heroPhotos->count(); $i < 3; $i++)
                        <span class="indicator" onclick="currentSlide({{ $i + 1 }})"></span>
                    @endfor
                @endif
            @else
                <span class="indicator active" onclick="currentSlide(1)"></span>
                <span class="indicator" onclick="currentSlide(2)"></span>
                <span class="indicator" onclick="currentSlide(3)"></span>
            @endif
        </div>
    </div>

    <!-- Profile Section -->
    <div class="profile-section">
        <div class="container">
            <h2 class="section-title">Profil Sekolah</h2>
            <p class="section-subtitle">Mengenal lebih dekat SMK Negeri 4 Bogor</p>
            
            <div class="profile-content">
                <!-- Visi -->
                <div class="profile-card">
                    <div class="profile-card-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="profile-card-title">Visi</h3>
                    <div class="profile-card-content">
                        <p>Menjadi sekolah yang <strong>tangguh dalam IMTAQ</strong>, cerdas, terampil, mandiri, berbasis <strong>Teknologi Informasi dan Komunikasi</strong>, dan <strong>berwawasan lingkungan</strong>.</p>
                    </div>
                </div>

                <!-- Misi -->
                <div class="profile-card">
                    <div class="profile-card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="profile-card-title">Misi</h3>
                    <div class="profile-card-content">
                        <ul>
                            <li>Menumbuhkan sikap agama dan spiritualitas</li>
                            <li>Mengembangkan literasi sesuai kompetensi siswa</li>
                            <li>Meningkatkan keterampilan kompetensi sesuai jurusan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Info Sekolah -->
            <div class="profile-info-grid">
                <div class="profile-info-item">
                    <div class="profile-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="profile-info-text">
                        <div class="profile-info-label">Alamat</div>
                        <div class="profile-info-value">Kp. Buntar, Muarasari, Bogor Selatan</div>
                    </div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="profile-info-text">
                        <div class="profile-info-label">Telepon</div>
                        <div class="profile-info-value">(0251) 7547381</div>
                    </div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="profile-info-text">
                        <div class="profile-info-label">Email</div>
                        <div class="profile-info-value">smkn4@smkn4bogor.sch.id</div>
                    </div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="profile-info-text">
                        <div class="profile-info-label">Akreditasi</div>
                        <div class="profile-info-value">A (Sangat Baik)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo Gallery Section -->
    @if($photos->count() > 0)
    <div class="photo-section">
        <div class="container">
            <h2 class="section-title">Galeri Foto Terbaru</h2>
            <p class="section-subtitle">Dokumentasi kegiatan dan momen terbaik di sekolah</p>
            
            <div class="photo-grid">
                @foreach($photos as $photo)
                <div class="photo-card" onclick="window.location.href='{{ route('gallery.index') }}'">
                    <img src="{{ $photo->photo_url }}" alt="{{ $photo->title }}" class="photo-image">
                    <div class="photo-info">
                        <h3 class="photo-title">{{ $photo->title }}</h3>
                        <p class="photo-description">{{ Str::limit($photo->description, 100) }}</p>
                        <div class="photo-meta">
                            <span><i class="far fa-calendar"></i> {{ $photo->created_at->format('d M Y') }}</span>
                            @if($photo->category)
                                <span class="photo-category">
                                    {{ \App\Helpers\CategoryHelper::getCategoryName($photo->category) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center">
                <a href="{{ route('gallery.index') }}" class="view-all-btn">
                    <i class="fas fa-images"></i> Lihat Semua Foto
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Informasi Section -->
    @if($informations->count() > 0)
    <div class="info-section">
        <div class="container">
            <h2 class="section-title">Informasi Sekolah</h2>
            <p class="section-subtitle">Berita dan pengumuman terbaru dari sekolah</p>
            
            <div class="info-grid">
                @foreach($informations as $info)
                <a href="{{ route('information.page') }}" class="info-card-link">
                    <div class="info-card">
                        <div class="info-header">
                            <div>
                                <h3 class="info-title">{{ $info->title }}</h3>
                                <div class="info-badges">
                                    <span class="badge badge-{{ $info->type }}">
                                        @if($info->type == 'announcement') Pengumuman
                                        @elseif($info->type == 'news') Berita
                                        @elseif($info->type == 'event') Acara
                                        @else Umum
                                        @endif
                                    </span>
                                    @if($info->priority == 'urgent')
                                        <span class="badge badge-urgent">Urgent</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <p class="info-content">{{ Str::limit($info->content, 150) }}</p>
                        <div class="info-meta">
                            <span><i class="far fa-calendar"></i> {{ $info->created_at->format('d M Y') }}</span>
                            @if($info->expires_at)
                                <span><i class="far fa-clock"></i> Berlaku hingga {{ $info->expires_at->format('d M Y') }}</span>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <!-- About Section -->
            <div class="footer-section">
                <div class="footer-logo">
                    <i class="fas fa-graduation-cap"></i>
                    SMK Negeri 4 Bogor
                </div>
                <p class="footer-about">
                    Sekolah Menengah Kejuruan yang berkomitmen membangun generasi yang kompeten, berkarakter, dan siap menghadapi tantangan masa depan melalui pendidikan berkualitas.
                </p>
                <div class="social-links">
                    <a href="https://www.instagram.com/smkn4kotabogor?igsh=Z2t1NWo3Z29mdTU=" target="_blank" rel="noopener noreferrer" class="social-link" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://youtube.com/@smknegeri4bogor905?si=e0FyMdqAh7AjbWps" target="_blank" rel="noopener noreferrer" class="social-link" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://www.facebook.com/smkn4bogor" target="_blank" rel="noopener noreferrer" class="social-link" title="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://smkn4bogor.sch.id" target="_blank" rel="noopener noreferrer" class="social-link" title="Website">
                        <i class="fas fa-globe"></i>
                    </a>
                </div>
            </div>

            <!-- Visi Misi Section -->
            <div class="footer-section">
                <h3><i class="fas fa-bullseye"></i> Visi & Misi</h3>
                <div>
                    <p style="font-weight: 600; color: #60a5fa; margin-bottom: 8px;">Visi:</p>
                    <p style="font-size: 0.9rem; margin-bottom: 16px;">Menjadi sekolah yang tangguh dalam IMTAQ, cerdas, terampil, mandiri, berbasis TIK, dan berwawasan lingkungan.</p>
                    
                    <p style="font-weight: 600; color: #60a5fa; margin-bottom: 8px;">Misi:</p>
                    <ul>
                        <li>Menumbuhkan sikap agama dan spiritualitas</li>
                        <li>Mengembangkan literasi sesuai kompetensi</li>
                        <li>Meningkatkan keterampilan kompetensi</li>
                    </ul>
                </div>
            </div>

            <!-- Quick Links Section -->
            <div class="footer-section">
                <h3><i class="fas fa-link"></i> Tautan Cepat</h3>
                <ul>
                    <li><a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none; transition: color 0.3s;">Beranda</a></li>
                    <li><a href="{{ route('gallery.index') }}" style="color: #cbd5e1; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#60a5fa'" onmouseout="this.style.color='#cbd5e1'">Galeri Foto</a></li>
                    <li><a href="{{ route('information.page') }}" style="color: #cbd5e1; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#60a5fa'" onmouseout="this.style.color='#cbd5e1'">Informasi</a></li>
                    <li><a href="{{ route('user.login') }}" style="color: #cbd5e1; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#60a5fa'" onmouseout="this.style.color='#cbd5e1'">Login</a></li>
                    <li><a href="{{ route('register') }}" style="color: #cbd5e1; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#60a5fa'" onmouseout="this.style.color='#cbd5e1'">Daftar</a></li>
                </ul>
            </div>

            <!-- Contact & Maps Section -->
            <div class="footer-section">
                <h3><i class="fas fa-map-marker-alt"></i> Kontak & Lokasi</h3>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="footer-contact-text">
                        Kp. Buntar, Kelurahan Muarasari<br>
                        Kecamatan Bogor Selatan<br>
                        Kota Bogor, Jawa Barat 16137
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="footer-contact-text">
                        <a href="tel:02517547381">(0251) 7547381</a>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="footer-contact-text">
                        <a href="mailto:smkn4@smkn4bogor.sch.id">smkn4@smkn4bogor.sch.id</a>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="footer-contact-text">
                        <a href="https://smkn4bogor.sch.id" target="_blank" rel="noopener noreferrer">smkn4bogor.sch.id</a>
                    </div>
                </div>
                <div class="footer-map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5!2d106.82492993439769!3d-6.640600189306717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMzgnMjYuMiJTIDEwNsKwNDknMjkuNyJF!5e0!3m2!1sid!2sid!4v1699000000000!5m2!1sid!2sid"
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi SMK Negeri 4 Bogor">
                    </iframe>
                    <a href="https://www.google.com/maps?q=-6.640600189306717,106.82492993439769" target="_blank" rel="noopener noreferrer" style="display: block; margin-top: 8px; color: #60a5fa; text-decoration: none; font-size: 0.85rem; text-align: center;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                        <i class="fas fa-external-link-alt"></i> Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} SMK Negeri 4 Bogor. All rights reserved. | Akreditasi: A (Sangat Baik)</p>
        </div>
    </footer>

    <script>
        // Hero Slider
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const indicators = document.querySelectorAll('.indicator');

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));
            
            if (index >= slides.length) currentSlideIndex = 0;
            if (index < 0) currentSlideIndex = slides.length - 1;
            
            slides[currentSlideIndex].classList.add('active');
            indicators[currentSlideIndex].classList.add('active');
        }

        function changeSlide(direction) {
            currentSlideIndex += direction;
            showSlide(currentSlideIndex);
        }

        function currentSlide(index) {
            currentSlideIndex = index - 1;
            showSlide(currentSlideIndex);
        }

        // Auto slide
        setInterval(() => {
            currentSlideIndex++;
            showSlide(currentSlideIndex);
        }, 5000);
    </script>
</body>
</html>
