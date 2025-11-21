<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Akses Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .access-request-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .access-icon {
            width: 80px;
            height: 80px;
            background: #ff6b6b;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: white;
        }

        .access-title {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .access-message {
            color: #7f8c8d;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .user-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .user-info h4 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .user-details {
            color: #7f8c8d;
            font-size: 14px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-approve {
            background: #27ae60;
            color: white;
        }

        .btn-approve:hover {
            background: #219a52;
            transform: translateY(-2px);
        }

        .btn-reject {
            background: #e74c3c;
            color: white;
        }

        .btn-reject:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .requested-url {
            background: #ecf0f1;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 12px;
            color: #2c3e50;
            margin-top: 15px;
            word-break: break-all;
        }
    </style>
</head>
<body>
    <div class="access-request-container">
        <div class="access-icon">
            🔒
        </div>
        
        <h1 class="access-title">Permintaan Akses Admin</h1>
        
        <p class="access-message">
            Anda mencoba mengakses area yang memerlukan hak akses administrator. 
            Silakan pilih tindakan yang ingin dilakukan:
        </p>

        <div class="user-info">
            <h4>Informasi Pengguna</h4>
            <div class="user-details">
                <strong>Nama:</strong> {{ $user->name }}<br>
                <strong>Username:</strong> {{ $user->username }}<br>
                <strong>Role:</strong> {{ ucfirst($user->role) }}
            </div>
        </div>

        <form method="GET" action="{{ $requested_url }}">
            <input type="hidden" name="request_access" value="1">
            <input type="hidden" name="original_url" value="{{ $requested_url }}">
            
            <div class="action-buttons">
                <button type="submit" name="action" value="approve" class="btn btn-approve">
                    ✓ Terima Akses
                </button>
                
                <button type="submit" name="action" value="reject" class="btn btn-reject">
                    ✗ Tolak Akses
                </button>
            </div>
        </form>

        <div class="requested-url">
            <strong>URL yang diminta:</strong><br>
            {{ $requested_url }}
        </div>
    </div>
</body>
</html>
