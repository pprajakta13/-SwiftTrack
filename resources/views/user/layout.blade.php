<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'SwiftTrack')
    </title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #1e293b;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 250px;
            background: #0f172a;
            color: white;
            padding: 25px 18px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            padding: 10px 15px 30px;
        }

        .logo span {
            color: #60a5fa;
        }

        .menu-title {
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
            padding: 0 15px;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .nav {
            list-style: none;
        }

        .nav li {
            margin-bottom: 7px;
        }

        .nav a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 9px;
            transition: 0.2s;
        }

        .nav a:hover {
            background: #1e293b;
            color: white;
        }

        .nav a.active {
            background: #2563eb;
            color: white;
        }

        .logout-form {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 25px;
        }

        .logout-btn {
            width: 100%;
            border: none;
            background: #1e293b;
            color: #cbd5e1;
            padding: 12px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: #dc2626;
            color: white;
        }

        /* MAIN */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .topbar {
            height: 75px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .topbar h2 {
            font-size: 20px;
            color: #0f172a;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .user-name {
            font-weight: bold;
            color: #334155;
        }

        .content {
            padding: 35px;
        }

        /* ALERTS */

        .alert {
            padding: 14px 18px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* MOBILE */

        @media (max-width: 800px) {

            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                width: calc(100% - 210px);
            }

            .content {
                padding: 20px;
            }

            .topbar {
                padding: 0 20px;
            }
        }

        @media (max-width: 600px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .app {
                display: block;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .logout-form {
                position: static;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>

<div class="app">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="logo">
            Swift<span>Track</span>
        </div>

        <div class="menu-title">
            Main Menu
        </div>

        <ul class="nav">

            <li>
                <a href="{{ route('user.dashboard') }}">
                    🏠 Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('user.parcels.create') }}">
                    📦 Book Parcel
                </a>
            </li>

            <li>
                <a href="{{ route('user.parcels') }}">
                    🚚 My Parcels
                </a>
            </li>

        </ul>

        <form
            method="POST"
            action="{{ route('user.logout') }}"
            class="logout-form"
        >

            @csrf

            <button type="submit" class="logout-btn">
                🚪 Logout
            </button>

        </form>

    </aside>


    <!-- MAIN CONTENT -->

    <main class="main">

        <header class="topbar">

            <h2>
                @yield('page-title', 'SwiftTrack')
            </h2>

            <div class="user-info">

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="user-name">
                    {{ auth()->user()->name }}
                </div>

            </div>

        </header>


        <section class="content">

            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="alert alert-error">
                    {{ session('error') }}
                </div>

            @endif


            @yield('content')

        </section>

    </main>

</div>

</body>

</html>