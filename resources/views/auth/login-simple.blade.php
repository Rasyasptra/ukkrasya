<!DOCTYPE html>
<html>
<head>
    <title>Simple Login Test</title>
    <style>
        body { 
            font-family: Arial; 
            max-width: 400px; 
            margin: 50px auto; 
            padding: 20px;
            background: #f5f5f5;
        }
        .box { 
            background: white; 
            padding: 30px; 
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        input { 
            width: 100%; 
            padding: 10px; 
            margin: 10px 0; 
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button { 
            width: 100%; 
            padding: 12px; 
            background: #4CAF50; 
            color: white; 
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover { background: #45a049; }
        .error { 
            background: #ffebee; 
            color: #c62828; 
            padding: 10px; 
            margin: 10px 0;
            border-radius: 4px;
            border-left: 4px solid #c62828;
        }
        .info {
            background: #e3f2fd;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
            border-left: 4px solid #2196F3;
        }
        .info code {
            background: #fff;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
        h2 { margin-top: 0; color: #333; }
        .test-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            background: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .test-link:hover {
            background: #1976D2;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>🔐 Simple Login Test</h2>
        
        <div class="info">
            <strong>Kredensial:</strong><br>
            Username: <code>admin</code><br>
            Password: <code>admin123</code>
        </div>

        @if($errors->any())
            <div class="error">
                <strong>Error:</strong> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" value="admin" required autofocus>
            <input type="password" name="password" placeholder="Password" value="admin123" required>
            <button type="submit">LOGIN</button>
        </form>

        <a href="{{ route('test.direct.login') }}" class="test-link">
            🧪 Test Direct Login (Bypass Form)
        </a>
    </div>
</body>
</html>
