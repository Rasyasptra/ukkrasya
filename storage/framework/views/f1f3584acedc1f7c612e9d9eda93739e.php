<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?> - Web Gallery Sekolah</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #1e293b;
            color: white;
            padding: 20px 0;
        }

        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid #334155;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand h2 {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.2s;
        }

        .nav-link:hover {
            background: #334155;
            color: white;
        }

        .nav-link.active {
            background: #3b82f6;
            color: white;
        }

        .main-content {
            flex: 1;
            background: #f8fafc;
            padding: 30px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 8px 0;
        }

        .page-subtitle {
            color: #64748b;
            margin: 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-outline {
            background: transparent;
            color: #3b82f6;
            border: 1px solid #3b82f6;
        }

        .btn-outline:hover {
            background: #3b82f6;
            color: white;
        }

        .card {
            background: white;
            border-radius: 8px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: #3b82f6;
            color: white;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .sidebar {
                width: 220px;
            }

            .main-content {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block;
            }

            .sidebar {
                position: fixed;
                left: -250px;
                top: 0;
                height: 100vh;
                z-index: 1000;
                transition: left 0.3s ease;
                box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            }

            .sidebar.active {
                left: 0;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .main-content {
                padding: 80px 16px 20px;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .page-subtitle {
                font-size: 0.9rem;
            }

            .card {
                padding: 16px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 70px 12px 16px;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .btn {
                padding: 8px 16px;
                font-size: 0.9rem;
            }
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" onclick="toggleMobileMenu()"></div>

    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <div class="brand-logo">
                        <img src="<?php echo e(asset('logo.png')); ?>" alt="SMK Negeri 4 Bogor" style="height: 16px; width: auto; object-fit: contain;" onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=\'font-size: 20px; font-weight: 600; color: #3b82f6;\'>SMK</div>';">
                    </div>
                    <h2>Admin Panel</h2>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <ul class="nav-list">
                    <li>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo e(route('admin.photos.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.photos.*') ? 'active' : ''); ?>">
                            <span>Manajemen Foto</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo e(route('admin.information.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.information.*') ? 'active' : ''); ?>">
                            <span>Manajemen Informasi</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo e(route('admin.statistics.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.statistics.*') ? 'active' : ''); ?>">
                            <span>Laporan Statistik</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo e(route('gallery.index')); ?>" class="nav-link" target="_blank">
                            <span>Lihat Galeri</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="sidebar-footer" style="padding: 20px; border-top: 1px solid #334155; margin-top: auto;">
                <div class="user-info" style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                    <div class="user-avatar" style="width: 32px; height: 32px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px;">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </div>
                    <div class="user-details">
                        <p class="user-name" style="font-size: 14px; font-weight: 600; margin: 0;"><?php echo e(Auth::user()->name); ?></p>
                        <p class="user-role" style="font-size: 12px; color: #94a3b8; margin: 0;"><?php echo e(ucfirst(Auth::user()->role)); ?></p>
                    </div>
                </div>
                
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
                <button type="button" class="btn btn-outline" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="width: 100%; justify-content: center;">
                    Logout
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <?php if(!request()->routeIs('admin.photos.index')): ?>
            <div class="page-header">
                <h1 class="page-title"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
                <p class="page-subtitle"><?php echo $__env->yieldContent('page-subtitle', 'Selamat datang di Admin Panel'); ?></p>
            </div>
            <?php endif; ?>

            <div class="page-content">
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>

    <script>
        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\ujikomrasya\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>