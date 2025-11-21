@extends('admin.layouts.app')

@section('title', 'Manajemen Informasi')

@section('page-title', 'Manajemen Informasi')

@section('content')
<style>
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 32px;
            margin-bottom: 32px;
            color: white;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .page-header-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .page-header-section h1 {
            font-size: 32px;
            font-weight: 700;
            margin: 0 0 8px 0;
            position: relative;
            z-index: 1;
        }

        .page-header-section p {
            font-size: 16px;
            opacity: 0.95;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .stat-card:nth-child(1)::before { background: linear-gradient(90deg, #3b82f6, #1d4ed8); }
        .stat-card:nth-child(2)::before { background: linear-gradient(90deg, #10b981, #059669); }
        .stat-card:nth-child(3)::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
        .stat-card:nth-child(4)::before { background: linear-gradient(90deg, #ef4444, #dc2626); }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .stat-card:nth-child(1) .stat-icon { background: #dbeafe; color: #1e40af; }
        .stat-card:nth-child(2) .stat-icon { background: #d1fae5; color: #065f46; }
        .stat-card:nth-child(3) .stat-icon { background: #fef3c7; color: #92400e; }
        .stat-card:nth-child(4) .stat-icon { background: #fee2e2; color: #991b1b; }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .stat-label {
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
        }

        .actions-bar {
            background: white;
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

.info-grid {
    display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 24px;
}

.info-card {
    background: white;
            border-radius: 16px;
            padding: 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            opacity: 0;
            transition: opacity 0.3s ease;
}

.info-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
            border-color: #cbd5e1;
        }

        .info-card:hover::before {
            opacity: 1;
        }

        .info-card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
}

.info-title {
            color: #1e293b;
            font-size: 18px;
            font-weight: 700;
            margin: 0;
    line-height: 1.4;
            flex: 1;
        }

        .info-badges {
    display: flex;
    flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
}

.badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
    text-transform: capitalize;
            white-space: nowrap;
}

.badge-announcement {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
    border: 1px solid #93c5fd;
}

.badge-news {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e3a8a;
    border: 1px solid #93c5fd;
}

.badge-event {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border: 1px solid #6ee7b7;
}

.badge-general {
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            color: #334155;
    border: 1px solid #cbd5e1;
}

        .badge-published {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .badge-draft {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
    border: 1px solid #fcd34d;
}

        .info-card-body {
            padding: 20px 24px;
            flex: 1;
        }

        .info-content {
            color: #475569;
            font-size: 14px;
            line-height: 1.7;
            margin: 0 0 16px 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .info-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            font-size: 12px;
            color: #64748b;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .meta-item i {
            font-size: 14px;
        }

        .info-card-footer {
            padding: 16px 24px;
            background: #f8fafc;
            border-top: 1px solid #f1f5f9;
    display: flex;
            gap: 12px;
        }

        .btn-sm {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-info {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }

        .btn-info:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
}

.empty-state {
            background: white;
            border-radius: 16px;
            padding: 64px 32px;
    text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 2px dashed #e2e8f0;
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 24px;
            opacity: 0.5;
        }

        .empty-state h3 {
            color: #1e293b;
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 12px 0;
}

.empty-state p {
            color: #64748b;
            font-size: 16px;
            margin: 0 0 32px 0;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

@media (max-width: 768px) {
    .info-grid {
        grid-template-columns: 1fr;
    }
    
            .stats-section {
                grid-template-columns: repeat(2, 1fr);
    }
    
            .actions-bar {
        flex-direction: column;
                align-items: stretch;
            }

            .btn-primary {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .stats-section {
                grid-template-columns: 1fr;
    }
}
</style>

<div class="container">
    <div class="page-header-section">
        <h1>Manajemen Informasi</h1>
        <p>Kelola informasi, pengumuman, dan berita sekolah dengan mudah</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @php
        $totalInfo = $informations->count();
        $publishedInfo = $informations->where('is_published', true)->count();
        $recentInfo = $informations->where('created_at', '>=', now()->subDays(7))->count();
    @endphp

    <div class="stats-section">
        <div class="stat-card">
            <div class="stat-number">{{ $totalInfo }}</div>
            <div class="stat-label">Total Informasi</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $publishedInfo }}</div>
            <div class="stat-label">Diterbitkan</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $recentInfo }}</div>
            <div class="stat-label">Minggu Ini</div>
        </div>
    </div>

    <div class="actions-bar">
        <h2 style="margin: 0; color: #1e293b; font-size: 20px; font-weight: 700;">Daftar Informasi</h2>
        <a href="{{ route('admin.information.create') }}" class="btn-primary">
            Tambah Informasi Baru
        </a>
    </div>

    @if($informations->count() > 0)
        <div class="info-grid">
            @foreach($informations as $info)
                <div class="info-card">
                    <div class="info-card-header">
                        <div style="flex: 1;">
                            <h3 class="info-title">{{ $info->title }}</h3>
                            <div class="info-badges">
                                <span class="badge badge-{{ $info->type }}">
                                    @if($info->type == 'announcement')
                                        Pengumuman
                                    @elseif($info->type == 'news')
                                        Berita
                                    @elseif($info->type == 'event')
                                        Acara
                                    @else
                                        Umum
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="info-card-body">
                        <p class="info-content">{{ Str::limit(strip_tags($info->content), 150) }}</p>
                        <div class="info-meta">
                            <div class="meta-item">
                                <span>{{ $info->creator->name ?? 'Admin' }}</span>
                            </div>
                            <div class="meta-item">
                                <span>{{ $info->created_at->format('d M Y') }}</span>
                            </div>
                            @if($info->published_at)
                                <div class="meta-item">
                                    <span>Terbit: {{ $info->published_at->format('d M Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="info-card-footer">
                        <a href="{{ route('admin.information.edit', $info->id) }}" class="btn-sm btn-info">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.information.destroy', $info->id) }}" style="display: inline; margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus informasi ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="fas fa-info-circle" style="font-size: 64px; color: #94a3b8;"></i>
            </div>
            <h3>Belum Ada Informasi</h3>
            <p>Mulai dengan menambahkan informasi pertama Anda</p>
            <a href="{{ route('admin.information.create') }}" class="btn-primary">
                Tambah Informasi Pertama
            </a>
        </div>
    @endif
</div>
@endsection
