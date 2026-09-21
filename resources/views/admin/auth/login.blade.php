<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Login | SwiftTrack</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;

            background:
                linear-gradient(
                    135deg,
                    #020617,
                    #1e3a8a
                );

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 430px;

            background: white;

            border-radius: 20px;

            padding: 35px;

            box-shadow:
                0 25px 60px rgba(0,0,0,.3);
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-icon {
            font-size: 50px;
        }

        .logo h1 {
            color: #0f172a;
            margin-top: 7px;
        }

        .logo p {
            color: #64748b;
            font-size: 13px;
            margin-top: 5px;
        }

        h2 {
            text-align: center;
            color: #0f172a;
            margin-bottom: 7px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #334155;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 13px;

            border: 1px solid #cbd5e1;
            border-radius: 9px;

            outline: none;
        }

        input:focus {
            border-color: #2563eb;
        }

        .error {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px;
            border-radius: 9px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        button {
            width: 100%;
            padding: 13px;

            border: none;
            border-radius: 9px;

            background: #2563eb;
            color: white;

            font-size: 15px;
            font-weight: bold;

            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .user-login {
            text-align: center;
            margin-top: 20px;
        }

        .user-login a {
            color: #2563eb;
            text-decoration: none;
            font-size: 13px;
        }

    </style>

</head>

<body>

<div class="card">

    <div class="logo">

        <div class="logo-icon">
            🛡️
        </div>

        <h1>
            SwiftTrack
        </h1>

        <p>
            Admin Control Centre
        </p>

    </div>


    <h2>
        Administrator Login
    </h2>

    <p class="subtitle">
        Login to manage SwiftTrack
    </p>


    @if($errors->any())

        <div class="error">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('admin.login.submit') }}"
    >

        @csrf


        <div class="form-group">

            <label>
                Email Address
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Admin email"
                required
                autofocus
            >

        </div>


        <div class="form-group">

            <label>
                Password
            </label>

            <input
                type="password"
                name="password"
                placeholder="Admin password"
                required
            >

        </div>


        <button type="submit">
            🔐 Login to Admin Panel
        </button>

    </form>


    <div class="user-login">

        <a href="{{ route('user.login') }}">
            ← Back to User Login
        </a>

    </div>

</div>

</body>

</html>