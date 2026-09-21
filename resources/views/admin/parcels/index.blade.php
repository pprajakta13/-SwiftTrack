@extends('admin.layout')
@section('title','Manage Parcels | SwiftTrack')
@section('page-heading','Parcel Management')
@section('content')
<div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 mb-6"><div><h2 class="text-2xl font-black">All Parcels</h2><p class="text-slate-500">Search parcels and update their live status.</p></div><form method="GET" class="flex flex-col sm:flex-row gap-2"><input name="search" value="{{ request('search') }}" placeholder="Tracking / sender / receiver" class="rounded-xl border px-4 py-3 bg-white"><select name="status" class="rounded-xl border px-4 py-3 bg-white"><option value="">All statuses</option>@foreach($statuses as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ $status }}</option>@endforeach</select><button class="rounded-xl bg-slate-900 text-white px-5 py-3 font-bold">Filter</button></form></div>
<div class="space-y-4">@forelse($parcels as $parcel)<div class="bg-white rounded-2xl border p-5"><div class="flex flex-col xl:flex-row xl:items-center gap-5 justify-between"><div class="min-w-0"><p class="text-xs text-slate-400">Tracking Number</p><p class="font-black text-lg">{{ $parcel->tracking_number }}</p><p class="text-sm text-slate-500 mt-1">{{ $parcel->user?->name ?? 'Unknown user' }} → {{ $parcel->receiver_name }} · {{ $parcel->parcel_type }} · {{ number_format($parcel->weight,2) }} kg</p><p class="text-xs text-slate-400 mt-1">Created {{ $parcel->created_at->format('d M Y, h:i A') }}</p></div><form method="POST" action="{{ route('admin.parcels.update',$parcel) }}" class="grid sm:grid-cols-3 gap-2 w-full xl:max-w-3xl">@csrf @method('PATCH')<select name="status" required class="rounded-xl border px-3 py-3">@foreach($statuses as $status)<option value="{{ $status }}" @selected($parcel->current_status===$status)>{{ $status }}</option>@endforeach</select><input name="location" placeholder="Current location" class="rounded-xl border px-3 py-3"><input name="remarks" placeholder="Remarks" class="rounded-xl border px-3 py-3"><button class="sm:col-span-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white py-3 font-bold">Update Status</button></form></div></div>@empty<div class="bg-white rounded-2xl border p-12 text-center text-slate-500">No parcels match your search.</div>@endforelse</div><div class="mt-6">{{ $parcels->links() }}</div>
@endsection
@extends('admin.layout')

@section('title', 'Manage Parcels | SwiftTrack')

@section('page-title', 'Manage Parcels')

@section('content')

<style>

    .heading {
        margin-bottom: 22px;
    }

    .heading h1 {
        color: #0f172a;
        font-size: 25px;
        margin-bottom: 5px;
    }

    .heading p {
        color: #64748b;
        font-size: 14px;
    }

    .table-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        overflow: hidden;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    th {
        background: #f8fafc;
        color: #64748b;
        text-align: left;
        padding: 14px;
        font-size: 12px;
    }

    td {
        padding: 15px 14px;
        border-top: 1px solid #e2e8f0;
        font-size: 13px;
    }

    .tracking {
        color: #2563eb;
        font-weight: bold;
    }

    .status {
        padding: 6px 10px;
        border-radius: 20px;
        background: #dbeafe;
        color: #1d4ed8;
        font-size: 11px;
        font-weight: bold;
    }

    .empty {
        text-align: center;
        padding: 60px;
        color: #64748b;
    }

</style>


<div class="heading">

    <h1>
        📦 All Parcels
    </h1>

    <p>
        View all courier bookings registered in SwiftTrack.
    </p>

</div>


<div class="table-card">

    @if(isset($parcels) && $parcels->count())

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Tracking Number
                        </th>

                        <th>
                            Customer
                        </th>

                        <th>
                            Receiver
                        </th>

                        <th>
                            Type
                        </th>

                        <th>
                            Weight
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Delivery
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($parcels as $parcel)

                        <tr>

                            <td class="tracking">
                                {{ $parcel->tracking_number }}
                            </td>

                            <td>
                                {{ $parcel->user->name ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $parcel->receiver_name }}
                            </td>

                            <td>
                                {{ $parcel->parcel_type }}
                            </td>

                            <td>
                                {{ number_format($parcel->weight, 2) }} kg
                            </td>

                            <td>

                                <span class="status">
                                    {{ $parcel->current_status }}
                                </span>

                            </td>

                            <td>
                                {{ $parcel->estimated_delivery_date?->format('d M Y') ?? 'N/A' }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="empty">

            📦

            <h3>
                No parcels available
            </h3>

            <p>
                Parcel bookings will appear here.
            </p>

        </div>

    @endif

</div>

@endsection