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

    .back-btn:hover {
        text-decoration: underline;
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

    .empty-value {
        color: #94a3b8;
        font-style: italic;
        font-weight: normal;
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


{{-- BACK BUTTON --}}

<a
    href="{{ route('user.parcels') }}"
    class="back-btn"
>
    ← Back to My Parcels
</a>


{{-- TRACKING HEADER --}}

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


{{-- DELIVERY INFORMATION --}}

<div class="delivery-box">

    <strong>
        📅 Estimated Delivery
    </strong>

    Your parcel is expected to be delivered by

    <strong>
        {{ $parcel->estimated_delivery_date
            ? \Carbon\Carbon::parse($parcel->estimated_delivery_date)->format('d M Y')
            : 'Not set'
        }}
    </strong>

</div>


{{-- SENDER + RECEIVER --}}

<div class="details-grid">


    {{-- SENDER --}}

    <div class="card">

        <h2>
            📤 Sender Details
        </h2>

        <div class="info-row">

            <div class="info-label">
                Name
            </div>

            <div class="info-value">

                @if($parcel->sender_name)
                    {{ $parcel->sender_name }}
                @else
                    <span class="empty-value">
                        Not added by admin yet
                    </span>
                @endif

            </div>

        </div>


        <div class="info-row">

            <div class="info-label">
                Phone
            </div>

            <div class="info-value">

                @if($parcel->sender_phone)
                    {{ $parcel->sender_phone }}
                @else
                    <span class="empty-value">
                        Not added yet
                    </span>
                @endif

            </div>

        </div>


        <div class="info-row">

            <div class="info-label">
                Pickup / Sender Address
            </div>

            <div class="info-value">

                @if($parcel->sender_address)
                    {{ $parcel->sender_address }}
                @else
                    <span class="empty-value">
                        Not added by admin yet
                    </span>
                @endif

            </div>

        </div>

    </div>


    {{-- RECEIVER --}}

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


{{-- PARCEL INFORMATION --}}

<div
    class="card"
    style="margin-bottom: 25px;"
>

    <h2>
        📦 Parcel Information
    </h2>

    <div
        class="details-grid"
        style="margin-bottom: 0;"
    >

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


{{-- STATUS TIMELINE --}}

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

                @else

                    <div class="timeline-remarks">
                        Status updated.
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