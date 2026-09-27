<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | SwiftTrack</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            background: #020617;
            overflow-x: hidden;
        }

        .login-page {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
        }

        .login-card {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: white;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.45);
            margin: 0 auto;
        }

        .login-left {
            background: linear-gradient(
                135deg,
                #172554 0%,
                #1e40af 55%,
                #2563eb 100%
            );

            color: white;
            padding: 55px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand {
            font-size: 30px;
            font-weight: 900;
            margin-bottom: 55px;
        }

        .brand span {
            color: #93c5fd;
        }

        .login-left h1 {
            font-size: 54px;
            line-height: 1.05;
            font-weight: 900;
            margin: 0;
        }

        .login-left-description {
            margin-top: 25px;
            font-size: 17px;
            line-height: 1.8;
            color: #dbeafe;
            max-width: 430px;
        }

        .features {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            color: #eff6ff;
            font-size: 16px;
        }

        .login-right {
            background: white;
            padding: 55px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h2 {
            margin: 0;
            color: #0f172a;
            font-size: 36px;
            line-height: 1.15;
            font-weight: 900;
        }

        .subtitle {
            margin-top: 12px;
            margin-bottom: 35px;
            color: #64748b;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
        }

        .form-group input {
            width: 100%;
            height: 54px;
            padding: 0 16px;
            border: 1px solid #cbd5e1;
            border-radius: 13px;
            background: #f8fafc;
            color: #0f172a;
            font-size: 15px;
            outline: none;
            transition: 0.2s ease;
        }

        .form-group input:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
        }

        .login-button {
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 13px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .login-button:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .register-text {
            text-align: center;
            margin-top: 28px;
            color: #64748b;
            font-size: 15px;
        }

        .register-text a {
            display: block;
            margin-top: 6px;
            color: #2563eb;
            font-weight: 800;
            text-decoration: none;
        }

        .admin-login {
            text-align: center;
            margin-top: 20px;
        }

        .admin-login a {
            color: #94a3b8;
            font-size: 13px;
            text-decoration: none;
        }

        .admin-login a:hover {
            color: #2563eb;
        }

        .error-box {
            margin-bottom: 20px;
            padding: 13px 15px;
            border-radius: 12px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            font-size: 14px;
        }

        @media (max-width: 800px) {
            .login-page {
                padding: 18px;
            }

            .login-card {
                grid-template-columns: 1fr;
                min-height: auto;
                max-width: 550px;
            }

            .login-left {
                display: none;
            }

            .login-right {
                padding: 35px 25px;
            }
        }
    </style>
</head>

<body>

<div class="login-page">

    <div class="login-card">

        <!-- LEFT SIDE -->

        <div class="login-left">

            <div class="brand">
                🚚 Swift<span>Track</span>
            </div>

            <h1>
                Track every parcel.<br>
                Every step.
            </h1>

            <p class="login-left-description">
                Book parcels, follow delivery progress and see
                the complete status history from one simple dashboard.
            </p>

            <div class="features">
                <div>✓ Easy parcel booking</div>
                <div>✓ Instant tracking number</div>
                <div>✓ Delivery status timeline</div>
            </div>

        </div>


        <!-- RIGHT SIDE -->

        <div class="login-right">

            <h2>
                Welcome back 👋
            </h2>

            <p class="subtitle">
                Login to your SwiftTrack account.
            </p>


            @if($errors->any())

                <div class="error-box">

                    @foreach($errors->all() as $error)

                        <div>{{ $error }}</div>

                    @endforeach

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('user.login.submit') }}"
            >

                @csrf

                <div class="form-group">

                    <label for="email">
                        Email address
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="you@example.com"
                    >

                </div>


                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        placeholder="••••••••"
                    >

                </div>


                <button
                    type="submit"
                    class="login-button"
                >
                    Login to SwiftTrack
                </button>

            </form>


            <div class="register-text">

                Don't have an account?

                <a href="{{ route('user.register') }}">
                    Create account
                </a>

            </div>


            <div class="admin-login">

                <a href="{{ route('admin.login') }}">
                    🔐 Admin Login
                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>