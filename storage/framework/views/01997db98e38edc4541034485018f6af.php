<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Galeri Foto - SMK Negeri 4 Bogor</title>
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
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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
        }

        .like-btn.liked:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
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
            background: rgba(0, 0, 0, 0.95);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            max-width: 95%;
            max-height: 95%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-image {
            max-width: 95vw;
            max-height: 95vh;
            border-radius: 8px;
            object-fit: contain;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .modal-title {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            color: white;
            font-size: 1.2rem;
            padding: 10px;
            background: rgba(0, 0, 0, 0.5);
            margin: 0 20px;
            border-radius: 8px;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease, fadeOut 0.5s ease 4.5s forwards;
        }
        
        .notification-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .notification-error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        
        .notification-info {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        .notification-close {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
                visibility: hidden;
            }
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-overview {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
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

            .stats-overview {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .stat-card {
                padding: 16px;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .stat-label {
                font-size: 0.85rem;
            }

            .search-section {
                padding: 16px;
            }

            .search-form {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .search-btn,
            .clear-btn {
                width: 100%;
                text-align: center;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .photo-actions {
                flex-direction: column;
                gap: 8px;
            }

            .like-btn,
            .download-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.75rem;
            }

            .page-subtitle {
                font-size: 0.9rem;
            }

            .stats-overview {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 12px;
            }

            .search-input,
            .search-btn {
                font-size: 0.9rem;
                padding: 10px 14px;
            }

            .photo-title {
                font-size: 1rem;
            }

            .photo-description {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="<?php echo e(route('home')); ?>" class="logo">
                <span style="color: #3b82f6;">SMK Negeri 4 Bogor</span>
            </a>
            
            <!-- Desktop Navigation -->
            <ul class="nav-links">
                <li><a href="<?php echo e(route('home')); ?>">Beranda</a></li>
                <li><a href="<?php echo e(route('gallery.photos')); ?>" class="active">Galeri Foto</a></li>
                <li><a href="<?php echo e(route('information.page')); ?>">Informasi</a></li>
                <?php if(auth()->guard()->check()): ?>
                    <li><a href="<?php echo e(route('user.profile')); ?>">Profil</a></li>
                    <?php if(Auth::user()->role === 'admin'): ?>
                        <li><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard Admin</a></li>
                    <?php endif; ?>
                    <li class="user-menu" style="display: flex; align-items: center; gap: 12px;">
                        <?php if(Auth::user()->avatar): ?>
                            <img src="<?php echo e(asset('avatars/' . Auth::user()->avatar)); ?>" alt="Profile" class="user-avatar" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                        <?php else: ?>
                            <div class="user-avatar" style="width: 32px; height: 32px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 12px;">
                                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('gallery.logout')); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="background: none; border: none; color: #d1d5db; cursor: pointer; font-weight: 500; font-size: 0.95rem;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                <?php else: ?>
                    <li><a href="<?php echo e(route('user.login')); ?>">Login</a></li>
                    <li><a href="<?php echo e(route('register')); ?>">Daftar</a></li>
                <?php endif; ?>
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
            <a href="<?php echo e(route('home')); ?>" class="logo">
                <span style="color: #3b82f6;">SMK Negeri 4 Bogor</span>
            </a>
            <button class="mobile-nav-close" onclick="toggleMobileMenu()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <ul class="mobile-nav-links">
            <li><a href="<?php echo e(route('home')); ?>"><i class="fas fa-home"></i> Beranda</a></li>
            <li><a href="<?php echo e(route('gallery.photos')); ?>" class="active"><i class="fas fa-images"></i> Galeri Foto</a></li>
            <li><a href="<?php echo e(route('information.page')); ?>"><i class="fas fa-info-circle"></i> Informasi</a></li>
            <?php if(auth()->guard()->check()): ?>
                <li><a href="<?php echo e(route('user.profile')); ?>"><i class="fas fa-user"></i> Profil</a></li>
                <?php if(Auth::user()->role === 'admin'): ?>
                    <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</a></li>
                <?php endif; ?>
            <?php else: ?>
                <li><a href="<?php echo e(route('user.login')); ?>"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <li><a href="<?php echo e(route('register')); ?>"><i class="fas fa-user-plus"></i> Daftar</a></li>
            <?php endif; ?>
        </ul>

        <?php if(auth()->guard()->check()): ?>
        <div class="mobile-user-section">
            <div class="mobile-user-info">
                <?php if(Auth::user()->avatar): ?>
                    <img src="<?php echo e(asset('avatars/' . Auth::user()->avatar)); ?>" alt="Profile" class="mobile-user-avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                <?php else: ?>
                    <div class="mobile-user-avatar">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </div>
                <?php endif; ?>
                <div>
                    <div style="color: #f1f5f9; font-weight: 600; font-size: 0.95rem;"><?php echo e(Auth::user()->name); ?></div>
                    <div style="color: #94a3b8; font-size: 0.85rem;"><?php echo e(Auth::user()->email); ?></div>
                </div>
            </div>
            <form action="<?php echo e(route('gallery.logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" style="width: 100%; padding: 12px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>

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
                <div class="stat-number"><?php echo e($totalPhotos); ?></div>
                <div class="stat-label">Total Foto</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo e(count($categories)); ?></div>
                <div class="stat-label">Kategori</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo e($recentPhotos); ?></div>
                <div class="stat-label">Foto Terbaru</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo e($contributors); ?></div>
                <div class="stat-label">Kontributor</div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="search-section">
            <form method="GET" action="<?php echo e(route('gallery.photos')); ?>" class="search-form">
                <input type="text" 
                       name="search" 
                       value="<?php echo e(request('search')); ?>" 
                       placeholder="Cari foto berdasarkan judul atau deskripsi..." 
                       class="search-input">
                
                <select name="category" class="search-input">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category); ?>" <?php echo e(request('category') == $category ? 'selected' : ''); ?>>
                            <?php echo e(\App\Helpers\CategoryHelper::getCategoryName($category)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Cari
                </button>
                
                <?php if(request('search') || request('category')): ?>
                    <a href="<?php echo e(route('gallery.photos')); ?>" class="clear-btn">Hapus Filter</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Gallery Grid -->
        <?php if($photos->count() > 0): ?>
            <div class="gallery-grid">
                <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="photo-card">
                        <div class="photo-image-wrapper" onclick="openModal('<?php echo e($photo->photo_url); ?>', '<?php echo e($photo->title); ?>')">
                            <img src="<?php echo e($photo->photo_url); ?>" alt="<?php echo e($photo->title); ?>" class="photo-image" onerror="this.src='<?php echo e(asset('images/no-image.png')); ?>';">
                            <div class="photo-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="photo-info">
                            <h3 class="photo-title"><?php echo e($photo->title); ?></h3>
                            <?php if($photo->description): ?>
                                <p class="photo-description"><?php echo e(Str::limit($photo->description, 100)); ?></p>
                            <?php endif; ?>
                            <div class="photo-meta">
                                <span class="photo-category"><?php echo e(\App\Helpers\CategoryHelper::getCategoryName($photo->category)); ?></span>
                                <span class="photo-date">
                                    <i class="far fa-calendar"></i> <?php echo e($photo->created_at->format('d M Y')); ?>

                                </span>
                            </div>
                            <div class="photo-actions">
                                <button type="button" class="like-btn <?php echo e((auth()->check() && $photo->isLikedByUser($userId)) ? 'liked' : (auth()->check() ? '' : ($photo->isLikedByIp($userIp) ? 'liked' : ''))); ?>" 
                                        data-photo-id="<?php echo e($photo->id); ?>" 
                                        onclick="toggleLike(<?php echo e($photo->id); ?>); event.stopPropagation();"
                                        <?php if(!auth()->check()): ?> title="Anda harus login terlebih dahulu untuk menyukai foto" <?php endif; ?>>
                                    <i class="fas fa-heart"></i>
                                    <span class="like-count"><?php echo e($photo->likes->count()); ?></span>
                                </button>
                                <a href="<?php if(auth()->guard()->check()): ?><?php echo e(route('gallery.photo.download', $photo->id)); ?><?php else: ?> javascript:void(0) <?php endif; ?>" class="download-btn" onclick="<?php if(auth()->guard()->check()): ?> event.stopPropagation() <?php else: ?> event.preventDefault(); showNotification('Anda harus login terlebih dahulu untuk mengunduh foto', 'error'); <?php endif; ?>">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>

                            <!-- Comments Section -->
                            <div class="comments-section">
                                <button type="button" class="comments-toggle" onclick="toggleComments(<?php echo e($photo->id); ?>); event.stopPropagation();">
                                    <i class="fas fa-comments"></i> 
                                    <span id="comment-count-<?php echo e($photo->id); ?>"><?php echo e($photo->approvedComments->count()); ?> Komentar</span>
                                    <i class="fas fa-chevron-down toggle-icon" id="icon-<?php echo e($photo->id); ?>"></i>
                                </button>

                                <div class="comments-content" id="comments-<?php echo e($photo->id); ?>" style="display: none;">
                                    <!-- Comment Form -->
                                    <form id="comment-form-<?php echo e($photo->id); ?>" class="comment-form" onclick="event.stopPropagation()" onsubmit="submitComment(<?php echo e($photo->id); ?>); return false;">
                                        <?php echo csrf_field(); ?>
                                        <?php if(auth()->guard()->check()): ?>
                                            <!-- For logged-in users, show their name (read-only) -->
                                            <div style="background: #374151; padding: 10px 12px; border-radius: 8px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                                                <i class="fas fa-user-circle" style="color: #60a5fa;"></i>
                                                <span style="color: #d1d5db; font-size: 0.9rem;">Komentar sebagai: <strong style="color: #60a5fa;"><?php echo e(Auth::user()->name); ?></strong></span>
                                            </div>
                                        <?php else: ?>
                                            <!-- For guests, show login message -->
                                            <div style="background: #374151; padding: 10px 12px; border-radius: 8px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                                                <i class="fas fa-exclamation-circle" style="color: #f59e0b;"></i>
                                                <span style="color: #d1d5db; font-size: 0.9rem;">Anda harus <a href="<?php echo e(route('user.login')); ?>" style="color: #60a5fa; text-decoration: underline;">login</a> terlebih dahulu untuk mengirim komentar</span>
                                            </div>
                                        <?php endif; ?>
                                        <input type="hidden" name="photo_id" value="<?php echo e($photo->id); ?>">
                                        <?php if(auth()->guard()->check()): ?>
                                            <textarea name="comment" placeholder="Tulis komentar..." required class="comment-textarea" rows="2" id="comment-text-<?php echo e($photo->id); ?>"><?php echo e(old('comment')); ?></textarea>
                                            <button type="submit" class="comment-submit-btn" id="submit-btn-<?php echo e($photo->id); ?>">
                                                <i class="fas fa-paper-plane"></i> <span id="submit-text-<?php echo e($photo->id); ?>">Kirim</span>
                                                <span id="spinner-<?php echo e($photo->id); ?>" class="comment-spinner" style="display: none;">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </span>
                                            </button>
                                        <?php else: ?>
                                            <textarea name="comment" placeholder="Tulis komentar..." required class="comment-textarea" rows="2" id="comment-text-<?php echo e($photo->id); ?>"></textarea>
                                            <button type="submit" class="comment-submit-btn" id="submit-btn-<?php echo e($photo->id); ?>" onclick="event.preventDefault(); showNotification('Anda harus login terlebih dahulu untuk mengirim komentar', 'error');">
                                                <i class="fas fa-paper-plane"></i> <span id="submit-text-<?php echo e($photo->id); ?>">Kirim</span>
                                            </button>
                                        <?php endif; ?>
                                    </form>

                                    <!-- Comments List -->
                                    <div class="comments-list" id="comments-list-<?php echo e($photo->id); ?>">
                                        <?php if($photo->approvedComments->count() > 0): ?>
                                            <?php $__currentLoopData = $photo->approvedComments->sortByDesc('created_at')->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="comment-item">
                                                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                                                        <strong class="comment-author"><?php echo e($comment->name); ?></strong>
                                                        <?php if($comment->user_id): ?>
                                                            <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.7rem; font-weight: 600;">
                                                                <i class="fas fa-user-check"></i> User
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <p class="comment-text"><?php echo e($comment->comment); ?></p>
                                                    <span class="comment-date"><?php echo e($comment->created_at->diffForHumans()); ?></span>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-camera" style="font-size: 4rem; opacity: 0.5;"></i></div>
                <h2 class="empty-title">Tidak Ada Foto Ditemukan</h2>
                <p class="empty-text">
                    <?php if(request('search') || request('category')): ?>
                        Coba ubah filter pencarian Anda
                    <?php else: ?>
                        Belum ada foto yang tersedia saat ini
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal -->
    <div class="modal" id="photoModal" onclick="closeModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()">×</button>
            <img src="" alt="" class="modal-image" id="modalImage">
            <div class="modal-title" id="modalTitle"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        // Modal functionality
        function openModal(imageUrl, title) {
            const modal = document.getElementById('photoModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            
            modalImage.src = imageUrl;
            modalTitle.textContent = title;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('photoModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Like functionality
        function toggleLike(photoId) {
            // Check if user is authenticated
            <?php if(!auth()->check()): ?>
                showNotification('Anda harus login terlebih dahulu untuk menyukai foto', 'error');
                return;
            <?php endif; ?>
            
            const button = document.querySelector(`.like-btn[data-photo-id="${photoId}"]`);
            const icon = button.querySelector('i');
            const countElement = button.querySelector('.like-count');
            
            // Disable button during request
            button.disabled = true;
            icon.classList.remove('fa-heart');
            icon.classList.add('fas', 'fa-spinner');
            
            fetch(`/photo/${photoId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.classList.toggle('liked');
                    countElement.textContent = data.likes_count;
                    showNotification(data.message, 'success');
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat menyukai foto', 'error');
            })
            .finally(() => {
                // Re-enable button
                button.disabled = false;
                icon.classList.remove('fa-spinner');
                icon.classList.add('fa-heart');
            });
        }

        // Comments functionality
        function toggleComments(photoId) {
            const content = document.getElementById(`comments-${photoId}`);
            const icon = document.getElementById(`icon-${photoId}`);
            
            // Toggle visibility
            const isVisible = content.style.display === 'block';
            content.style.display = isVisible ? 'none' : 'block';
            icon.classList.toggle('rotated');
            
            // Load comments if section is being opened
            if (!isVisible) {
                loadComments(photoId);
            }
        }

        function submitComment(photoId) {
            // Check if user is authenticated
            <?php if(!auth()->check()): ?>
                showNotification('Anda harus login terlebih dahulu untuk mengirim komentar', 'error');
                return;
            <?php endif; ?>
            
            const textarea = document.getElementById(`comment-text-${photoId}`);
            const comment = textarea.value.trim();
            
            if (!comment) {
                showNotification('Komentar tidak boleh kosong', 'error');
                return;
            }
            
            // Disable submit button during request
            const submitBtn = document.getElementById(`submit-btn-${photoId}`);
            const submitText = document.getElementById(`submit-text-${photoId}`);
            const spinner = document.getElementById(`spinner-${photoId}`);
            
            submitText.style.display = 'none';
            spinner.style.display = 'inline-block';
            submitBtn.disabled = true;
            
            fetch(`/photo/${photoId}/comment`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ comment: comment })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Clear textarea
                    textarea.value = '';
                    
                    // Add new comment to the list
                    const commentsList = document.getElementById(`comments-list-${photoId}`);
                    const commentElement = document.createElement('div');
                    commentElement.className = 'comment-item';
                    commentElement.innerHTML = `
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                            <strong class="comment-author"><?php echo e(auth()->check() ? Auth::user()->name : 'Guest'); ?></strong>
                            <?php if(auth()->guard()->check()): ?>
                                <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.7rem; font-weight: 600;">
                                    <i class="fas fa-user-check"></i> User
                                </span>
                            <?php endif; ?>
                        </div>
                        <p class="comment-text">${data.comment.comment}</p>
                        <span class="comment-date">Baru saja</span>
                    `;
                    commentsList.prepend(commentElement);
                    
                    // Update comment count
                    const countElement = document.getElementById(`comment-count-${photoId}`);
                    const currentCount = parseInt(countElement.textContent) || 0;
                    countElement.textContent = `${currentCount + 1} Komentar`;
                    
                    showNotification('Komentar berhasil dikirim', 'success');
                } else if (data.errors) {
                    // Handle validation errors
                    let errorMessage = '';
                    for (const field in data.errors) {
                        errorMessage += data.errors[field].join(', ') + ' ';
                    }
                    showNotification(errorMessage, 'error');
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat mengirim komentar', 'error');
            })
            .finally(() => {
                // Re-enable submit button
                submitText.style.display = 'inline-block';
                spinner.style.display = 'none';
                submitBtn.disabled = false;
            });
        }

        function loadComments(photoId) {
            fetch(`/photo/${photoId}/comments`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const commentsList = document.getElementById(`comments-list-${photoId}`);
                    commentsList.innerHTML = '';
                    
                    data.comments.forEach(comment => {
                        const commentElement = document.createElement('div');
                        commentElement.className = 'comment-item';
                        commentElement.innerHTML = `
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                                <strong class="comment-author">${comment.user_name}</strong>
                                ${comment.user_id ? `<span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.7rem; font-weight: 600;">
                                    <i class="fas fa-user-check"></i> User
                                </span>` : ''}
                            </div>
                            <p class="comment-text">${comment.comment}</p>
                            <span class="comment-date">${comment.created_at}</span>
                        `;
                        commentsList.appendChild(commentElement);
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Notification system
        function showNotification(message, type = 'info') {
            // Remove existing notification if any
            const existingNotification = document.getElementById('notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            const notification = document.createElement('div');
            notification.id = 'notification';
            notification.className = `notification notification-${type}`;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                <span>${message}</span>
                <button onclick="this.parentElement.remove()" class="notification-close">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\ujikomrasya\resources\views/gallery-photos.blade.php ENDPATH**/ ?>