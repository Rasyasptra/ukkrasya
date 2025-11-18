<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Notifikasi - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #60a5fa;
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #374151;
            color: #e2e8f0;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .notifications-list {
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
        }

        .notification-item {
            padding: 20px;
            border-bottom: 1px solid #334155;
            display: flex;
            gap: 16px;
            transition: background 0.3s;
        }

        .notification-item:hover {
            background: #2d3748;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item.unread {
            background: rgba(59, 130, 246, 0.1);
        }

        .notification-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 20px;
        }

        .notification-icon.comment {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
        }

        .notification-icon.like {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .notification-icon.register {
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
        }

        .notification-content {
            flex: 1;
        }

        .notification-message {
            font-size: 1rem;
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .notification-meta {
            display: flex;
            gap: 16px;
            font-size: 0.875rem;
            color: #94a3b8;
        }

        .notification-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            background: #374151;
            color: #e2e8f0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .btn-icon:hover {
            background: #4b5563;
        }

        .btn-icon.delete:hover {
            background: #dc2626;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 64px;
            color: #475569;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: #64748b;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border-radius: 8px;
            background: #374151;
            color: #e2e8f0;
            text-decoration: none;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: #4b5563;
        }

        .pagination .active {
            background: #3b82f6;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notification-item {
            animation: slideIn 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-bell"></i> Notifikasi</h1>
            <div class="header-actions">
                <button class="btn btn-secondary" onclick="markAllAsRead()">
                    <i class="fas fa-check-double"></i> Tandai Semua Dibaca
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        @if(session('success'))
            <div style="background: #10b981; color: white; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="notifications-list">
            @forelse($notifications as $notification)
                <div class="notification-item {{ $notification->is_read ? '' : 'unread' }}">
                    <div class="notification-icon {{ $notification->type }}">
                        @if($notification->type === 'comment')
                            <i class="fas fa-comment"></i>
                        @elseif($notification->type === 'like')
                            <i class="fas fa-heart"></i>
                        @elseif($notification->type === 'register')
                            <i class="fas fa-user-plus"></i>
                        @else
                            <i class="fas fa-bell"></i>
                        @endif
                    </div>
                    <div class="notification-content">
                        <div class="notification-message">
                            {{ $notification->message }}
                        </div>
                        <div class="notification-meta">
                            <span><i class="fas fa-clock"></i> {{ $notification->created_at->diffForHumans() }}</span>
                            @if($notification->user)
                                <span><i class="fas fa-user"></i> {{ $notification->user->name }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="notification-actions">
                        @if(!$notification->is_read)
                            <button class="btn-icon" onclick="markAsRead({{ $notification->id }})" title="Tandai dibaca">
                                <i class="fas fa-check"></i>
                            </button>
                        @endif
                        @if($notification->url)
                            <a href="{{ $notification->url }}" class="btn-icon" title="Lihat detail">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        @endif
                        <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon delete" title="Hapus" onclick="return confirm('Yakin ingin menghapus notifikasi ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-bell-slash"></i>
                    <h3>Tidak Ada Notifikasi</h3>
                    <p>Belum ada notifikasi untuk ditampilkan</p>
                </div>
            @endforelse
        </div>

        @if($notifications->hasPages())
            <div class="pagination">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

    <script>
        function markAsRead(id) {
            fetch(`/admin/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function markAllAsRead() {
            if (confirm('Tandai semua notifikasi sebagai dibaca?')) {
                fetch('/admin/notifications/read-all', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }
    </script>
</body>
</html>
