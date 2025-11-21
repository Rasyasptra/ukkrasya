<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Website Sekolah</title>
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
        }

        .register-container {
            background: #374151;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            position: relative;
            border: 1px solid #4b5563;
        }

        .register-header {
            background: #1e293b;
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid #4b5563;
        }


        .register-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .register-header p {
            font-size: 1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .register-form {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #d1d5db;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #4b5563;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #2d3748;
            color: #f1f5f9;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #60a5fa;
            background: #374151;
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.1);
        }

        .form-group.error input,
        .form-group.error select,
        .form-group.error textarea {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .form-group.error .error-message {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 6px;
            display: block;
        }

        /* Password visibility toggle */
        .password-toggle {
            position: relative;
        }

        .password-toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            color: #9ca3af;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle-btn:hover {
            color: #d1d5db;
        }

        .password-toggle-btn svg {
            width: 20px;
            height: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .password-strength {
            margin-top: 8px;
            font-size: 0.8rem;
        }

        .strength-bar {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 4px;
        }

        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #ef4444; width: 25%; }
        .strength-fair { background: #f59e0b; width: 50%; }
        .strength-good { background: #10b981; width: 75%; }
        .strength-strong { background: #059669; width: 100%; }

        .terms-group {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 24px;
        }

        .terms-group input[type="checkbox"] {
            width: auto;
            margin-top: 4px;
        }

        .terms-group label {
            margin-bottom: 0;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .terms-group {
            color: #d1d5db;
        }

        .terms-group a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 500;
        }

        .terms-group a:hover {
            color: #3b82f6;
            text-decoration: underline;
        }

        .accept-all-section {
            margin-bottom: 20px;
            padding: 16px;
            background: #2d3748;
            border-radius: 8px;
            border: 1px solid #4b5563;
        }

        .accept-all-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .accept-all-title {
            font-weight: 600;
            color: #d1d5db;
            font-size: 0.95rem;
        }

        .accept-all-btn {
            background: #10b981;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .accept-all-btn:hover {
            background: #059669;
        }

        .accept-all-btn.accepted {
            background: #6b7280;
        }

        .register-btn {
            width: 100%;
            background: #3b82f6;
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .register-btn:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .register-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .login-link {
            text-align: center;
            color: #6b7280;
            font-size: 0.9rem;
        }

        .login-link {
            color: #94a3b8;
        }

        .login-link a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            color: #3b82f6;
            text-decoration: underline;
        }

        .admin-notice {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 24px;
            color: #92400e;
            font-size: 0.85rem;
            text-align: center;
        }

        .admin-notice strong {
            color: #78350f;
        }

        .success-message {
            background: rgba(16, 185, 129, 0.1);
            border: 2px solid #10b981;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            color: #10b981;
            font-size: 0.95rem;
            text-align: center;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
            animation: slideDown 0.5s ease-out;
            position: relative;
        }

        .success-message::before {
            content: '✓';
            display: inline-block;
            width: 24px;
            height: 24px;
            background: #10b981;
            color: white;
            border-radius: 50%;
            margin-right: 10px;
            line-height: 24px;
            font-weight: bold;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 2px solid #ef4444;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            color: #ef4444;
            font-size: 0.95rem;
            text-align: center;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
            animation: slideDown 0.5s ease-out;
            position: relative;
        }

        .error-message::before {
            content: '✗';
            display: inline-block;
            width: 24px;
            height: 24px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            margin-right: 10px;
            line-height: 24px;
            font-weight: bold;
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

        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .register-container {
                margin: 0;
                border-radius: 16px;
                max-width: 100%;
            }

            .register-header {
                padding: 30px 20px;
            }

            .register-header h1 {
                font-size: 1.75rem;
                line-height: 1.3;
            }

            .register-header p {
                font-size: 0.9rem;
            }

            .register-form {
                padding: 30px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                padding: 12px 14px;
                font-size: 0.95rem;
            }

            .form-group label {
                font-size: 0.85rem;
            }

            .register-btn {
                padding: 14px;
                font-size: 1rem;
            }

            .login-link {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .register-container {
                border-radius: 12px;
            }

            .register-header {
                padding: 25px 15px;
            }

            .register-header h1 {
                font-size: 1.5rem;
            }

            .register-form {
                padding: 25px 15px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                padding: 10px 12px;
                font-size: 0.9rem;
            }

            .form-group label {
                font-size: 0.8rem;
            }

            .register-btn {
                padding: 12px;
                font-size: 0.95rem;
            }

            .login-link {
                font-size: 0.8rem;
            }

            .terms-group label {
                font-size: 0.75rem;
            }

            .accept-all-section {
                padding: 12px;
            }

            .accept-all-title {
                font-size: 0.85rem;
            }

            .accept-all-btn {
                padding: 4px 8px;
                font-size: 0.75rem;
            }
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>Daftar Akun</h1>
            <p>Bergabunglah dengan komunitas sekolah kami</p>
        </div>

        <div class="register-form">
            <?php if(session('success')): ?>
                <div class="success-message">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="error-message">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="error-message">
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin: 8px 0 0 20px; text-align: left;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

<form method="POST" action="<?php echo e(route('register.post')); ?>" id="registerForm">
                <?php echo csrf_field(); ?>
                
                <div class="form-group <?php echo e($errors->has('name') ? 'error' : ''); ?>">
                    <label for="name">Nama Lengkap *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="<?php echo e(old('name')); ?>" 
                           required 
                           placeholder="Masukkan nama lengkap Anda">
                    <?php if($errors->has('name')): ?>
                        <span class="error-message"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <div class="form-group <?php echo e($errors->has('username') ? 'error' : ''); ?>">
                        <label for="username">Username *</label>
                        <input type="text" 
                               id="username" 
                               name="username" 
                               value="<?php echo e(old('username')); ?>" 
                               required 
                               placeholder="Username unik"
                               onblur="checkUsername(this.value)">
                        <?php if($errors->has('username')): ?>
                            <span class="error-message"><?php echo e($errors->first('username')); ?></span>
                        <?php endif; ?>
                        <div id="username-feedback" class="password-strength"></div>
                    </div>

                    <div class="form-group <?php echo e($errors->has('email') ? 'error' : ''); ?>">
                        <label for="email">Email *</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="<?php echo e(old('email')); ?>" 
                               required 
                               placeholder="email@example.com"
                               onblur="checkEmail(this.value)">
                        <?php if($errors->has('email')): ?>
                            <span class="error-message"><?php echo e($errors->first('email')); ?></span>
                        <?php endif; ?>
                        <div id="email-feedback" class="password-strength"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group <?php echo e($errors->has('password') ? 'error' : ''); ?>">
                        <label for="password">Password *</label>
                        <div class="password-toggle">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   required 
                                   placeholder="Minimal 8 karakter"
                                   onkeyup="checkPasswordStrength(this.value)">
                            <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        <?php if($errors->has('password')): ?>
                            <span class="error-message"><?php echo e($errors->first('password')); ?></span>
                        <?php endif; ?>
                        <div class="password-strength">
                            <span id="strength-text" style="color: #f1f5f9;">Kekuatan password</span>
                            <div class="strength-bar">
                                <div class="strength-fill" id="strength-fill"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group <?php echo e($errors->has('password_confirmation') ? 'error' : ''); ?>">
                        <label for="password_confirmation">Konfirmasi Password *</label>
                        <div class="password-toggle">
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required 
                                   placeholder="Ulangi password">
                            <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password_confirmation')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        <?php if($errors->has('password_confirmation')): ?>
                            <span class="error-message"><?php echo e($errors->first('password_confirmation')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group <?php echo e($errors->has('phone') ? 'error' : ''); ?>">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               value="<?php echo e(old('phone')); ?>" 
                               placeholder="08123456789">
                        <?php if($errors->has('phone')): ?>
                            <span class="error-message"><?php echo e($errors->first('phone')); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group <?php echo e($errors->has('gender') ? 'error' : ''); ?>">
                        <label for="gender">Jenis Kelamin</label>
                        <select id="gender" name="gender">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="male" <?php echo e(old('gender') == 'male' ? 'selected' : ''); ?>>Laki-laki</option>
                            <option value="female" <?php echo e(old('gender') == 'female' ? 'selected' : ''); ?>>Perempuan</option>
                            <option value="other" <?php echo e(old('gender') == 'other' ? 'selected' : ''); ?>>Lainnya</option>
                        </select>
                        <?php if($errors->has('gender')): ?>
                            <span class="error-message"><?php echo e($errors->first('gender')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

<div class="form-group <?php echo e($errors->has('address') ? 'error' : ''); ?>">
                    <label for="address">Alamat</label>
                    <textarea id="address" 
                              name="address" 
                              rows="3" 
                              placeholder="Masukkan alamat lengkap"><?php echo e(old('address')); ?></textarea>
                    <?php if($errors->has('address')): ?>
                        <span class="error-message"><?php echo e($errors->first('address')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="accept-all-section">
                    <div class="accept-all-header">
                        <span class="accept-all-title">📋 Persetujuan Pendaftaran</span>
                        <button type="button" class="accept-all-btn" id="acceptAllBtn" onclick="acceptAllTerms()">
                            Accept All
                        </button>
                    </div>
                    <p style="font-size: 0.85rem; color: #6b7280; margin-bottom: 12px;">
                        Klik "Accept All" untuk menyetujui semua syarat dan ketentuan secara otomatis
                    </p>
                </div>

                <div class="terms-group <?php echo e($errors->has('terms') ? 'error' : ''); ?>">
                    <input type="checkbox" 
                           id="terms" 
                           name="terms" 
                           value="1" 
                           <?php echo e(old('terms') ? 'checked' : ''); ?> 
                           required>
                    <label for="terms">
                        Saya setuju dengan <a href="#" target="_blank">Syarat dan Ketentuan</a> 
                        serta <a href="#" target="_blank">Kebijakan Privasi</a> yang berlaku
                    </label>
                    <?php if($errors->has('terms')): ?>
                        <span class="error-message"><?php echo e($errors->first('terms')); ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="register-btn" id="submitBtn">
                    <span id="btnText">Daftar Sekarang</span>
                    <span id="btnLoading" class="loading" style="display: none;"></span>
                </button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="<?php echo e(route('user.login')); ?>">Login di sini</a>
            </div>
        </div>
    </div>

    <script>
        // Password strength checker
        function checkPasswordStrength(password) {
            const strengthFill = document.getElementById('strength-fill');
            const strengthText = document.getElementById('strength-text');
            
            let strength = 0;
            let feedback = '';

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            switch (strength) {
                case 0:
                case 1:
                    strengthFill.className = 'strength-fill strength-weak';
                    feedback = 'Sangat Lemah';
                    break;
                case 2:
                    strengthFill.className = 'strength-fill strength-fair';
                    feedback = 'Lemah';
                    break;
                case 3:
                    strengthFill.className = 'strength-fill strength-good';
                    feedback = 'Sedang';
                    break;
                case 4:
                case 5:
                    strengthFill.className = 'strength-fill strength-strong';
                    feedback = 'Kuat';
                    break;
            }

            strengthText.textContent = feedback;
                        strengthText.style.color = '#f1f5f9';
        }

        // Username availability checker
        function checkUsername(username) {
            if (username.length < 3) return;
            
            fetch('<?php echo e(route("register.checkUsername")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ username: username })
            })
            .then(response => response.json())
            .then(data => {
                const feedback = document.getElementById('username-feedback');
                if (data.available) {
                    feedback.innerHTML = '<span style="color: #10b981;">✓ ' + data.message + '</span>';
                } else {
                    feedback.innerHTML = '<span style="color: #ef4444;">✗ ' + data.message + '</span>';
                }
            });
        }

        // Email availability checker
        function checkEmail(email) {
            if (!email.includes('@')) return;
            
            fetch('<?php echo e(route("register.checkEmail")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                const feedback = document.getElementById('email-feedback');
                if (data.available) {
                    feedback.innerHTML = '<span style="color: #10b981;">✓ ' + data.message + '</span>';
                } else {
                    feedback.innerHTML = '<span style="color: #ef4444;">✗ ' + data.message + '</span>';
                }
            });
        }

        // Accept All functionality
        function acceptAllTerms() {
            const termsCheckbox = document.getElementById('terms');
            const acceptAllBtn = document.getElementById('acceptAllBtn');
            
            // Check the terms checkbox
            termsCheckbox.checked = true;
            
            // Update button state
            acceptAllBtn.textContent = 'Accepted ✓';
            acceptAllBtn.classList.add('accepted');
            acceptAllBtn.disabled = true;
            
            // Show success feedback
            const acceptAllSection = document.querySelector('.accept-all-section');
            const successMessage = document.createElement('div');
            successMessage.style.cssText = 'margin-top: 8px; padding: 8px; background: #d1fae5; color: #065f46; border-radius: 6px; font-size: 0.8rem;';
            successMessage.textContent = '✓ Semua syarat dan ketentuan telah disetujui';
            
            // Remove existing success message if any
            const existingMessage = acceptAllSection.querySelector('.success-message');
            if (existingMessage) {
                existingMessage.remove();
            }
            
            successMessage.className = 'success-message';
            acceptAllSection.appendChild(successMessage);
            
            // Hide success message after 3 seconds
            setTimeout(() => {
                if (successMessage.parentNode) {
                    successMessage.remove();
                }
            }, 3000);
        }

        // Password visibility toggle
        function togglePasswordVisibility(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleBtn = passwordField.nextElementSibling;
            const eyeIcon = toggleBtn.querySelector('svg');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                // Change eye icon to show "eye off" state
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                passwordField.type = 'password';
                // Change eye icon to show "eye on" state
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }

        // Form submission
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnLoading = document.getElementById('btnLoading');

            submitBtn.disabled = true;
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline-block';
        });

        // Add CSRF token meta tag
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = '<?php echo e(csrf_token()); ?>';
        document.head.appendChild(meta);
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\ujikomrasya\resources\views/auth/register.blade.php ENDPATH**/ ?>