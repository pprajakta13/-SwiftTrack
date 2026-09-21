@extends('user.layout')

@section('title', 'My Parcels | SwiftTrack')

@section('page-title', 'My Parcels')

@section('content')

<style>
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
        gap: 15px;
    }

    .page-header h1 {
        font-size: 27px;
        color: #0f172a;
        margin-bottom: 5px;
    }

    .page-header p {
        color: #64748b;
        font-size: 14px;
    }

    .book-btn {
        background: #2563eb;
        color: white;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 9px;
        font-weight: bold;
        font-size: 14px;
    }

    .book-btn:hover {
        background: #1d4ed8;
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
        min-width: 850px;
    }

    th {
        background: #f8fafc;
        color: #64748b;
        text-align: left;
        padding: 15px 18px;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    td {
        padding: 17px 18px;
        border-top: 1px solid #e2e8f0;
        font-size: 14px;
        color: #334155;
    }

    .tracking {
        color: #2563eb;
        font-weight: bold;
        text-decoration: none;
    }

    .tracking:hover {
        text-decoration: underline;
    }

    .status {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .booked {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .transit {
        background: #fef3c7;
        color: #92400e;
    }

    .delivered {
        background: #dcfce7;
        color: #166534;
    }

    .cancelled {
        background: #fee2e2;
        color: #991b1b;
    }

    .view-btn {
        display: inline-block;
        background: #eff6ff;
        color: #2563eb;
        text-decoration: none;
        padding: 7px 12px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: bold;
    }

    .view-btn:hover {
        background: #dbeafe;
    }

    .empty {
        text-align: center;
        padding: 70px 20px;
    }

    .empty-icon {
        font-size: 55px;
        margin-bottom: 15px;
    }

    .empty h2 {
        color: #0f172a;
        margin-bottom: 8px;
    }

    .empty p {
        color: #64748b;
        margin-bottom: 20px;
    }

    .empty a {
        display: inline-block;
        background: #2563eb;
        color: white;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 9px;
        font-weight: bold;
    }

    @media (max-width: 650px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>


<div class="page-header">

    <div>
        <h1>My Parcels 📦</h1>

        <p>
            View and track all your courier parcels.
        </p>
    </div>

    <a
        href="{{ route('user.parcels.create') }}"
        class="book-btn"
    >
        + Book New Parcel
    </a>

</div>


<div class="table-card">

    @if($parcels->count() > 0)

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>Tracking Number</th>

                        <th>Receiver</th>

                        <th>Type</th>

                        <th>Weight</th>

                        <th>Status</th>

                        <th>Delivery Date</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($parcels as $parcel)

                        @php

                            $statusClass = 'booked';

                            if (in_array($parcel->current_status, [
                                'Picked Up',
                                'In Transit',
                                'At Hub',
                                'Out for Delivery'
                            ])) {
                                $statusClass = 'transit';
                            }

                            if ($parcel->current_status === 'Delivered') {
                                $statusClass = 'delivered';
                            }

                            if ($parcel->current_status === 'Cancelled') {
                                $statusClass = 'cancelled';
                            }

                        @endphp

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
                                {{ number_format($parcel->weight, 2) }} kg
                            </td>

                            <td>

                                <span class="status {{ $statusClass }}">
                                    {{ $parcel->current_status }}
                                </span>

                            </td>

                            <td>
                                {{ $parcel->estimated_delivery_date->format('d M Y') }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('user.parcels.show', $parcel->tracking_number) }}"
                                    class="view-btn"
                                >
                                    Track →
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="empty">

            <div class="empty-icon">
                📦
            </div>

            <h2>
                No Parcels Found
            </h2>

            <p>
                You haven't booked any parcels yet.
            </p>

            <a href="{{ route('user.parcels.create') }}">
                Book Your First Parcel
            </a>

        </div>

    @endif

</div>

@endsection