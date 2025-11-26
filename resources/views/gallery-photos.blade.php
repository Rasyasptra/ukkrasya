<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Galeri Foto - SMK Negeri 4 Bogor</title>
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
            color: #ffffff;
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
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: #94a3b8;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Stats Overview */
        .stats-overview {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 48px;
        }

        .stat-card {
            background: #374151;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            border: 1px solid #4b5563;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            background: #4b5563;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #60a5fa;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #d1d5db;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Search Section */
        .search-section {
            background: #374151;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
            border: 1px solid #4b5563;
        }

        .search-form {
            display: grid;
            grid-template-columns: 2fr 1fr auto auto;
            gap: 16px;
            align-items: center;
        }

        .search-input {
            padding: 12px 16px;
            border: 1px solid #6b7280;
            border-radius: 8px;
            background: #4b5563;
            color: #f1f5f9;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #60a5fa;
            background: #374151;
        }

        .search-btn {
            padding: 12px 24px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-1px);
        }

        .clear-btn {
            padding: 12px 24px;
            background: #6b7280;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .clear-btn:hover {
            background: #4b5563;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 60px;
        }

        .photo-card {
            background: #374151;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #4b5563;
            transition: all 0.3s ease;
        }

        .photo-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
            border-color: #60a5fa;
        }

        .photo-image-wrapper {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .photo-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .photo-image-wrapper:hover .photo-image {
            transform: scale(1.05);
        }

        .photo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .photo-overlay i {
            font-size: 2rem;
            color: white;
        }

        .photo-image-wrapper:hover .photo-overlay {
            opacity: 1;
        }

        .photo-info {
            padding: 16px;
        }

        .photo-actions {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #4b5563;
            display: flex;
            gap: 8px;
        }

        .like-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: #374151;
            color: #94a3b8;
            border: 1px solid #4b5563;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
            justify-content: center;
        }

        .like-btn:hover {
            background: #4b5563;
            border-color: #ef4444;
            color: #ef4444;
            transform: translateY(-1px);
        }

        .like-btn.liked {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border-color: #ef4444;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
            animation: heartPulse 2s ease-in-out infinite;
        }

        .like-btn.liked:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.5);
        }

        .like-btn.liked i {
            animation: heartBeat 0.6s ease;
        }

        @keyframes heartPulse {
            0%, 100% {
                box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
            }
            50% {
                box-shadow: 0 4px 16px rgba(239, 68, 68, 0.6);
            }
        }

        .like-btn i {
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .like-btn:hover i {
            transform: scale(1.2);
        }

        .like-btn.liked i {
            animation: heartBeat 0.5s ease;
        }

        .like-btn:disabled {
            opacity: 0.6;
            cursor: wait;
        }

        .like-btn .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes heartBeat {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.3); }
            50% { transform: scale(1.1); }
        }

        .download-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
            flex: 1;
            justify-content: center;
        }

        .download-btn:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .download-btn i {
            font-size: 1rem;
        }

        /* Comments Section */
        .comments-section {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #4b5563;
        }

        .comments-toggle {
            width: 100%;
            padding: 8px 12px;
            background: #2d3748;
            border: 1px solid #4b5563;
            border-radius: 6px;
            color: #94a3b8;
            font-size: 0.85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .comments-toggle:hover {
            background: #374151;
            border-color: #60a5fa;
            color: #f1f5f9;
        }

        .toggle-icon {
            transition: transform 0.3s ease;
            font-size: 0.75rem;
        }

        .toggle-icon.rotated {
            transform: rotate(180deg);
        }

        .comments-content {
            margin-top: 12px;
        }

        .comment-form {
            margin-bottom: 12px;
        }

        .comment-input,
        .comment-textarea {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 6px;
            background: #2d3748;
            border: 1px solid #4b5563;
            border-radius: 6px;
            color: #f1f5f9;
            font-size: 0.85rem;
            font-family: inherit;
            transition: border-color 0.3s ease;
        }

        .comment-input:focus,
        .comment-textarea:focus {
            outline: none;
            border-color: #60a5fa;
        }

        .comment-textarea {
            resize: vertical;
            min-height: 50px;
        }

        .comment-submit-btn {
            width: 100%;
            padding: 8px 12px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .comment-submit-btn:hover {
            background: #2563eb;
        }

        .comments-list {
            margin-top: 8px;
        }

        .comment-item {
            background: #2d3748;
            padding: 8px 10px;
            border-radius: 6px;
            margin-bottom: 6px;
        }

        .comment-author {
            color: #60a5fa;
            font-size: 0.8rem;
            display: block;
            margin-bottom: 4px;
        }

        .comment-text {
            color: #cbd5e1;
            font-size: 0.85rem;
            line-height: 1.4;
            margin: 0 0 4px 0;
        }

        .comment-date {
            color: #6b7280;
            font-size: 0.7rem;
        }

        .photo-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 8px;
        }

        .photo-description {
            font-size: 0.9rem;
            color: #94a3b8;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .photo-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid #4b5563;
        }

        .photo-category {
            padding: 4px 12px;
            background: rgba(96, 165, 250, 0.2);
            color: #60a5fa;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .photo-date {
            font-size: 0.85rem;
            color: #6b7280;
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

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
        }

        .modal-image {
            max-width: 100%;
            max-height: 90vh;
            border-radius: 8px;
        }

        .modal-close {
            position: absolute;
            top: -40px;
            right: 0;
            background: none;
            border: none;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            padding: 8px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .stats-overview {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .search-form {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
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
                <li><a href="{{ route('gallery.photos') }}" class="active">Galeri Foto</a></li>
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

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Galeri Foto Sekolah</h1>
            <p class="page-subtitle">Jelajahi berbagai momen berharga dan aktivitas sekolah kami</p>
        </div>

        <!-- Stats Overview -->
        <div class="stats-overview">
            <div class="stat-card">
                <div class="stat-number">{{ $totalPhotos }}</div>
                <div class="stat-label">Total Foto</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ count($categories) }}</div>
                <div class="stat-label">Kategori</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $recentPhotos }}</div>
                <div class="stat-label">Foto Terbaru</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $contributors }}</div>
                <div class="stat-label">Kontributor</div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="search-section">
            <form method="GET" action="{{ route('gallery.photos') }}" class="search-form">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Cari foto berdasarkan judul atau deskripsi..." 
                       class="search-input">
                
                <select name="category" class="search-input">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ \App\Helpers\CategoryHelper::getCategoryName($category) }}
                        </option>
                    @endforeach
                </select>
                
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Cari
                </button>
                
                @if(request('search') || request('category'))
                    <a href="{{ route('gallery.photos') }}" class="clear-btn">Hapus Filter</a>
                @endif
            </form>
        </div>

        <!-- Gallery Grid -->
        @if($photos->count() > 0)
            <div class="gallery-grid">
                @foreach($photos as $photo)
                    @php
                        $isLiked = auth()->check() ? $photo->isLikedByUser() : false;
                    @endphp
                    <div class="photo-card">
                        <div class="photo-image-wrapper" onclick="openModal('{{ $photo->photo_url }}', '{{ $photo->title }}')">
                            <img src="{{ $photo->photo_url }}" alt="{{ $photo->title }}" class="photo-image" onerror="this.src='{{ asset('images/no-image.png') }}';">
                            <div class="photo-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="photo-info">
                            <h3 class="photo-title">{{ $photo->title }}</h3>
                            @if($photo->description)
                                <p class="photo-description">{{ Str::limit($photo->description, 100) }}</p>
                            @endif
                            <div class="photo-meta">
                                <span class="photo-category">{{ \App\Helpers\CategoryHelper::getCategoryName($photo->category) }}</span>
                                <span class="photo-date">
                                    <i class="far fa-calendar"></i> {{ $photo->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <div class="photo-actions">
                                @auth
                                    <button type="button" class="like-btn {{ $isLiked ? 'liked' : '' }}" 
                                            data-photo-id="{{ $photo->id }}" 
                                            data-liked="{{ $isLiked ? 'true' : 'false' }}"
                                            onclick="toggleLike({{ $photo->id }}); event.stopPropagation();">
                                        <i class="fas fa-heart"></i>
                                        <span class="like-count">{{ $photo->likes->count() }}</span>
                                    </button>
                                    <a href="{{ route('gallery.photo.download', $photo->id) }}" class="download-btn" onclick="event.stopPropagation()">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                @else
                                    <button type="button" class="like-btn" 
                                            data-photo-id="{{ $photo->id }}" 
                                            onclick="requireLogin('like'); event.stopPropagation();">
                                        <i class="fas fa-heart"></i>
                                        <span class="like-count">{{ $photo->likes->count() }}</span>
                                    </button>
                                    <a href="#" class="download-btn" onclick="requireLogin('download'); event.stopPropagation(); return false;">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                @endauth
                            </div>

                            <!-- Comments Section -->
                            <div class="comments-section">
                                <button type="button" class="comments-toggle" onclick="toggleComments({{ $photo->id }}); event.stopPropagation();">
                                    <i class="fas fa-comments"></i> 
                                    <span>{{ $photo->approvedComments->count() }} Komentar</span>
                                    <i class="fas fa-chevron-down toggle-icon" id="icon-{{ $photo->id }}"></i>
                                </button>

                                <div class="comments-content" id="comments-{{ $photo->id }}" style="display: none;">
                                    @auth
                                        <!-- Comment Form -->
                                        <form id="comment-form-{{ $photo->id }}" class="comment-form" onclick="event.stopPropagation()">
                                            @csrf
                                            <!-- For logged-in users, show their name (read-only) -->
                                            <div style="background: #374151; padding: 10px 12px; border-radius: 8px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                                                <i class="fas fa-user-circle" style="color: #60a5fa;"></i>
                                                <span style="color: #d1d5db; font-size: 0.9rem;">Komentar sebagai: <strong style="color: #60a5fa;">{{ Auth::user()->name }}</strong></span>
                                            </div>
                                            <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                                            <textarea name="comment" placeholder="Tulis komentar..." required class="comment-textarea" rows="2">{{ old('comment') }}</textarea>
                                            <button type="submit" class="comment-submit-btn" id="submit-btn-{{ $photo->id }}">
                                                <i class="fas fa-paper-plane"></i> <span id="submit-text-{{ $photo->id }}">Kirim</span>
                                                <span id="spinner-{{ $photo->id }}" class="comment-spinner" style="display: none;">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </span>
                                            </button>
                                        </form>
                                    @else
                                        <!-- Login Required Message -->
                                        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 16px; border-radius: 8px; margin-bottom: 12px; text-align: center;">
                                            <i class="fas fa-lock" style="font-size: 24px; color: white; margin-bottom: 8px;"></i>
                                            <p style="color: white; font-weight: 600; margin: 0 0 8px 0;">Anda harus login untuk mengomentari foto</p>
                                            <a href="{{ route('user.login') }}" style="display: inline-block; background: white; color: #d97706; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                                                <i class="fas fa-sign-in-alt"></i> Login Sekarang
                                            </a>
                                        </div>
                                    @endauth

                                    <!-- Comments List -->
                                    <div class="comments-list" id="comments-list-{{ $photo->id }}">
                                        @if($photo->approvedComments->count() > 0)
                                            @foreach($photo->approvedComments->sortByDesc('created_at')->take(3) as $comment)
                                                <div class="comment-item">
                                                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                                                        <strong class="comment-author">{{ $comment->name }}</strong>
                                                        @if($comment->user_id)
                                                            <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.7rem; font-weight: 600;">
                                                                <i class="fas fa-user-check"></i> User
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <p class="comment-text">{{ $comment->comment }}</p>
                                                    <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-camera" style="font-size: 4rem; opacity: 0.5;"></i></div>
                <h2 class="empty-title">Tidak Ada Foto Ditemukan</h2>
                <p class="empty-text">
                    @if(request('search') || request('category'))
                        Coba ubah filter pencarian Anda
                    @else
                        Belum ada foto yang tersedia saat ini
                    @endif
                </p>
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div class="modal" id="photoModal" onclick="closeModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()">×</button>
            <img src="" alt="" class="modal-image" id="modalImage">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Add CSRF token to all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Handle comment form submission
        $(document).on('submit', '.comment-form', function(e) {
            e.preventDefault();
            
            // Check if user is logged in
            if (!isLoggedIn) {
                requireLogin('comment');
                return;
            }
            
            const form = $(this);
            const photoId = form.find('input[name="photo_id"]').val();
            const submitBtn = $(`#submit-btn-${photoId}`);
            const submitText = $(`#submit-text-${photoId}`);
            const spinner = $(`#spinner-${photoId}`);
            
            console.log('Submitting comment for photo ID:', photoId);
            console.log('Form data:', form.serialize());
            
            // Disable submit button and show spinner
            submitBtn.prop('disabled', true);
            submitText.text('Mengirim...');
            spinner.show();
            
            // Get form data
            const formData = form.serialize();
            
            // Send AJAX request
            $.ajax({
                url: '/photo/' + photoId + '/comment',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log('Comment response:', response);
                    
                    if (response.success) {
                        console.log('Comment added successfully');
                        
                        // Clear the comment textarea
                        form.find('textarea[name="comment"]').val('');
                        
                        // Create new comment HTML
                        const userBadge = response.comment.user_id ? 
                            '<span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.7rem; font-weight: 600;"><i class="fas fa-user-check"></i> User</span>' : '';
                        
                        const commentHtml = `
                            <div class="comment-item">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                                    <strong class="comment-author">${response.comment.name}</strong>
                                    ${userBadge}
                                </div>
                                <p class="comment-text">${response.comment.comment}</p>
                                <span class="comment-date">${response.comment.created_at}</span>
                            </div>
                        `;
                        
                        // Prepend new comment to the comments list
                        $(`#comments-list-${photoId}`).prepend(commentHtml);
                        
                        // Update comment count
                        const commentCount = $(`#comments-list-${photoId} .comment-item`).length;
                        $(`#comments-${photoId} .comments-toggle span`).text(`${commentCount} Komentar`);
                        
                        // Show success message
                        showNotification('Komentar berhasil dikirim!', 'success');
                    }
                },
                error: function(xhr) {
                    console.error('Comment submission error:', xhr);
                    console.error('Status:', xhr.status);
                    console.error('Response text:', xhr.responseText);
                    
                    let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                    
                    // Handle 401 (Unauthorized) - Login required
                    if (xhr.status === 401) {
                        requireLogin('comment');
                        return;
                    }
                    
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        // Handle validation errors
                        errorMessage = '';
                        Object.values(xhr.responseJSON.errors).forEach(error => {
                            errorMessage += error[0] + '\n';
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        // Handle other server errors
                        errorMessage = xhr.responseJSON.message;
                    }
                    showNotification(errorMessage, 'error');
                },
                complete: function() {
                    // Re-enable submit button and hide spinner
                    submitBtn.prop('disabled', false);
                    submitText.text('Kirim');
                    spinner.hide();
                }
            });
        });

        function openModal(imageUrl, title) {
            const modal = document.getElementById('photoModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageUrl;
            modalImage.alt = title;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('photoModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Toggle comments section
        function toggleComments(photoId) {
            const commentsContent = document.getElementById('comments-' + photoId);
            const toggleIcon = document.getElementById('icon-' + photoId);
            
            if (commentsContent.style.display === 'none') {
                commentsContent.style.display = 'block';
                toggleIcon.classList.add('rotated');
            } else {
                commentsContent.style.display = 'none';
                toggleIcon.classList.remove('rotated');
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Check if user is logged in
        const isLoggedIn = @json(auth()->check());

        // Function to show login required notification
        function requireLogin(action) {
            const actionText = {
                'like': 'menyukai foto',
                'comment': 'mengomentari foto',
                'download': 'mengunduh foto'
            }[action] || 'menggunakan fitur ini';
            
            showNotification(`Anda harus login terlebih dahulu untuk ${actionText}. Silakan login atau daftar untuk melanjutkan.`, 'error');
            
            // Optionally redirect to login page after 2 seconds
            setTimeout(() => {
                if (confirm('Apakah Anda ingin login sekarang?')) {
                    window.location.href = '{{ route("user.login") }}';
                }
            }, 2000);
        }

        // Toggle like function
        function toggleLike(photoId) {
            // Check if user is logged in
            if (!isLoggedIn) {
                requireLogin('like');
                return;
            }
            
            const likeBtn = document.querySelector(`[data-photo-id="${photoId}"]`);
            if (!likeBtn) {
                console.error('Like button not found for photo:', photoId);
                return;
            }
            
            const likeCount = likeBtn.querySelector('.like-count');
            if (!likeCount) {
                console.error('Like count element not found');
                return;
            }
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('CSRF token not found');
                showNotification('Terjadi kesalahan: CSRF token tidak ditemukan', 'error');
                return;
            }
            
            // Disable button during request
            likeBtn.disabled = true;
            likeBtn.style.opacity = '0.6';
            likeBtn.style.cursor = 'wait';
            
            // Show loading state
            const originalHTML = likeBtn.innerHTML;
            likeBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span class="like-count">' + likeCount.textContent + '</span>';
            
            fetch(`/photo/${photoId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        // If 401 (Unauthorized), show login required message
                        if (response.status === 401) {
                            requireLogin('like');
                            throw new Error('Login required');
                        }
                        throw new Error(err.message || 'Request failed');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update like count
                    likeCount.textContent = data.likes_count;
                    
                    // Toggle liked class on button only
                    if (data.liked) {
                        likeBtn.classList.add('liked');
                        likeBtn.setAttribute('data-liked', 'true');
                        likeBtn.innerHTML = '<i class="fas fa-heart"></i> <span class="like-count">' + data.likes_count + '</span>';
                    } else {
                        likeBtn.classList.remove('liked');
                        likeBtn.setAttribute('data-liked', 'false');
                        likeBtn.innerHTML = '<i class="fas fa-heart"></i> <span class="like-count">' + data.likes_count + '</span>';
                    }

                    // Show notification with liked users
                    if (data.liked_users && data.liked_users.length > 0) {
                        const usersList = data.liked_users.slice(0, 3).join(', ');
                        const moreCount = data.liked_users.length > 3 ? ` dan ${data.liked_users.length - 3} lainnya` : '';
                        showNotification(`${data.message} Disukai oleh: ${usersList}${moreCount}`, 'success');
                    } else {
                        showNotification(data.message, data.liked ? 'success' : 'info');
                    }

                    // Update like button title with users list
                    if (data.liked_users && data.liked_users.length > 0) {
                        likeBtn.title = `Disukai oleh: ${data.liked_users.join(', ')}`;
                    } else {
                        likeBtn.title = 'Belum ada yang menyukai';
                    }
                } else {
                    // Handle error from server
                    showNotification(data.message || 'Terjadi kesalahan saat memproses like', 'error');
                    // Restore original HTML
                    likeBtn.innerHTML = originalHTML;
                }
            })
            .catch(error => {
                console.error('Like error:', error);
                showNotification(error.message || 'Terjadi kesalahan saat memproses like. Silakan coba lagi.', 'error');
                // Restore original HTML
                likeBtn.innerHTML = originalHTML;
            })
            .finally(() => {
                // Re-enable button
                likeBtn.disabled = false;
                likeBtn.style.opacity = '1';
                likeBtn.style.cursor = 'pointer';
            });
        }

        // Show notification function
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 80px;
                right: 20px;
                background: ${type === 'success' ? 'linear-gradient(135deg, #10b981 0%, #059669 100%)' : type === 'error' ? 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)' : 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)'};
                color: white;
                padding: 16px 24px;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
                z-index: 10000;
                display: flex;
                align-items: center;
                gap: 12px;
                animation: slideIn 0.3s ease;
                max-width: 400px;
            `;
            
            // Add login link for error notifications about login
            let actionButton = '';
            if (type === 'error' && message.includes('login')) {
                actionButton = `
                    <a href="{{ route('user.login') }}" style="margin-left: 8px; background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 6px; text-decoration: none; color: white; font-size: 12px; font-weight: 600; white-space: nowrap;">
                        Login
                    </a>
                `;
            }
            
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}" style="font-size: 20px;"></i>
                <span style="font-weight: 500; font-size: 14px; flex: 1;">${message}</span>
                ${actionButton}
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(400px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(400px); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
