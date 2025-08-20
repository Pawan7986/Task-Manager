<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden;
        }

        /* Floating shapes animation */
        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.6;
            animation: float 10s linear infinite;
        }
        .shape1 { width: 150px; height: 150px; background: #ff6b6b; top: 10%; left: 5%; animation-delay: 0s; }
        .shape2 { width: 200px; height: 200px; background: #ffd93d; bottom: 15%; right: 10%; animation-delay: 2s; }
        .shape3 { width: 100px; height: 100px; background: #6bc1ff; top: 50%; left: 70%; animation-delay: 4s; }
        @keyframes float {
            0% { transform: translateY(0) translateX(0) rotate(0deg); }
            50% { transform: translateY(-50px) translateX(30px) rotate(180deg); }
            100% { transform: translateY(0) translateX(0) rotate(360deg); }
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 60px 40px;
            border-radius: 20px;
            text-align: center;
            backdrop-filter: blur(15px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            z-index: 10;
            animation: fadeIn 2s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        .welcome-card h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .welcome-card p {
            font-size: 1.2rem;
            margin-bottom: 35px;
        }

        .btn-custom {
            width: 160px;
            font-weight: 600;
            margin: 5px;
            transition: 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-custom::after {
            content: '';
            position: absolute;
            width: 0;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(255,255,255,0.2);
            transition: 0.4s;
        }

        .btn-custom:hover::after {
            width: 100%;
        }

        .btn-custom:hover {
            transform: scale(1.05);
        }

    </style>
</head>
<body>

    <!-- Floating shapes -->
    <div class="shape shape1"></div>
    <div class="shape shape2"></div>
    <div class="shape shape3"></div>

    <div class="welcome-card">
        <h1>Welcome to Task Manager</h1>
        <p>Organize your projects and tasks efficiently. Login or register to get started.</p>
        <div>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg btn-custom">Login</a>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg btn-custom text-dark">Register</a>
        </div>
    </div>

</body>
</html>
