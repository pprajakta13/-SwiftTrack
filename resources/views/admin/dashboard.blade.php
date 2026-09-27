@extends('admin.layout')

@section('title', 'Admin Dashboard | SwiftTrack')

@section('page-title', 'Dashboard')

@section('content')

<style>

    .welcome {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        color: white;
        border-radius: 17px;
        padding: 30px;
        margin-bottom: 25px;
    }

    .welcome h1 {
        font-size: 27px;
        margin-bottom: 8px;
    }

    .welcome p {
        color: #dbeafe;
        font-size: 14px;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 22px;
    }

    .stat-icon {
        font-size: 28px;
        margin-bottom: 12px;
    }

    .stat h3 {
        font-size: 28px;
        color: #0f172a;
        margin-bottom: 5px;
    }

    .stat p {
        color: #64748b;
        font-size: 13px;
    }

    .quick {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 25px;
    }

    .quick h2 {
        color: #0f172a;
        margin-bottom: 18px;
        font-size: 20px;
    }

    .quick-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .quick-card {
        text-decoration: none;
        border: 1px solid #e2e8f0;
        padding: 20px;
        border-radius: 12px;
        color: #0f172a;
        transition: 0.2s;
    }

    .quick-card:hover {
        border-color: #2563eb;
        transform: translateY(-2px);
    }

    .quick-card div {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .quick-card strong {
        display: block;
        margin-bottom: 5px;
    }

    .quick-card span {
        color: #64748b;
        font-size: 12px;
    }

    @media (max-width: 900px) {

        .stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .quick-grid {
            grid-template-columns: 1fr;
        }

    }

    @media (max-width: 550px) {

        .stats {
            grid-template-columns: 1fr;
        }

    }

</style>


<!-- WELCOME SECTION -->

<div class="welcome">

    <h1>
        Welcome back, {{ auth()->user()->name }} 👋
    </h1>

    <p>
        Here's what's happening with SwiftTrack.
    </p>

</div>


<!-- STATISTICS -->

<div class="stats">

    <!-- TOTAL PARCELS -->

    <div class="stat">

        <div class="stat-icon">
            📦
        </div>

        <h3>
            {{ $totalParcels ?? 0 }}
        </h3>

        <p>
            Total Parcels
        </p>

    </div>


    <!-- IN TRANSIT -->

    <div class="stat">

        <div class="stat-icon">
            🚚
        </div>

        <h3>
            {{ $inTransit ?? 0 }}
        </h3>

        <p>
            In Transit
        </p>

    </div>


    <!-- DELIVERED -->

    <div class="stat">

        <div class="stat-icon">
            ✅
        </div>

        <h3>
            {{ $delivered ?? 0 }}
        </h3>

        <p>
            Delivered
        </p>

    </div>


    <!-- USERS -->

    <div class="stat">

        <div class="stat-icon">
            👥
        </div>

        <h3>
            {{ $totalUsers ?? 0 }}
        </h3>

        <p>
            Registered Users
        </p>

    </div>

</div>


<!-- QUICK MANAGEMENT -->

<div class="quick">

    <h2>
        Quick Management
    </h2>

    <div class="quick-grid">


        <!-- MANAGE PARCELS -->

        <a
            href="{{ route('admin.parcels') }}"
            class="quick-card"
        >

            <div>
                📦
            </div>

            <strong>
                Manage Parcels
            </strong>

            <span>
                View and update courier parcels.
            </span>

        </a>


        <!-- MANAGE USERS -->

        <a
            href="{{ route('admin.users') }}"
            class="quick-card"
        >

            <div>
                👥
            </div>

            <strong>
                Manage Users
            </strong>

            <span>
                View registered SwiftTrack users.
            </span>

        </a>


        <!-- ACTIVITY LOGS -->

        <a
            href="{{ route('admin.logs') }}"
            class="quick-card"
        >

            <div>
                📋
            </div>

            <strong>
                Activity Logs
            </strong>

            <span>
                Monitor important system activities.
            </span>

        </a>

    </div>

</div>

@endsection