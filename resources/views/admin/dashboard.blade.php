@extends('admin.layout')
@section('title','Admin Dashboard | SwiftTrack')
@section('page-heading','Dashboard')
@section('content')
<div class="mb-7"><h2 class="text-3xl font-black">Welcome back, {{ auth()->user()->name }} 👋</h2><p class="text-slate-500 mt-1">Here's what's happening with SwiftTrack.</p></div>
<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-7"><div class="bg-white rounded-2xl border p-6"><p class="text-sm text-slate-500">Total Parcels</p><p class="text-3xl font-black mt-2">{{ $totalParcels }}</p></div><div class="bg-white rounded-2xl border p-6"><p class="text-sm text-slate-500">In Transit</p><p class="text-3xl font-black mt-2">{{ $inTransit }}</p></div><div class="bg-white rounded-2xl border p-6"><p class="text-sm text-slate-500">Delivered</p><p class="text-3xl font-black mt-2">{{ $delivered }}</p></div><div class="bg-white rounded-2xl border p-6"><p class="text-sm text-slate-500">Registered Users</p><p class="text-3xl font-black mt-2">{{ $totalUsers }}</p></div></div>
<div class="bg-white rounded-2xl border overflow-hidden"><div class="p-6 flex justify-between"><div><h3 class="text-xl font-black">Recent Parcels</h3><p class="text-sm text-slate-500">Latest shipment activity.</p></div><a href="{{ route('admin.parcels') }}" class="text-blue-600 font-bold">Manage →</a></div>@if($recentParcels->count())<div class="overflow-x-auto"><table class="w-full text-sm"><thead class="bg-slate-50"><tr><th class="text-left px-6 py-3">Tracking</th><th class="text-left px-6 py-3">Customer</th><th class="text-left px-6 py-3">Receiver</th><th class="text-left px-6 py-3">Status</th></tr></thead><tbody>@foreach($recentParcels as $parcel)<tr class="border-t"><td class="px-6 py-4 font-bold">{{ $parcel->tracking_number }}</td><td class="px-6 py-4">{{ $parcel->user?->name ?? '—' }}</td><td class="px-6 py-4">{{ $parcel->receiver_name }}</td><td class="px-6 py-4"><span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">{{ $parcel->current_status }}</span></td></tr>@endforeach</tbody></table></div>@else<div class="p-10 text-center text-slate-500">No parcels have been booked yet.</div>@endif</div>
@endsection
@extends('admin.layout')

@section('title', 'Admin Dashboard | SwiftTrack')

@section('page-title', 'Dashboard')

@section('content')

<style>

    .welcome {
        background:
            linear-gradient(
                135deg,
                #0f172a,
                #2563eb
            );

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
        grid-template-columns:
            repeat(4, 1fr);

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
        grid-template-columns:
            repeat(3, 1fr);

        gap: 15px;
    }

    .quick-card {
        text-decoration: none;

        border: 1px solid #e2e8f0;

        padding: 20px;

        border-radius: 12px;

        color: #0f172a;

        transition: .2s;
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

    @media(max-width:900px) {

        .stats {
            grid-template-columns:
                repeat(2, 1fr);
        }

        .quick-grid {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width:550px) {

        .stats {
            grid-template-columns: 1fr;
        }
    }

</style>


<div class="welcome">

    <h1>
        Welcome to SwiftTrack Admin 👋
    </h1>

    <p>
        Manage parcels, users and courier activities from one place.
    </p>

</div>


<div class="stats">

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


    <div class="stat">

        <div class="stat-icon">
            🚚
        </div>

        <h3>
            {{ $inTransit ?? 0 }}
        </h3>

        <p>
            Parcels In Transit
        </p>

    </div>


    <div class="stat">

        <div class="stat-icon">
            ✅
        </div>

        <h3>
            {{ $delivered ?? 0 }}
        </h3>

        <p>
            Delivered Parcels
        </p>

    </div>


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


<div class="quick">

    <h2>
        Quick Management
    </h2>


    <div class="quick-grid">

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