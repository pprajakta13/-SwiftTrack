@extends('user.layout')
@section('title','Track '.$parcel->tracking_number.' | SwiftTrack')
@section('page-heading','Track Parcel')
@section('content')
<div class="max-w-6xl"><div class="rounded-3xl bg-slate-950 text-white p-7 mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-5"><div><p class="text-slate-400 text-sm">Tracking Number</p><h2 class="text-3xl font-black mt-1 tracking-wide">{{ $parcel->tracking_number }}</h2><p class="text-slate-400 mt-2">Estimated delivery: {{ $parcel->estimated_delivery_date->format('d M Y') }}</p></div><div class="text-left md:text-right"><p class="text-slate-400 text-sm">Current Status</p><span class="inline-block mt-2 px-4 py-2 rounded-full bg-blue-500 text-white font-bold">{{ $parcel->current_status }}</span></div></div>
<div class="grid lg:grid-cols-3 gap-6"><div class="lg:col-span-2 bg-white rounded-2xl border p-6"><h3 class="text-xl font-black mb-6">Shipment Timeline</h3><div class="space-y-6">@forelse($history as $item)<div class="flex gap-4"><div class="flex flex-col items-center"><div class="w-4 h-4 rounded-full bg-blue-600 ring-4 ring-blue-100"></div>@if(!$loop->last)<div class="w-0.5 h-full min-h-10 bg-blue-100 mt-1"></div>@endif</div><div class="pb-4"><div class="flex flex-wrap items-center gap-2"><h4 class="font-black">{{ $item->status }}</h4><span class="text-xs text-slate-400">{{ optional($item->created_at)->format('d M Y, h:i A') }}</span></div><p class="text-sm text-blue-600 mt-1">📍 {{ $item->location ?: '—' }}</p><p class="text-sm text-slate-500 mt-1">{{ $item->remarks ?: 'Status updated.' }}</p></div></div>@empty<p class="text-slate-500">No tracking updates yet.</p>@endforelse</div></div>
<div class="space-y-6"><div class="bg-white rounded-2xl border p-6"><h3 class="font-black text-lg mb-4">Shipment Details</h3><div class="space-y-4 text-sm"><div><p class="text-slate-400">Parcel Type</p><p class="font-semibold">{{ $parcel->parcel_type }}</p></div><div><p class="text-slate-400">Weight</p><p class="font-semibold">{{ number_format($parcel->weight,2) }} kg</p></div><div><p class="text-slate-400">Sender</p><p class="font-semibold">{{ $parcel->sender_name }}</p><p class="text-slate-500">{{ $parcel->sender_address }}</p></div><div><p class="text-slate-400">Receiver</p><p class="font-semibold">{{ $parcel->receiver_name }}</p><p class="text-slate-500">{{ $parcel->receiver_address }}</p></div></div></div><a href="{{ route('user.parcels') }}" class="block text-center bg-white border rounded-xl py-3 font-bold">← Back to My Parcels</a></div></div></div>
@endsection
@extends('user.layout')

@section('title', 'Track Parcel | SwiftTrack')

@section('page-title', 'Track Parcel')

@section('content')

<style>
    .tracking-header {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        color: white;
        border-radius: 18px;
        padding: 30px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .tracking-label {
        color: #bfdbfe;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 7px;
    }

    .tracking-number {
        font-size: 29px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .current-status {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 15px 20px;
        border-radius: 12px;
        text-align: center;
    }

    .current-status small {
        display: block;
        color: #bfdbfe;
        margin-bottom: 5px;
    }

    .current-status strong {
        font-size: 18px;
    }

    .back-btn {
        display: inline-block;
        color: #2563eb;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 25px;
    }

    .card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 25px;
    }

    .card h2 {
        color: #0f172a;
        font-size: 19px;
        margin-bottom: 20px;
    }

    .info-row {
        margin-bottom: 16px;
    }

    .info-row:last-child {
        margin-bottom: 0;
    }

    .info-label {
        color: #64748b;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .info-value {
        color: #1e293b;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.5;
    }

    .timeline-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 28px;
    }

    .timeline-card h2 {
        color: #0f172a;
        font-size: 20px;
        margin-bottom: 25px;
    }

    .timeline {
        position: relative;
        margin-left: 10px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 9px;
        top: 5px;
        bottom: 5px;
        width: 2px;
        background: #dbeafe;
    }

    .timeline-item {
        position: relative;
        padding-left: 40px;
        padding-bottom: 28px;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-dot {
        position: absolute;
        left: 0;
        top: 2px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #2563eb;
        border: 4px solid #dbeafe;
        z-index: 1;
    }

    .timeline-item:first-child .timeline-dot {
        background: #16a34a;
        border-color: #dcfce7;
    }

    .timeline-status {
        color: #0f172a;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 5px;
    }

    .timeline-date {
        color: #64748b;
        font-size: 12px;
        margin-bottom: 8px;
    }

    .timeline-location {
        color: #2563eb;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .timeline-remarks {
        color: #475569;
        font-size: 13px;
        line-height: 1.5;
    }

    .delivery-box {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 17px;
        margin-bottom: 20px;
        color: #166534;
    }

    .delivery-box strong {
        display: block;
        margin-bottom: 5px;
    }

    @media (max-width: 750px) {

        .tracking-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .tracking-number {
            font-size: 23px;
        }
    }
</style>


<a
    href="{{ route('user.parcels') }}"
    class="back-btn"
>
    ← Back to My Parcels
</a>


<!-- TRACKING HEADER -->

<div class="tracking-header">

    <div>

        <div class="tracking-label">
            Tracking Number
        </div>

        <div class="tracking-number">
            {{ $parcel->tracking_number }}
        </div>

    </div>

    <div class="current-status">

        <small>
            Current Status
        </small>

        <strong>
            {{ $parcel->current_status }}
        </strong>

    </div>

</div>


<!-- DELIVERY INFORMATION -->

<div class="delivery-box">

    <strong>
        📅 Estimated Delivery
    </strong>

    Your parcel is expected to be delivered by
    <strong>
        {{ $parcel->estimated_delivery_date->format('d M Y') }}
    </strong>

</div>


<!-- SENDER / RECEIVER -->

<div class="details-grid">

    <div class="card">

        <h2>
            📤 Sender Details
        </h2>

        <div class="info-row">

            <div class="info-label">
                Name
            </div>

            <div class="info-value">
                {{ $parcel->sender_name }}
            </div>

        </div>

        <div class="info-row">

            <div class="info-label">
                Phone
            </div>

            <div class="info-value">
                {{ $parcel->sender_phone }}
            </div>

        </div>

        <div class="info-row">

            <div class="info-label">
                Address
            </div>

            <div class="info-value">
                {{ $parcel->sender_address }}
            </div>

        </div>

    </div>


    <div class="card">

        <h2>
            📥 Receiver Details
        </h2>

        <div class="info-row">

            <div class="info-label">
                Name
            </div>

            <div class="info-value">
                {{ $parcel->receiver_name }}
            </div>

        </div>

        <div class="info-row">

            <div class="info-label">
                Phone
            </div>

            <div class="info-value">
                {{ $parcel->receiver_phone }}
            </div>

        </div>

        <div class="info-row">

            <div class="info-label">
                Address
            </div>

            <div class="info-value">
                {{ $parcel->receiver_address }}
            </div>

        </div>

    </div>

</div>


<!-- PARCEL INFORMATION -->

<div class="card" style="margin-bottom: 25px;">

    <h2>
        📦 Parcel Information
    </h2>

    <div class="details-grid" style="margin-bottom: 0;">

        <div class="info-row">

            <div class="info-label">
                Parcel Type
            </div>

            <div class="info-value">
                {{ $parcel->parcel_type }}
            </div>

        </div>

        <div class="info-row">

            <div class="info-label">
                Weight
            </div>

            <div class="info-value">
                {{ number_format($parcel->weight, 2) }} kg
            </div>

        </div>

    </div>

</div>


<!-- STATUS TIMELINE -->

<div class="timeline-card">

    <h2>
        📍 Parcel Tracking History
    </h2>

    <div class="timeline">

        @forelse($history as $item)

            <div class="timeline-item">

                <div class="timeline-dot"></div>

                <div class="timeline-status">
                    {{ $item->status }}
                </div>

                <div class="timeline-date">

                    {{ $item->created_at
                        ? $item->created_at->format('d M Y, h:i A')
                        : 'Date unavailable'
                    }}

                </div>

                @if($item->location)

                    <div class="timeline-location">
                        📍 {{ $item->location }}
                    </div>

                @endif

                @if($item->remarks)

                    <div class="timeline-remarks">
                        {{ $item->remarks }}
                    </div>

                @endif

            </div>

        @empty

            <p style="color:#64748b;">
                No tracking history available yet.
            </p>

        @endforelse

    </div>

</div>

@endsection