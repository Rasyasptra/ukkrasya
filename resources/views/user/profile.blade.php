<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil Saya - SMK Negeri 4 Bogor</title>
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
            align-items: center;
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

        .user-menu {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        /* Main Content */
        .main-content {
            padding-top: 80px;
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 24px;
            padding-right: 24px;
            padding-bottom: 60px;
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

        /* Profile Section */
        .profile-section {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 32px;
            margin-bottom: 32px;
        }

        .profile-card {
            background: #374151;
            border-radius: 16px;
            padding: 32px;
            border: 1px solid #4b5563;
            text-align: center;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 700;
            margin: 0 auto 24px;
            border: 4px solid #60a5fa;
            position: relative;
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-upload {
            position: relative;
            display: inline-block;
            margin: 0 auto 24px;
        }

        .avatar-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .avatar-upload-label {
            display: block;
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 700;
            margin: 0 auto 24px;
            border: 4px solid #60a5fa;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .avatar-upload-label:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }

        .avatar-upload-label img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-upload-text {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            font-size: 10px;
            padding: 4px;
            text-align: center;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 8px;
        }

        .profile-email {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-bottom: 24px;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #4b5563;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #60a5fa;
            display: block;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #94a3b8;
            margin-top: 4px;
        }

        /* Form Section */
        .form-section {
            background: #374151;
            border-radius: 16px;
            padding: 32px;
            border: 1px solid #4b5563;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid #4b5563;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            color: #d1d5db;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            background: #2d3748;
            border: 1px solid #4b5563;
            border-radius: 8px;
            color: #f1f5f9;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #60a5fa;
            background: #374151;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .btn-outline {
            background: transparent;
            color: #60a5fa;
            border: 1px solid #60a5fa;
        }

        .btn-outline:hover {
            background: #60a5fa;
            color: white;
        }

        /* Activity Section */
        .activity-section {
            background: #374151;
            border-radius: 16px;
            padding: 32px;
            border: 1px solid #4b5563;
            margin-top: 32px;
        }

        .activity-list {
            display: grid;
            gap: 16px;
        }

        .activity-item {
            background: #2d3748;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #4b5563;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            color: #d1d5db;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .activity-date {
            color: #94a3b8;
            font-size: 0.75rem;
        }

        /* Majors Section */
        .majors-section {
            background: #374151;
            border-radius: 16px;
            padding: 32px;
            border: 1px solid #4b5563;
            margin-top: 32px;
        }

        .majors-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .major-card {
            background: #2d3748;
            border: 1px solid #4b5563;
            border-radius: 12px;
            padding: 24px;
            display: flex;
            gap: 16px;
        }

        /* Alert */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 4px;
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

        .mobile-logo {
            font-size: 1.2rem;
            font-weight: 700;
            color: #3b82f6;
            text-decoration: none;
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

        /* Responsive */
        @media (max-width: 1024px) {
            .profile-section {
                grid-template-columns: 1fr;
            }
        }

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

            .profile-card {
                padding: 24px;
            }

            .profile-avatar {
                width: 100px;
                height: 100px;
                font-size: 40px;
            }

            .form-section {
                padding: 24px;
            }

            .section-title {
                font-size: 1.3rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .activity-section {
                padding: 24px;
            }

            .majors-section {
                padding: 24px;
            }

            .majors-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        @media (max-width: 480px) {
            .nav-container {
                padding: 10px 12px;
            }

            .logo {
                font-size: 1.1rem;
            }

            .page-title {
                font-size: 1.75rem;
            }

            .page-subtitle {
                font-size: 0.9rem;
            }

            .profile-card {
                padding: 20px;
            }

            .profile-avatar {
                width: 80px;
                height: 80px;
                font-size: 32px;
                margin-bottom: 16px;
            }

            .profile-name {
                font-size: 1.25rem;
            }

            .profile-stats {
                grid-template-columns: repeat(3, 1fr);
                gap: 12px;
                margin-top: 20px;
                padding-top: 20px;
            }

            .stat-number {
                font-size: 1.25rem;
            }

            .form-section {
                padding: 20px;
            }

            .section-title {
                font-size: 1.2rem;
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-input,
            .form-select,
            .form-textarea {
                padding: 10px 14px;
                font-size: 0.9rem;
            }

            .btn {
                padding: 10px 20px;
                font-size: 0.9rem;
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
                <li><a href="{{ route('information.page') }}">Informasi</a></li>
                @auth
                    <li><a href="{{ route('user.profile') }}" class="active">Profil</a></li>
                    <li class="user-menu">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('avatars/' . Auth::user()->avatar) }}" alt="Profile" class="user-avatar" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover;">
                        @else
                            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
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
            <a href="{{ route('home') }}" class="mobile-logo">
                <span style="color: #3b82f6;">SMK Negeri 4 Bogor</span>
            </a>
            <button class="mobile-nav-close" onclick="toggleMobileMenu()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <ul class="mobile-nav-links">
            <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a></li>
            <li><a href="{{ route('gallery.photos') }}"><i class="fas fa-images"></i> Galeri Foto</a></li>
            <li><a href="{{ route('information.page') }}"><i class="fas fa-info-circle"></i> Informasi</a></li>
            @auth
                <li><a href="{{ route('user.profile') }}" class="active"><i class="fas fa-user"></i> Profil</a></li>
            @else
                <li><a href="{{ route('user.login') }}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
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
            <h1 class="page-title">Profil Saya</h1>
            <p class="page-subtitle">Kelola informasi profil dan aktivitas Anda</p>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin-top: 8px; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Profile Section -->
        <div class="profile-section">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-avatar">
                    @if($user->avatar)
                        <img src="{{ asset('avatars/' . $user->avatar) }}" alt="Profile Photo">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <h2 class="profile-name">{{ $user->name }}</h2>
                <p class="profile-email">{{ $user->email }}</p>
                <div class="profile-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $totalLikes }}</span>
                        <span class="stat-label">Likes</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $totalComments }}</span>
                        <span class="stat-label">Komentar</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $likedPhotos }}</span>
                        <span class="stat-label">Foto Disukai</span>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="form-section">
                <h2 class="section-title">Edit Profil</h2>
                <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Avatar Upload -->
                    <div class="form-group" style="text-align: center; margin-bottom: 32px;">
                        <label class="form-label" style="display: block; margin-bottom: 16px;">Foto Profil</label>
                        <div class="avatar-upload">
                            <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewAvatar(event)">
                            <label for="avatar" class="avatar-upload-label">
                                @if($user->avatar)
                                    <img src="{{ asset('avatars/' . $user->avatar) }}" alt="Profile Photo">
                                @else
                                    <span>{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    <div class="avatar-upload-text">Ubah Foto</div>
                                @endif
                            </label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="gender" class="form-select">
                                <option value="">Pilih</option>
                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="birth_date" class="form-input" value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '') }}">
                        @error('birth_date')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-textarea" rows="3">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr style="border: none; border-top: 1px solid #4b5563; margin: 32px 0;">

                    <h3 class="section-title" style="font-size: 1.2rem; margin-bottom: 16px;">Ubah Password</h3>
                    <p style="color: #94a3b8; font-size: 0.85rem; margin-bottom: 24px;">Kosongkan jika tidak ingin mengubah password</p>

                    <div class="form-group">
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="current_password" class="form-input">
                        @error('current_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="new_password" class="form-input">
                            @error('new_password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-input">
                        </div>
                    </div>

                    <div style="display: flex; gap: 12px; margin-top: 32px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('gallery.photos') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>



        <!-- Activity Section -->
        <div class="activity-section">
            <h2 class="section-title">Aktivitas Terbaru</h2>
            
            <div class="activity-list">
                @forelse($recentLikes->merge($recentComments)->sortByDesc('created_at')->take(10) as $activity)
                    @if($activity instanceof \App\Models\Like)
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-text">
                                    Anda menyukai foto <strong>{{ $activity->photo->title ?? 'Foto' }}</strong>
                                </div>
                                <div class="activity-date">
                                    <i class="far fa-clock"></i> {{ $activity->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-text">
                                    Anda mengomentari foto <strong>{{ $activity->photo->title ?? 'Foto' }}</strong>
                                </div>
                                <div class="activity-date">
                                    <i class="far fa-clock"></i> {{ $activity->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div style="text-align: center; padding: 40px; color: #94a3b8;">
                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 16px; opacity: 0.5;"></i>
                        <p>Belum ada aktivitas</p>
                    </div>
                @endforelse
            </div>
        </div>

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

        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Preview avatar
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const avatarLabel = document.querySelector('.avatar-upload-label');
                    avatarLabel.innerHTML = `<img src="${e.target.result}" alt="Profile Photo">`;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>

