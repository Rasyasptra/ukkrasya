<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Statistik Galeri - {{ date('d F Y') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #6366f1;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #1f2937;
            margin: 0 0 10px 0;
            font-size: 24px;
        }
        
        .header p {
            margin: 0;
            color: #6b7280;
        }
        
        .section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .stat-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #6366f1;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6b7280;
            font-size: 12px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .table th,
        .table td {
            border: 1px solid #e5e7eb;
            padding: 10px;
            text-align: left;
        }
        
        .table th {
            background: #f8fafc;
            font-weight: bold;
            color: #374151;
        }
        
        .table tr:nth-child(even) {
            background: #f9fafb;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }
        
        .no-data {
            text-align: center;
            color: #9ca3af;
            font-style: italic;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN STATISTIK GALERI FOTO</h1>
        <p>SMK Negeri 4 Bogor</p>
        <p>Periode: {{ date('d F Y') }}</p>
    </div>

    <!-- Overview Statistics -->
    <div class="section">
        <h2 class="section-title">Ringkasan Statistik</h2>
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-number">{{ number_format($stats['total_photos']) }}</div>
                <div class="stat-label">Total Foto</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ number_format($stats['total_users']) }}</div>
                <div class="stat-label">Total Pengguna</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ number_format($stats['total_likes']) }}</div>
                <div class="stat-label">Total Like</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ number_format($stats['total_comments']) }}</div>
                <div class="stat-label">Total Komentar</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ number_format($stats['total_information']) }}</div>
                <div class="stat-label">Total Informasi</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ number_format($stats['total_categories']) }}</div>
                <div class="stat-label">Total Kategori</div>
            </div>
        </div>
    </div>

    <!-- Most Liked Photos -->
    <div class="section">
        <h2 class="section-title">Foto Terbanyak Disukai</h2>
        @if($mostLikedPhotos->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul Foto</th>
                        <th>Jumlah Like</th>
                        <th>Kategori</th>
                        <th>Tanggal Upload</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mostLikedPhotos as $photo)
                        <tr>
                            <td>{{ $photo->title }}</td>
                            <td>{{ $photo->likes_count }}</td>
                            <td>{{ \App\Helpers\CategoryHelper::getCategoryName($photo->category) }}</td>
                            <td>{{ $photo->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-data">Belum ada foto yang disukai</p>
        @endif
    </div>

    <!-- Most Commented Photos -->
    <div class="section">
        <h2 class="section-title">Foto Terbanyak Dikomentari</h2>
        @if($mostCommentedPhotos->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul Foto</th>
                        <th>Jumlah Komentar</th>
                        <th>Kategori</th>
                        <th>Tanggal Upload</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mostCommentedPhotos as $photo)
                        <tr>
                            <td>{{ $photo->title }}</td>
                            <td>{{ $photo->comments_count }}</td>
                            <td>{{ \App\Helpers\CategoryHelper::getCategoryName($photo->category) }}</td>
                            <td>{{ $photo->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-data">Belum ada foto yang dikomentari</p>
        @endif
    </div>

    <!-- Recent Activity -->
    <div class="section">
        <h2 class="section-title">Aktivitas Terbaru</h2>
        
        <h3 style="font-size: 14px; font-weight: bold; margin: 15px 0 10px 0;">Foto Terbaru</h3>
        @if($recentPhotos->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul Foto</th>
                        <th>Pengunggah</th>
                        <th>Tanggal Upload</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentPhotos as $photo)
                        <tr>
                            <td>{{ $photo->title }}</td>
                            <td>{{ $photo->user ? $photo->user->name : 'Admin' }}</td>
                            <td>{{ $photo->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-data">Belum ada foto</p>
        @endif

        <h3 style="font-size: 14px; font-weight: bold; margin: 15px 0 10px 0;">Pengguna Terbaru</h3>
        @if($recentUsers->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Pengguna</th>
                        <th>Username</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-data">Belum ada pengguna</p>
        @endif

        <h3 style="font-size: 14px; font-weight: bold; margin: 15px 0 10px 0;">Komentar Terbaru</h3>
        @if($recentComments->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Komentar</th>
                        <th>Pengomentar</th>
                        <th>Foto</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentComments as $comment)
                        <tr>
                            <td>{{ Str::limit($comment->comment, 50) }}</td>
                            <td>{{ $comment->name }}</td>
                            <td>{{ Str::limit($comment->photo->title, 30) }}</td>
                            <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-data">Belum ada komentar</p>
        @endif
    </div>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis pada {{ date('d F Y H:i') }}</p>
        <p>Sistem Galeri Foto SMK Negeri 4 Bogor</p>
    </div>
</body>
</html>
