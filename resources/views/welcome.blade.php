<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fbff, #eef4ff);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
        }

        .left {
            flex: 1;
        }

        .logo-box {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 35px;
        }

        .logo-box img {
            width: 95px;
            height: 95px;
            object-fit: contain;
        }

        .logo-text h1 {
            color: #0b2f75;
            font-size: 42px;
            font-weight: bold;
        }

        .logo-text p {
            color: #1680d8;
            font-size: 20px;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .left h2 {
            font-size: 56px;
            color: #0b1f4d;
            margin-bottom: 20px;
        }

        .left h2 span {
            color: #2563eb;
        }

        .left p {
            font-size: 20px;
            color: #4b5b78;
            line-height: 1.6;
            max-width: 500px;
        }

        .right {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .login-card {
            width: 430px;
            background: white;
            padding: 45px;
            border-radius: 25px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
        }

        .login-card h2 {
            text-align: center;
            font-size: 32px;
            color: #0b1f4d;
            margin-bottom: 10px;
        }

        .login-card p {
            text-align: center;
            color: #6b7280;
            margin-bottom: 35px;
        }

        .input-group {
            margin-bottom: 22px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #0b1f4d;
            font-weight: bold;
        }

        .input-group input {
            width: 100%;
            padding: 15px;
            border: 1px solid #cfd8e3;
            border-radius: 12px;
            font-size: 16px;
            outline: none;
        }

        .input-group input:focus {
            border-color: #2563eb;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
            color: #4b5563;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: #0b2f75;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-btn:hover {
            background: #2563eb;
        }

        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                text-align: center;
            }

            .logo-box {
                justify-content: center;
            }

            .left h2 {
                font-size: 42px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="left">
            <div class="logo-box">
                <img src="{{ asset('images/payroll_logo.png') }}" alt="Payroll Logo">

                <div class="logo-text">
                    <h1>PayEase</h1>
                    <p>MANAGEMENT SYSTEM</p>
                </div>
            </div>

            <h2>Payroll <span>Management</span> System</h2>

            <p>
                Manage employee salaries, payroll records, and payslips
                efficiently and securely in one place.
            </p>
        </div>

        <div class="right">
            <div class="login-card">
                <h2>Welcome Back!</h2>
                <p>Sign in to your account</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group">
                        <label>Email</label>

                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            required
                            autofocus>
                    </div>

                    <div class="input-group">
                        <label>Password</label>

                        <input type="password"
                            name="password"
                            placeholder="Enter your password"
                            required>
                    </div>

                    <div class="remember">
                        <input type="checkbox" name="remember">
                        <label>Remember Me</label>
                    </div>

                    @if ($errors->any())
                    <div style="color:red; margin-bottom:15px;">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <button type="submit" class="login-btn">
                        Login
                    </button>
                </form>
            </div>
        </div>

    </div>

</body>

</html>