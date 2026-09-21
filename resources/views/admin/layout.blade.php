<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>@yield('title','Admin | SwiftTrack')</title><script src="https://cdn.tailwindcss.com"></script></head><body class="bg-slate-100 text-slate-900"><div class="min-h-screen md:flex"><aside class="hidden md:flex w-64 bg-slate-950 text-white flex-col fixed inset-y-0"><div class="p-6 border-b border-slate-800"><div class="text-2xl font-black">🚚 Swift<span class="text-blue-400">Track</span></div><p class="text-xs text-slate-500 mt-1">Admin Control Centre</p></div><nav class="p-4 space-y-2 flex-1"><a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl hover:bg-slate-800">🏠 Dashboard</a><a href="{{ route('admin.parcels') }}" class="block px-4 py-3 rounded-xl hover:bg-slate-800">📦 Parcels</a><a href="{{ route('admin.users') }}" class="block px-4 py-3 rounded-xl hover:bg-slate-800">👥 Users</a><a href="{{ route('admin.logs') }}" class="block px-4 py-3 rounded-xl hover:bg-slate-800">📝 Activity Logs</a></nav><div class="p-4 border-t border-slate-800"><form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="w-full text-left px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10">🚪 Logout</button></form></div></aside><main class="flex-1 md:ml-64"><header class="bg-white border-b px-6 py-4 flex items-center justify-between sticky top-0 z-10"><div><p class="text-xs text-slate-400">SwiftTrack Admin</p><h1 class="text-xl font-black">@yield('page-heading')</h1></div><div class="text-right"><p class="font-semibold text-sm">{{ auth()->user()->name }}</p><p class="text-xs text-blue-600">Administrator</p></div></header><section class="p-5 md:p-8">@if(session('success'))<div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3">{{ session('success') }}</div>@endif@if($errors->any())<div class="mb-6 rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3">{{ $errors->first() }}</div>@endif @yield('content')</section></main></div></body></html>
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


    <!-- MAIN -->

    <main class="main">

        <header class="topbar">

            <h2>
                @yield('page-title', 'Admin Dashboard')
            </h2>

            <div class="admin-badge">
                🛡️ Administrator
            </div>

        </header>


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