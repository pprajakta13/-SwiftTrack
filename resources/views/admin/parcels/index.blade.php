@extends('admin.layout')

@section('title', 'Manage Parcels | SwiftTrack')

@section('page-heading', 'Parcel Management')

@section('content')

<style>

    .page-header {
        margin-bottom: 25px;
    }

    .page-header h2 {
        font-size: 28px;
        font-weight: 900;
        color: #0f172a;
        margin-bottom: 5px;
    }

    .page-header p {
        color: #64748b;
        font-size: 14px;
    }


    .filter-card,
    .parcel-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
    }


    .filter-card {
        padding: 20px;
        margin-bottom: 22px;
    }


    .filter-form {
        display: grid;
        grid-template-columns: 1fr 220px 120px;
        gap: 12px;
    }


    .input {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        background: white;
        outline: none;
    }


    .input:focus {
        border-color: #2563eb;
    }


    .filter-btn,
    .update-btn {
        border: none;
        border-radius: 10px;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }


    .filter-btn {
        background: #0f172a;
    }


    .update-btn {
        background: #2563eb;
        padding: 13px;
        width: 100%;
        margin-top: 5px;
    }


    .update-btn:hover {
        background: #1d4ed8;
    }


    .parcel-card {
        padding: 24px;
        margin-bottom: 18px;
    }


    .parcel-top {
        display: flex;
        justify-content: space-between;
        gap: 25px;
        margin-bottom: 22px;
    }


    .label {
        color: #94a3b8;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 5px;
    }


    .tracking {
        color: #2563eb;
        font-size: 20px;
        font-weight: 900;
    }


    .parcel-info {
        color: #64748b;
        font-size: 13px;
        margin-top: 7px;
    }


    .status-box {
        text-align: right;
    }


    .status {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 800;
    }


    .sender-section {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 18px;
    }


    .sender-section h3 {
        margin: 0 0 5px;
        font-size: 17px;
        font-weight: 900;
        color: #0f172a;
    }


    .sender-section p {
        margin: 0 0 15px;
        font-size: 13px;
        color: #64748b;
    }


    .sender-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }


    .full {
        grid-column: 1 / -1;
    }


    .update-section {
        border-top: 1px solid #e2e8f0;
        padding-top: 20px;
    }


    .update-title {
        font-size: 16px;
        font-weight: 900;
        margin-bottom: 12px;
    }


    .update-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 12px;
    }


    .empty {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 60px 20px;
        text-align: center;
        color: #64748b;
    }


    .pagination {
        margin-top: 25px;
    }


    @media(max-width: 900px) {

        .filter-form,
        .sender-grid,
        .update-grid {
            grid-template-columns: 1fr;
        }

        .full {
            grid-column: auto;
        }

        .parcel-top {
            flex-direction: column;
        }

        .status-box {
            text-align: left;
        }

    }

</style>


<!-- HEADER -->

<div class="page-header">

    <h2>
        📦 All Parcels
    </h2>

    <p>
        Manage sender details and update live parcel tracking.
    </p>

</div>


<!-- FILTER -->

<div class="filter-card">

    <form
        method="GET"
        action="{{ route('admin.parcels') }}"
        class="filter-form"
    >

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search tracking number, sender or receiver"
            class="input"
        >


        <select
            name="status"
            class="input"
        >

            <option value="">
                All Statuses
            </option>

            @foreach($statuses as $status)

                <option
                    value="{{ $status }}"
                    @selected(request('status') === $status)
                >
                    {{ $status }}
                </option>

            @endforeach

        </select>


        <button
            type="submit"
            class="filter-btn"
        >
            🔍 Filter
        </button>

    </form>

</div>


<!-- PARCELS -->

@if($parcels->count())


    @foreach($parcels as $parcel)

        <div class="parcel-card">


            <!-- BASIC INFORMATION -->

            <div class="parcel-top">

                <div>

                    <div class="label">
                        Tracking Number
                    </div>

                    <div class="tracking">
                        {{ $parcel->tracking_number }}
                    </div>

                    <div class="parcel-info">

                        Customer:
                        <strong>
                            {{ $parcel->user?->name ?? 'Unknown User' }}
                        </strong>

                    </div>

                    <div class="parcel-info">

                        Receiver:
                        {{ $parcel->receiver_name }}

                        ·

                        {{ $parcel->receiver_phone }}

                    </div>

                    <div class="parcel-info">

                        Type:
                        {{ $parcel->parcel_type }}

                        ·

                        Weight:
                        {{ number_format($parcel->weight, 2) }} kg

                    </div>

                </div>


                <div class="status-box">

                    <div class="label">
                        Current Status
                    </div>

                    <span class="status">
                        {{ $parcel->current_status }}
                    </span>

                </div>

            </div>


            <!-- UPDATE FORM -->

            <form
                method="POST"
                action="{{ route('admin.parcels.update', $parcel) }}"
            >

                @csrf

                @method('PATCH')


                <!-- SENDER -->

                <div class="sender-section">

                    <h3>
                        📤 Sender Details
                    </h3>

                    <p>
                        Admin enters or updates the sender and pickup information.
                    </p>


                    <div class="sender-grid">

                        <div>

                            <label>
                                Sender Name
                            </label>

                            <input
                                type="text"
                                name="sender_name"
                                class="input"
                                value="{{ old('sender_name', $parcel->sender_name) }}"
                                placeholder="Enter sender name"
                            >

                        </div>


                        <div>

                            <label>
                                Sender Phone
                            </label>

                            <input
                                type="text"
                                name="sender_phone"
                                class="input"
                                value="{{ old('sender_phone', $parcel->sender_phone) }}"
                                placeholder="Enter sender phone"
                            >

                        </div>


                        <div class="full">

                            <label>
                                Pickup Address
                            </label>

                            <textarea
                                name="sender_address"
                                class="input"
                                rows="3"
                                placeholder="Enter complete pickup address"
                            >{{ old('sender_address', $parcel->sender_address) }}</textarea>

                        </div>

                    </div>

                </div>


                <!-- TRACKING UPDATE -->

                <div class="update-section">

                    <div class="update-title">
                        📍 Delivery Tracking Update
                    </div>


                    <div class="update-grid">

                        <div>

                            <label>
                                Status
                            </label>

                            <select
                                name="status"
                                class="input"
                                required
                            >

                                @foreach($statuses as $status)

                                    <option
                                        value="{{ $status }}"
                                        @selected(
                                            $parcel->current_status === $status
                                        )
                                    >
                                        {{ $status }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div>

                            <label>
                                Current Location
                            </label>

                            <input
                                type="text"
                                name="location"
                                class="input"
                                placeholder="e.g. Nashik Hub"
                            >

                        </div>


                        <div>

                            <label>
                                Remarks
                            </label>

                            <input
                                type="text"
                                name="remarks"
                                class="input"
                                placeholder="e.g. Parcel reached hub"
                            >

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="update-btn"
                    >
                        🚚 Save Parcel & Tracking Update
                    </button>

                </div>

            </form>

        </div>

    @endforeach


    <div class="pagination">

        {{ $parcels->links() }}

    </div>


@else

    <div class="empty">

        <div style="font-size:45px;">
            📦
        </div>

        <h3>
            No Parcels Found
        </h3>

        <p>
            No parcels match your current search or filter.
        </p>

    </div>

@endif


@endsection