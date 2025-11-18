<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Web Gallery Sekolah</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <div class="brand-logo">
                        <img src="{{ asset('logo.png') }}" alt="SMK Negeri 4 Bogor" style="height: 16px; width: auto; object-fit: contain;" onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=\'font-size: 20px; font-weight: 600; color: #3b82f6;\'>SMK</div>';">
                    </div>
                    <h2>Admin Panel</h2>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <ul class="nav-list">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('admin.photos.index') }}" class="nav-link {{ request()->routeIs('admin.photos.*') ? 'active' : '' }}">
                            <span>Manajemen Foto</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('admin.information.index') }}" class="nav-link {{ request()->routeIs('admin.information.*') ? 'active' : '' }}">
                            <span>Manajemen Informasi</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('admin.statistics.index') }}" class="nav-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                            <span>Laporan Statistik</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('gallery.index') }}" class="nav-link" target="_blank">
                            <span>Lihat Galeri</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="sidebar-footer" style="padding: 20px; border-top: 1px solid #334155; margin-top: auto;">
                <div class="user-info" style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                    <div class="user-avatar" style="width: 32px; height: 32px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <p class="user-name" style="font-size: 14px; font-weight: 600; margin: 0;">{{ Auth::user()->name }}</p>
                        <p class="user-role" style="font-size: 12px; color: #94a3b8; margin: 0;">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                </div>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button type="button" class="btn btn-outline" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="width: 100%; justify-content: center;">
                    Logout
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @if(!request()->routeIs('admin.photos.index'))
            <div class="page-header">
                <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                <p class="page-subtitle">@yield('page-subtitle', 'Selamat datang di Admin Panel')</p>
            </div>
            @endif

            <div class="page-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
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
    </script>
    
    @stack('scripts')
</body>
</html>
