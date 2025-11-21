<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Web Gallery Sekolah</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
        <!-- Icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
        <style>
            /* Cookie Consent Banner */
            .cookie-consent-banner {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: rgba(0, 0, 0, 0.9);
                color: #fff;
                padding: 16px 24px;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
                z-index: 9999;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
                transform: translateY(100%);
                transition: transform 0.3s ease;
            }

            .cookie-consent-banner.show {
                transform: translateY(0);
            }

            .cookie-consent-content {
                flex: 1;
                margin-right: 20px;
                margin-bottom: 10px;
            }

            .cookie-consent-buttons {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .cookie-consent-btn {
                padding: 8px 16px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-weight: 500;
                transition: all 0.2s ease;
            }

            .btn-accept-all {
                background: #3b82f6;
                color: white;
            }

            .btn-accept-all:hover {
                background: #2563eb;
            }

            .btn-settings {
                background: #4b5563;
                color: white;
            }

            .btn-settings:hover {
                background: #374151;
            }

            @media (max-width: 640px) {
                .cookie-consent-banner {
                    flex-direction: column;
                    text-align: center;
                }
                
                .cookie-consent-content {
                    margin-right: 0;
                    margin-bottom: 15px;
                }
            }
        </style>
    </head>
    <body>
        <div class="welcome-layout">
            <!-- Header -->
            <header class="welcome-header">
                <div class="container">
                    <div class="header-content">
                        <div class="header-brand">
                            <div class="brand-logo"><i class="fas fa-school"></i></div>
                            <span class="brand-text">Web Gallery Sekolah</span>
                        </div>
                        
                        <nav class="header-nav">
                            <a href="{{ route('gallery.index') }}" class="nav-link">
                                <i class="fas fa-images"></i>
                                <span>Galeri</span>
                            </a>
                            <a href="{{ route('public.information') }}" class="nav-link">
                                <i class="fas fa-bullhorn"></i>
                                <span>Informasi</span>
                            </a>
                            <a href="{{ route('login') }}" class="nav-link">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Login</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </header>

            <!-- Hero Section -->
            <section class="hero-section">
                <div class="container">
                    <div class="hero-content">
                        <h1 class="hero-title">Selamat Datang di Web Gallery Sekolah</h1>
                        <p class="hero-description">
                            Portal galeri foto digital yang menampilkan berbagai kegiatan, prestasi, dan fasilitas sekolah 
                            dalam format yang menarik dan informatif
                        </p>
                        
                        <div class="hero-actions">
                            <a href="{{ route('gallery.index') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-images"></i>
                                Jelajahi Galeri
                            </a>
                            <a href="{{ route('public.information') }}" class="btn btn-outline btn-lg">
                                <i class="fas fa-bullhorn"></i>
                                Lihat Informasi
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline btn-lg">
                                <i class="fas fa-user-plus"></i>
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="features-section">
                <div class="container">
                    <h2 class="section-title">Fitur Utama</h2>
                    <div class="features-grid">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-images"></i>
                            </div>
                            <h3>Galeri Foto Digital</h3>
                            <p>Lihat koleksi foto kegiatan sekolah, prestasi, dan fasilitas dalam berbagai kategori yang terorganisir dengan baik</p>
                        </div>
                        
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <h3>Informasi Sekolah</h3>
                            <p>Dapatkan informasi terbaru, pengumuman penting, dan berita seputar kegiatan sekolah</p>
                        </div>
                        
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3>Pencarian & Filter</h3>
                            <p>Temukan foto dan informasi yang Anda butuhkan dengan mudah menggunakan fitur pencarian dan filter kategori</p>
                        </div>
                        
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h3>Responsif & Modern</h3>
                            <p>Interface yang modern dan responsif, dapat diakses dengan nyaman dari berbagai perangkat</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Categories Preview -->
            <section class="categories-section">
                <div class="container">
                    <h2 class="section-title">Kategori Foto</h2>
                    <div class="categories-grid">
                        <a href="{{ route('gallery.index') }}?category=kegiatan" class="category-card">
                            <div class="category-icon">🎉</div>
                            <h3>Kegiatan Sekolah</h3>
                            <p>Acara dan kegiatan sekolah</p>
                        </a>
                        
                        <a href="{{ route('gallery.index') }}?category=prestasi" class="category-card">
                            <div class="category-icon">🏆</div>
                            <h3>Prestasi & Penghargaan</h3>
                            <p>Momen kebanggaan sekolah</p>
                        </a>
                        
                        <a href="{{ route('gallery.index') }}?category=fasilitas" class="category-card">
                            <div class="category-icon">🏢</div>
                            <h3>Fasilitas Sekolah</h3>
                            <p>Infrastruktur dan sarana</p>
                        </a>
                        
                        <a href="{{ route('gallery.index') }}?category=ekstrakurikuler" class="category-card">
                            <div class="category-icon">🎭</div>
                            <h3>Ekstrakurikuler</h3>
                            <p>Aktivitas tambahan siswa</p>
                        </a>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="cta-section">
                <div class="container">
                    <div class="cta-content">
                        <h2>Mulai Jelajahi Sekarang</h2>
                        <p>Bergabunglah dengan komunitas digital sekolah kami dan nikmati pengalaman melihat galeri foto yang menarik</p>
                        <div class="cta-actions">
                            <a href="{{ route('gallery.index') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-images"></i>
                                Lihat Galeri
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline btn-lg">
                                <i class="fas fa-user-plus"></i>
                                Daftar Akun
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="welcome-footer">
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
                                    <li><a href="{{ route('gallery.index') }}">Galeri Foto</a></li>
                                    <li><a href="{{ route('public.information') }}">Informasi</a></li>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                </ul>
                            </div>
                            
                            <div class="link-group">
                                <h4>Akses</h4>
                                <ul>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                    <li><a href="{{ route('login') }}">Login</a></li>
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
        .welcome-layout {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .welcome-header {
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
            gap: var(--spacing-3);
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
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
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

        .nav-link i {
            font-size: var(--font-size-sm);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
            color: white;
            padding: var(--spacing-20) 0;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: var(--font-size-5xl);
            font-weight: var(--font-weight-bold);
            margin: 0 0 var(--spacing-6) 0;
            line-height: 1.2;
        }

        .hero-description {
            font-size: var(--font-size-xl);
            margin: 0 0 var(--spacing-8) 0;
            opacity: 0.9;
            line-height: 1.6;
        }

        .hero-actions {
            display: flex;
            gap: var(--spacing-4);
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Features Section */
        .features-section {
            padding: var(--spacing-16) 0;
            background-color: var(--secondary-50);
        }

        .section-title {
            font-size: var(--font-size-3xl);
            font-weight: var(--font-weight-bold);
            color: var(--secondary-900);
            text-align: center;
            margin: 0 0 var(--spacing-12) 0;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-8);
        }

        .feature-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: var(--spacing-8);
            text-align: center;
            border: 1px solid var(--secondary-200);
            transition: all var(--transition-normal);
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-300);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-200) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--spacing-6);
            font-size: 32px;
            color: var(--primary-600);
        }

        .feature-card h3 {
            font-size: var(--font-size-xl);
            font-weight: var(--font-weight-semibold);
            color: var(--secondary-900);
            margin: 0 0 var(--spacing-4) 0;
        }

        .feature-card p {
            font-size: var(--font-size-base);
            color: var(--secondary-600);
            line-height: 1.6;
            margin: 0;
        }

        /* Categories Section */
        .categories-section {
            padding: var(--spacing-16) 0;
            background: white;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-6);
        }

        .category-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: var(--spacing-8);
            text-decoration: none;
            color: inherit;
            border: 1px solid var(--secondary-200);
            transition: all var(--transition-normal);
            text-align: center;
        }

        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-300);
        }

        .category-icon {
            font-size: 4rem;
            margin-bottom: var(--spacing-4);
        }

        .category-card h3 {
            font-size: var(--font-size-lg);
            font-weight: var(--font-weight-semibold);
            color: var(--secondary-900);
            margin: 0 0 var(--spacing-2) 0;
        }

        .category-card p {
            font-size: var(--font-size-sm);
            color: var(--secondary-600);
            margin: 0;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--secondary-800) 0%, var(--secondary-900) 100%);
            color: white;
            padding: var(--spacing-16) 0;
            text-align: center;
        }

        .cta-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .cta-content h2 {
            font-size: var(--font-size-3xl);
            font-weight: var(--font-weight-bold);
            margin: 0 0 var(--spacing-4) 0;
        }

        .cta-content p {
            font-size: var(--font-size-lg);
            margin: 0 0 var(--spacing-8) 0;
            opacity: 0.9;
        }

        .cta-actions {
            display: flex;
            gap: var(--spacing-4);
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Footer */
        .welcome-footer {
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
            
            .hero-actions {
                flex-direction: column;
                align-items: center;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .cta-actions {
                flex-direction: column;
                align-items: center;
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
            .welcome-header,
            .features-section,
            .categories-section,
            .welcome-footer {
                background: var(--secondary-100);
                border-color: var(--secondary-200);
            }
            
            .feature-card,
            .category-card {
                background: var(--secondary-100);
                border-color: var(--secondary-200);
            }
        }
        </style>
        <!-- Cookie Consent Banner -->
        <div id="cookieConsentBanner" class="cookie-consent-banner">
            <div class="cookie-consent-content">
                <p>Kami menggunakan cookie untuk meningkatkan pengalaman Anda di situs web kami. Dengan melanjutkan, Anda menyetujui penggunaan cookie kami.</p>
            </div>
            <div class="cookie-consent-buttons">
                <button id="btnAcceptAll" class="cookie-consent-btn btn-accept-all">Terima Semua</button>
                <button id="btnSettings" class="cookie-consent-btn btn-settings">Pengaturan</button>
            </div>
        </div>

        <script>
            // Check if user has already made a choice
            if (!localStorage.getItem('cookieConsent')) {
                // Show banner after page loads
                document.addEventListener('DOMContentLoaded', function() {
                    const banner = document.getElementById('cookieConsentBanner');
                    setTimeout(() => {
                        banner.classList.add('show');
                    }, 1000);
                });
            }

            // Accept All button
            document.getElementById('btnAcceptAll')?.addEventListener('click', function() {
                // Set all cookie preferences
                const consent = {
                    necessary: true,
                    preferences: true,
                    statistics: true,
                    marketing: true,
                    acceptedAt: new Date().toISOString()
                };
                
                // Save to localStorage
                localStorage.setItem('cookieConsent', JSON.stringify(consent));
                
                // Hide banner
                document.getElementById('cookieConsentBanner').classList.remove('show');
                
                // Optional: You can add code here to load additional services
                console.log('All cookies accepted', consent);
                
                // Optional: Show a confirmation message
                alert('Terima kasih! Preferensi cookie Anda telah disimpan.');
            });

            // Settings button
            document.getElementById('btnSettings')?.addEventListener('click', function() {
                // Here you can implement a more detailed cookie settings modal
                alert('Menu pengaturan cookie akan ditampilkan di sini.');
                // You can expand this to show a modal with individual cookie options
            });
        </script>
    </body>
</html>
