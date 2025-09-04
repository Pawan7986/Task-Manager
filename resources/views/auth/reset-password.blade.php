<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        body {
            background: #f4f4f9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
        }
        input:focus {
            border-color: #667eea;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }
        button:hover {
            background: linear-gradient(135deg, #5a67d8, #6b46c1);
        }
        .errors {
            background: #ffe5e5;
            color: #b00020;
            border: 1px solid #f5c2c2;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            font-size: 13px;
        }
        .success {
            background: #e6ffed;
            color: #256029;
            border: 1px solid #b6e7c9;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>🔑 Reset Your Password</h2>

        @if($errors->any())
            <div class="errors">
                <ul style="margin:0; padding-left:18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <input type="email" name="email" value="{{ $email }}" readonly>

            <input type="password" name="password" placeholder="New Password" required>

            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

            <button type="submit">Reset Password</button>
        </form>
    </div>

</body>
</html>
