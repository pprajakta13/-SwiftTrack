@extends('user.layout')

@section('title', 'Dashboard | SwiftTrack')

@section('page-title', 'Dashboard')

@section('content')

<style>
    .welcome {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        color: white;
        border-radius: 18px;
        padding: 30px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .welcome h1 {
        font-size: 28px;
        margin-bottom: 8px;
    }

    .welcome p {
        color: #dbeafe;
        font-size: 15px;
    }

    .welcome-icon {
        font-size: 65px;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 22px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 17px;
    }

    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        background: #dbeafe;
    }

    .stat-card h3 {
        font-size: 28px;
        color: #0f172a;
        margin-bottom: 3px;
    }

    .stat-card p {
        color: #64748b;
        font-size: 14px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .section-header h2 {
        font-size: 21px;
        color: #0f172a;
    }

    .view-all {
        text-decoration: none;
        color: #2563eb;
        font-weight: bold;
        font-size: 14px;
    }

    .table-card {
        background: white;
        border-radius: 15px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #f8fafc;
        color: #64748b;
        font-size: 13px;
        text-align: left;
        padding: 15px 18px;
    }

    td {
        padding: 16px 18px;
        border-top: 1px solid #e2e8f0;
        font-size: 14px;
    }

    .tracking {
        color: #2563eb;
        font-weight: bold;
        text-decoration: none;
    }

    .status {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        background: #dbeafe;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: bold;
    }

    .empty {
        padding: 45px 20px;
        text-align: center;
        color: #64748b;
    }

    .empty-icon {
        font-size: 45px;
        margin-bottom: 10px;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
        margin-top: 30px;
    }

    .action {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 22px;
        text-decoration: none;
        color: #0f172a;
        transition: 0.2s;
    }

    .action:hover {
        border-color: #2563eb;
        transform: translateY(-2px);
    }

    .action-icon {
        font-size: 30px;
        margin-bottom: 10px;
    }

    .action h3 {
        margin-bottom: 5px;
        font-size: 17px;
    }

    .action p {
        color: #64748b;
        font-size: 13px;
    }

    @media (max-width: 900px) {
        .stats {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .welcome {
            padding: 22px;
        }

        .welcome h1 {
            font-size: 23px;
        }

        .welcome-icon {
            display: none;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }

        .table-card {
            overflow-x: auto;
        }

        table {
            min-width: 650px;
        }
    }
</style>


<!-- WELCOME SECTION -->

<div class="welcome">

    <div>

        <h1>
            Welcome back, {{ auth()->user()->name }}! 👋
        </h1>

        <p>
            Manage and track all your courier parcels from one place.
        </p>

    </div>

    <div class="welcome-icon">
        🚚
    </div>

</div>


<!-- STATISTICS -->

<div class="stats">

    <div class="stat-card">

        <div class="stat-icon">
            📦
        </div>

        <div>

            <h3>
                {{ $totalParcels }}
            </h3>

            <p>
                Total Parcels
            </p>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">
            🚚
        </div>

        <div>

            <h3>
                {{ $inTransit }}
            </h3>

            <p>
                In Transit
            </p>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">
            ✅
        </div>

        <div>

            <h3>
                {{ $delivered }}
            </h3>

            <p>
                Delivered
            </p>

        </div>

    </div>

</div>


<!-- RECENT PARCELS -->

<div class="section-header">

    <h2>
        Recent Parcels
    </h2>

    <a
        href="{{ route('user.parcels') }}"
        class="view-all"
    >
        View All →
    </a>

</div>


<div class="table-card">

    @if($recentParcels->count() > 0)

        <table>

            <thead>

                <tr>

                    <th>
                        Tracking Number
                    </th>

                    <th>
                        Receiver
                    </th>

                    <th>
                        Type
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Delivery Date
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($recentParcels as $parcel)

                    <tr>

                        <td>

                            <a
                                href="{{ route('user.parcels.show', $parcel->tracking_number) }}"
                                class="tracking"
                            >
                                {{ $parcel->tracking_number }}
                            </a>

                        </td>

                        <td>
                            {{ $parcel->receiver_name }}
                        </td>

                        <td>
                            {{ $parcel->parcel_type }}
                        </td>

                        <td>

                            <span class="status">
                                {{ $parcel->current_status }}
                            </span>

                        </td>

                        <td>
                            {{ $parcel->estimated_delivery_date->format('d M Y') }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="empty">

            <div class="empty-icon">
                📦
            </div>

            <h3>
                No parcels yet
            </h3>

            <p>
                You haven't booked any parcels yet.
            </p>

        </div>

    @endif

</div>


<!-- QUICK ACTIONS -->

<div class="section-header" style="margin-top: 30px;">

    <h2>
        Quick Actions
    </h2>

</div>


<div class="quick-actions">

    <a
        href="{{ route('user.parcels.create') }}"
        class="action"
    >

        <div class="action-icon">
            📦
        </div>

        <h3>
            Book New Parcel
        </h3>

        <p>
            Create a new courier booking and get a tracking number.
        </p>

    </a>


    <a
        href="{{ route('user.parcels') }}"
        class="action"
    >

        <div class="action-icon">
            🔍
        </div>

        <h3>
            Track My Parcels
        </h3>

        <p>
            View your parcels and check their latest status.
        </p>

    </a>

</div>

@endsection