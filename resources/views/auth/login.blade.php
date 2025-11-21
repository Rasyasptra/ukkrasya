<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Web Gallery Sekolah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            color: #f1f5f9;
        }

        .login-container {
            background: #374151;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            border: 1px solid #4b5563;
        }

        .header {
            background: #374151;
            padding: 40px 32px 32px;
            text-align: center;
            border-bottom: 1px solid #4b5563;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: transparent;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 600;
            color: #f1f5f9;
        }

        .header p {
            font-size: 15px;
            color: #94a3b8;
            font-weight: 400;
        }

        .form-container {
            padding: 32px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #d1d5db;
            font-weight: 500;
            font-size: 14px;
            letter-spacing: -0.025em;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #4b5563;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.2s ease;
            background: #2d3748;
            color: #f1f5f9;
            font-family: inherit;
        }

        .form-group input:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
            background: #374151;
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .error-message {
            color: #dc2626;
            font-size: 14px;
            margin-bottom: 20px;
            padding: 12px 16px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            border-left: 4px solid #dc2626;
        }

        .success-message {
            color: #059669;
            font-size: 14px;
            margin-bottom: 20px;
            padding: 12px 16px;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            border-left: 4px solid #059669;
        }

        .info-message {
            color: #2563eb;
            font-size: 14px;
            margin-bottom: 20px;
            padding: 12px 16px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            border-left: 4px solid #2563eb;
        }

        .submit-btn {
            width: 100%;
            padding: 14px 20px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            letter-spacing: -0.025em;
        }

        .submit-btn:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
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

        .footer {
            text-align: center;
            padding: 24px 32px 32px;
            background: #374151;
            color: #94a3b8;
            font-size: 14px;
            border-top: 1px solid #4b5563;
        }

        .footer a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .footer a:hover {
            color: #3b82f6;
            text-decoration: underline;
        }

        .divider {
            margin: 0 8px;
            color: #d1d5db;
        }

        .loading {
            display: none;
        }

        .loading.show {
            display: inline-block;
        }

        .spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .form-actions {
            margin-top: 24px;
            text-align: center;
        }

        .forgot-password {
            color: #60a5fa;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 10px;
                border-radius: 12px;
            }
            
            .header, .form-container, .footer {
                padding: 24px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .brand-logo {
                width: 70px;
                height: 70px;
            }
        }

    </style>
</head>
<body>
    <div class="login-container">
        <div class="header">
            <div class="brand-logo">
                <img src="{{ asset('logo.png') }}" alt="SMK Negeri 4 Bogor" onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=\'font-size: 24px; font-weight: 600; color: #6366f1;\'>SMK N 4</div>';">
            </div>
            <h1>Selamat Datang</h1>
            <p>Masuk ke akun Anda untuk mengakses dashboard</p>
        </div>

        <div class="form-container">
            @if(session('info'))
                <div class="info-message">
                    <strong>Info:</strong> {{ session('info') }}
                </div>
            @endif

            @if(session('success'))
                <div class="success-message">
                    <strong>Sukses:</strong> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="error-message">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-message">
                    <strong>Login gagal!</strong> {{ $errors->first() }}
                </div>
            @endif

            @if(session('show_admin_login'))
                <div class="info-message" style="margin-bottom: 30px;">
                    <strong>🔐 Admin Access Required</strong><br>
                    You're currently logged in as a regular user. To access the admin dashboard, please login with administrator credentials below.
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label for="username">Email atau Username</label>
                    <input 
                        id="username" 
                        type="text" 
                        name="username" 
                        value="{{ old('username', 'admin') }}" 
                        autocomplete="off" 
                        required 
                        autofocus
                        placeholder="Masukkan email atau username Anda"
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        autocomplete="off" 
                        required
                        placeholder="Masukkan password Anda"
                    >
                </div>

                <button type="submit" class="submit-btn" id="loginButton" style="margin-top: 24px;">
                    <span class="spinner" id="loginSpinner"></span>
                    <span id="loginText">Masuk</span>
                </button>
            </form>

            <!-- Registration disabled for security -->
        </div>

        <div class="footer">
            <p> 2024 Web Gallery Sekolah<span class="divider">•</span>Hak Cipta Dilindungi</p>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const loading = document.getElementById('loading');
            const btnText = document.getElementById('btnText');
            
            // Show loading state
            submitBtn.disabled = true;
            loading.classList.add('show');
            btnText.textContent = 'Memproses...';
        });

        // Add focus effects
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>
