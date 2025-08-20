<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #667eea;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
            overflow: hidden;
        }

        .register-container {
            display: flex;
            width: 90%;
            max-width: 1000px;
            background: rgba(255,255,255,0.05);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            backdrop-filter: blur(15px);
        }

        /* Left animation section */
        .register-left {
            flex: 1;
            background: linear-gradient(135deg, #764ba2, #667eea);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .register-left h1 {
            font-size: 2.5rem;
            text-align: center;
            animation: slideIn 1.5s ease forwards;
            opacity: 0;
        }

        /* Floating animated circles */
        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.3;
            animation: float 10s linear infinite;
        }
        .circle1 { width: 100px; height: 100px; background: #ffd93d; top: 20%; left: 10%; animation-delay: 0s; }
        .circle2 { width: 150px; height: 150px; background: #6bc1ff; top: 60%; right: 15%; animation-delay: 3s; }
        .circle3 { width: 80px; height: 80px; background: #ff6b6b; top: 40%; left: 50%; animation-delay: 6s; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-40px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }

        @keyframes slideIn {
            to { opacity: 1; transform: translateY(0); }
            from { opacity: 0; transform: translateY(30px); }
        }

        /* Right register form */
        .register-right {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-right h2 {
            margin-bottom: 25px;
            font-weight: 700;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 10px;
            padding: 15px;
        }

        .btn-custom {
            width: 100%;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
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

        .login-link {
            margin-top: 15px;
            display: block;
            color: #fff;
            text-decoration: underline;
        }

        @media(max-width:768px){
            .register-container { flex-direction: column; }
            .register-left, .register-right { flex: unset; width: 100%; }
            .register-left { padding: 50px 0; }
        }
    </style>
</head>
<body>

<div class="register-container">

    <!-- Left animated section -->
    <div class="register-left">
        <h1>Join Task Manager</h1>
        <div class="circle circle1"></div>
        <div class="circle circle2"></div>
        <div class="circle circle3"></div>
    </div>

    <!-- Right register form -->
    <div class="register-right">
        <h2>Create Your Account</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Name" required>
            @error('name')
            <div style="color:red">{{ $message }}</div>
            @enderror
            <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Email" required>
            @error('email')
            <div style="color:red">{{ $message }}</div>
            @enderror
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            @error('password')
            <div style="color:red">{{ $message }}</div>
            @enderror
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            @error('password_confirmation')
            <div style="color:red">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-light text-dark btn-custom">Register</button>
        </form>
        <a href="{{ route('login') }}" class="login-link">Already have an account? Login</a>
    </div>

</div>

</body>
</html>
