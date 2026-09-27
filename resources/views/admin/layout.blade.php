<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin | SwiftTrack')
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #0f172a;
            color: white;
            padding: 25px 18px;
            z-index: 1000;
        }

        .brand {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 1px solid #334155;
            margin-bottom: 25px;
        }

        .brand-icon {
            font-size: 40px;
            margin-bottom: 5px;
        }

        .brand h1 {
            font-size: 24px;
            margin: 0;
        }

        .brand p {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 5px;
        }

        .nav-title {
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 10px 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 9px;
            margin-bottom: 5px;
            font-size: 14px;
            transition: 0.2s;
        }

        .nav-link:hover {
            background: #1e293b;
            color: white;
        }

        .nav-link.active {
            background: #2563eb;
            color: white;
        }

        .nav-icon {
            width: 24px;
            text-align: center;
            font-size: 17px;
        }

        .admin-profile {
            position: absolute;
            bottom: 20px;
            left: 18px;
            right: 18px;
            border-top: 1px solid #334155;
            padding-top: 15px;
        }

        .admin-name {
            color: white;
            font-weight: bold;
            font-size: 13px;
        }

        .admin-email {
            color: #94a3b8;
            font-size: 11px;
            margin-top: 3px;
            word-break: break-word;
        }

        .logout-btn {
            width: 100%;
            margin-top: 12px;
            padding: 10px;
            border: 1px solid #475569;
            background: transparent;
            color: #cbd5e1;
            border-radius: 8px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: white;
        }

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .topbar h2 {
            color: #0f172a;
            font-size: 21px;
            margin: 0;
        }

        .admin-badge {
            background: #eff6ff;
            color: #2563eb;
            padding: 8px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .content {
            padding: 30px;
        }

        .success-message {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .error-message {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        @media (max-width: 800px) {

            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
            }

            .content {
                padding: 20px;
            }

        }

        @media (max-width: 650px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .admin-profile {
                position: static;
                margin-top: 20px;
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                padding: 0 18px;
            }

        }

    </style>

</head>


<body>


<!-- SIDEBAR -->

<aside class="sidebar">

    <div class="brand">

        <div class="brand-icon">
            🚚
        </div>

        <h1>
            SwiftTrack
        </h1>

        <p>
            Admin Control Centre
        </p>

    </div>


    <div class="nav-title">
        Management
    </div>


    <a
        href="{{ route('admin.dashboard') }}"
        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
    >

        <span class="nav-icon">
            📊
        </span>

        Dashboard

    </a>


    <a
        href="{{ route('admin.parcels') }}"
        class="nav-link {{ request()->routeIs('admin.parcels') ? 'active' : '' }}"
    >

        <span class="nav-icon">
            📦
        </span>

        Parcels

    </a>


    <a
        href="{{ route('admin.users') }}"
        class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}"
    >

        <span class="nav-icon">
            👥
        </span>

        Users

    </a>


    <a
        href="{{ route('admin.logs') }}"
        class="nav-link {{ request()->routeIs('admin.logs') ? 'active' : '' }}"
    >

        <span class="nav-icon">
            📋
        </span>

        Activity Logs

    </a>


    <div class="admin-profile">

        <div class="admin-name">
            {{ auth()->user()->name }}
        </div>

        <div class="admin-email">
            {{ auth()->user()->email }}
        </div>


        <form
            method="POST"
            action="{{ route('admin.logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="logout-btn"
            >
                🚪 Logout
            </button>

        </form>

    </div>

</aside>


<!-- MAIN CONTENT -->

<main class="main">


    <!-- TOP BAR -->

    <header class="topbar">

        <h2>
            @yield('page-title', 'Admin Dashboard')
        </h2>

        <div class="admin-badge">
            🛡️ Administrator
        </div>

    </header>


    <!-- PAGE CONTENT -->

    <section class="content">


        @if(session('success'))

            <div class="success-message">
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="error-message">
                {{ session('error') }}
            </div>

        @endif


        @yield('content')


    </section>

</main>


</body>

</html>