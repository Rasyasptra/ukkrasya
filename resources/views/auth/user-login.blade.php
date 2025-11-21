<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login User | Web Gallery Sekolah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            background: #374151;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            border: 1px solid #4b5563;
        }

        .login-left {
            background: #1e293b;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
            border-right: 1px solid #4b5563;
        }

        .login-left-content {
            position: relative;
            z-index: 1;
        }

        .brand-section {
            margin-bottom: 40px;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            margin-bottom: 24px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .brand-logo img {
            width: 30px;
            height: 30px;
            object-fit: contain;
        }

        .brand-section h1 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .brand-section p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .features {
            margin-top: 40px;
        }

        .feature-item {
            display: flex;
            align-items: start;
            margin-bottom: 24px;
            gap: 16px;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            backdrop-filter: blur(10px);
        }

        .feature-icon svg {
            width: 20px;
            height: 20px;
            stroke: white;
            fill: none;
            stroke-width: 2;
        }

        .feature-text h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .feature-text p {
            font-size: 14px;
            opacity: 0.85;
        }

        .login-right {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #374151;
        }

        .login-header {
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 15px;
            color: #94a3b8;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #d1d5db;
            font-weight: 600;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #9ca3af;
        }

        .input-icon svg {
            width: 100%;
            height: 100%;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #4b5563;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #2d3748;
            color: #f1f5f9;
            font-family: inherit;
        }

        .form-group input:focus {
            outline: none;
            border-color: #60a5fa;
            background: #374151;
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.1);
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .error-message {
            color: #dc2626;
            font-size: 14px;
            margin-bottom: 24px;
            padding: 14px 16px;
            background: #fef2f2;
            border: 2px solid #fecaca;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .error-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .submit-btn {
            width: 100%;
            padding: 16px 24px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .submit-btn:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .divider {
            margin: 32px 0;
            text-align: center;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            background: white;
            padding: 0 16px;
            color: #9ca3af;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        .back-link {
            text-align: center;
            margin-top: 24px;
        }

        .back-link {
            color: #94a3b8;
        }

        .back-link a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .back-link a:hover {
            color: #3b82f6;
            gap: 12px;
        }

        .back-link svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 480px;
                border-radius: 16px;
            }

            .login-left {
                padding: 40px 30px;
                border-right: none;
                border-bottom: 1px solid #4b5563;
            }

            .login-right {
                padding: 40px 30px;
            }

            .brand-section h1 {
                font-size: 28px;
                line-height: 1.3;
            }

            .brand-section p {
                font-size: 15px;
            }

            .features {
                display: none;
            }

            .login-header h2 {
                font-size: 26px;
            }

            .login-header p {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .login-wrapper {
                border-radius: 12px;
            }

            .login-left, .login-right {
                padding: 30px 20px;
            }

            .brand-logo {
                width: 36px;
                height: 36px;
                margin-bottom: 20px;
            }

            .brand-section h1 {
                font-size: 24px;
            }

            .login-header h2 {
                font-size: 24px;
            }

            .login-header p {
                font-size: 13px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group input {
                padding: 12px 14px 12px 44px;
                font-size: 14px;
            }

            .input-icon {
                width: 18px;
                height: 18px;
                left: 14px;
            }

            .submit-btn {
                padding: 14px 20px;
                font-size: 15px;
            }

            .back-link a {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-left">
            <div class="login-left-content">
                <div class="brand-section">
                    <div class="brand-logo">
                        <img src="{{ asset('logo.png') }}" alt="SMK Negeri 4 Bogor" onerror="this.style.display='none';">
                    </div>
                    <h1>Web Gallery<br>SMK Negeri 4 Bogor</h1>
                    <p>Platform galeri foto dan informasi sekolah yang modern dan interaktif</p>
                </div>

                <div class="features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <h3>Galeri Lengkap</h3>
                            <p>Akses koleksi foto kegiatan sekolah dengan mudah</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <h3>Informasi Terkini</h3>
                            <p>Dapatkan update pengumuman dan berita sekolah</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <h3>Interaksi Sosial</h3>
                            <p>Like dan komentar pada foto favorit Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="login-right">
            <div class="login-header">
                <h2>Masuk ke Akun</h2>
                <p>Silakan login untuk mengakses galeri sekolah</p>
            </div>

            @if(session('success'))
                <div class="success-message" style="background: rgba(16, 185, 129, 0.1); border: 2px solid #10b981; border-radius: 12px; padding: 16px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; animation: slideDown 0.5s ease;">
                    <div style="background: #10b981; color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: bold;">✓</div>
                    <div style="color: #10b981; font-size: 0.95rem;">
                        <strong>Berhasil!</strong><br>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="error-message">
                    <div class="error-icon">
                        <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <div>
                        <strong>Login gagal!</strong><br>
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('user.login.post') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label for="username">Email atau Username</label>
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <input 
                            id="username" 
                            type="text" 
                            name="username" 
                            value="{{ old('username', 'user') }}" 
                            autocomplete="username" 
                            required 
                            autofocus
                            placeholder="Masukkan email atau username"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </div>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            autocomplete="current-password" 
                            required
                            placeholder="Masukkan password"
                        >
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <span id="btnText">Masuk ke Gallery</span>
                </button>
            </form>

            <div class="divider">
                <span>atau</span>
            </div>

            <div class="back-link" style="margin-bottom: 16px;">
                <a href="{{ route('register') }}" style="color: #60a5fa;">
                    <svg viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    Belum punya akun? Daftar sekarang
                </a>
            </div>

            <div class="back-link">
                <a href="{{ route('gallery.index') }}">
                    <svg viewBox="0 0 24 24">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Kembali ke Gallery Publik
                </a>
            </div>
        </div>
    </div>

    <script>
        // Add CSRF token to all AJAX requests
        document.addEventListener('DOMContentLoaded', function() {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Set up AJAX requests to include CSRF token
            XMLHttpRequest.prototype.originalOpen = XMLHttpRequest.prototype.open;
            XMLHttpRequest.prototype.open = function(method, url, async, user, password) {
                this.originalOpen(method, url, async, user, password);
                this.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                this.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            };
        });

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<div class="spinner"></div><span>Memproses...</span>';
        });

        // Add smooth focus effects
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.form-group').style.transform = 'translateY(-2px)';
                this.closest('.form-group').style.transition = 'transform 0.2s ease';
            });
            
            input.addEventListener('blur', function() {
                this.closest('.form-group').style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>