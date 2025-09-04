<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .forgot-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            color: #fff;
            animation: fadeIn 1s ease-in-out;
        }

        .forgot-container h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            outline: none;
        }

        .btn-custom {
            width: 100%;
            padding: 12px;
            font-weight: 600;
            border-radius: 12px;
            background: #ffd93d;
            border: none;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #ffb347;
            transform: scale(1.05);
        }

        .back-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #fff;
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="forgot-container">
    <h2>Forgot Password?</h2>
    <p class="text-center">Enter your email and we’ll send you a reset link.</p>
    
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
        <button type="submit" class="btn btn-custom">Send Reset Link</button>
    </form>

    @if(session('status'))
        <div class="alert alert-success text-center mt-3">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('login') }}" class="back-link">⬅ Back to Login</a>
</div>

</body>
</html>
