@extends('user.layout')

@section('title', 'Book New Parcel | SwiftTrack')

@section('page-title', 'Book New Parcel')

@section('content')

<style>

    /* ==============================
       PAGE
    ============================== */

    .booking-page {
        max-width: 1000px;
        margin: 0 auto;
        padding: 10px 0 40px;
    }


    /* ==============================
       PAGE HEADER
    ============================== */

    .booking-header {
        margin-bottom: 25px;
    }

    .booking-header h1 {
        margin: 0 0 8px;
        font-size: 30px;
        font-weight: 800;
        color: #0f172a;
    }

    .booking-header p {
        margin: 0;
        color: #64748b;
        font-size: 15px;
    }


    /* ==============================
       MAIN CARD
    ============================== */

    .booking-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
    }


    /* ==============================
       CARD HEADER
    ============================== */

    .card-header {
        background: linear-gradient(
            135deg,
            #eff6ff,
            #f8fafc
        );

        padding: 24px 28px;
        border-bottom: 1px solid #e2e8f0;
    }

    .card-header-content {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .header-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        background: #2563eb;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.25);
    }

    .card-header h2 {
        margin: 0 0 4px;
        font-size: 19px;
        font-weight: 800;
        color: #0f172a;
    }

    .card-header p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }


    /* ==============================
       FORM
    ============================== */

    .booking-form {
        padding: 30px;
    }


    /* ==============================
       SECTION
    ============================== */

    .form-section {
        margin-bottom: 30px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e2e8f0;
    }

    .section-title span {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .section-title h3 {
        margin: 0;
        color: #0f172a;
        font-size: 16px;
        font-weight: 800;
    }


    /* ==============================
       FORM GRID
    ============================== */

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }


    /* ==============================
       LABEL
    ============================== */

    .form-label {
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .required {
        color: #ef4444;
        margin-left: 2px;
    }


    /* ==============================
       INPUTS
    ============================== */

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        box-sizing: border-box;

        border: 1px solid #cbd5e1;
        background: #ffffff;

        color: #0f172a;

        border-radius: 10px;

        padding: 12px 14px;

        font-size: 14px;

        outline: none;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;
    }

    .form-input,
    .form-select {
        height: 46px;
    }

    .form-textarea {
        min-height: 110px;
        resize: vertical;
        font-family: inherit;
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: #94a3b8;
    }

    .form-input:hover,
    .form-select:hover,
    .form-textarea:hover {
        border-color: #94a3b8;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #2563eb;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }


    /* ==============================
       HELP TEXT
    ============================== */

    .help-text {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 6px;
    }


    /* ==============================
       ERROR
    ============================== */

    .input-error {
        border-color: #ef4444 !important;
    }

    .error-message {
        color: #dc2626;
        font-size: 12px;
        margin-top: 6px;
    }


    /* ==============================
       INFO BOX
    ============================== */

    .info-box {
        display: flex;
        align-items: flex-start;
        gap: 12px;

        background: #eff6ff;
        border: 1px solid #bfdbfe;

        border-radius: 12px;

        padding: 15px 17px;

        margin-bottom: 25px;
    }

    .info-icon {
        font-size: 20px;
        line-height: 1;
    }

    .info-box strong {
        display: block;
        color: #1e40af;
        font-size: 13px;
        margin-bottom: 3px;
    }

    .info-box p {
        margin: 0;
        color: #475569;
        font-size: 12px;
        line-height: 1.5;
    }


    /* ==============================
       BUTTON AREA
    ============================== */

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;

        padding-top: 25px;
        margin-top: 5px;

        border-top: 1px solid #e2e8f0;
    }

    .cancel-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 12px 20px;

        border-radius: 10px;

        background: #f8fafc;
        border: 1px solid #cbd5e1;

        color: #475569;

        text-decoration: none;

        font-size: 14px;
        font-weight: 700;

        transition: 0.2s;
    }

    .cancel-btn:hover {
        background: #f1f5f9;
        color: #0f172a;
    }

    .submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        border: none;

        padding: 12px 22px;

        border-radius: 10px;

        background: #2563eb;
        color: white;

        font-size: 14px;
        font-weight: 700;

        cursor: pointer;

        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.22);

        transition: 0.2s;
    }

    .submit-btn:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 7px 18px rgba(37, 99, 235, 0.28);
    }

    .submit-btn:active {
        transform: translateY(0);
    }


    /* ==============================
       RESPONSIVE
    ============================== */

    @media (max-width: 750px) {

        .booking-page {
            padding: 5px 0 30px;
        }

        .booking-header h1 {
            font-size: 25px;
        }

        .booking-form {
            padding: 22px;
        }

        .card-header {
            padding: 20px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 17px;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .submit-btn,
        .cancel-btn {
            width: 100%;
        }
    }

</style>


<div class="booking-page">


    {{-- PAGE HEADER --}}

    <div class="booking-header">

        <h1>
            Book a New Parcel 📦
        </h1>

        <p>
            Enter the receiver and parcel details to create your shipment.
        </p>

    </div>


    {{-- MAIN CARD --}}

    <div class="booking-card">


        {{-- CARD HEADER --}}

        <div class="card-header">

            <div class="card-header-content">

                <div class="header-icon">
                    📦
                </div>

                <div>

                    <h2>
                        Parcel Booking
                    </h2>

                    <p>
                        Fill in the details below to book your parcel.
                    </p>

                </div>

            </div>

        </div>


        {{-- FORM --}}

        <form
            action="{{ route('user.parcels.store') }}"
            method="POST"
            class="booking-form"
        >

            @csrf


            {{-- INFORMATION BOX --}}

            <div class="info-box">

                <div class="info-icon">
                    ℹ️
                </div>

                <div>

                    <strong>
                        How this works
                    </strong>

                    <p>
                        Enter the receiver and parcel details below.
                        Sender and pickup details will be added by the admin
                        after the parcel is booked.
                    </p>

                </div>

            </div>


            {{-- RECEIVER DETAILS --}}

            <div class="form-section">

                <div class="section-title">

                    <span>
                        📥
                    </span>

                    <h3>
                        Receiver Details
                    </h3>

                </div>


                <div class="form-grid">


                    {{-- RECEIVER NAME --}}

                    <div class="form-group">

                        <label
                            for="receiver_name"
                            class="form-label"
                        >
                            Receiver Name
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="receiver_name"
                            name="receiver_name"
                            class="form-input @error('receiver_name') input-error @enderror"
                            value="{{ old('receiver_name') }}"
                            placeholder="Enter receiver's full name"
                            required
                        >

                        @error('receiver_name')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- RECEIVER PHONE --}}

                    <div class="form-group">

                        <label
                            for="receiver_phone"
                            class="form-label"
                        >
                            Receiver Phone
                            <span class="required">*</span>
                        </label>

                        <input
                            type="tel"
                            id="receiver_phone"
                            name="receiver_phone"
                            class="form-input @error('receiver_phone') input-error @enderror"
                            value="{{ old('receiver_phone') }}"
                            placeholder="Enter 10-digit phone number"
                            required
                        >

                        @error('receiver_phone')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- RECEIVER ADDRESS --}}

                    <div class="form-group full">

                        <label
                            for="receiver_address"
                            class="form-label"
                        >
                            Receiver Address
                            <span class="required">*</span>
                        </label>

                        <textarea
                            id="receiver_address"
                            name="receiver_address"
                            class="form-textarea @error('receiver_address') input-error @enderror"
                            placeholder="Enter complete delivery address"
                            required
                        >{{ old('receiver_address') }}</textarea>

                        @error('receiver_address')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="help-text">
                            Include house/building number, area, city and PIN code.
                        </div>

                    </div>

                </div>

            </div>


            {{-- PARCEL DETAILS --}}

            <div class="form-section">

                <div class="section-title">

                    <span>
                        📦
                    </span>

                    <h3>
                        Parcel Details
                    </h3>

                </div>


                <div class="form-grid">


                    {{-- PARCEL TYPE --}}

                    <div class="form-group">

                        <label
                            for="parcel_type"
                            class="form-label"
                        >
                            Parcel Type
                            <span class="required">*</span>
                        </label>

                        <select
                            id="parcel_type"
                            name="parcel_type"
                            class="form-select @error('parcel_type') input-error @enderror"
                            required
                        >

                            <option value="">
                                Select parcel type
                            </option>

                            <option
                                value="Document"
                                {{ old('parcel_type') == 'Document' ? 'selected' : '' }}
                            >
                                📄 Document
                            </option>

                            <option
                                value="Electronics"
                                {{ old('parcel_type') == 'Electronics' ? 'selected' : '' }}
                            >
                                💻 Electronics
                            </option>

                            <option
                                value="Clothing"
                                {{ old('parcel_type') == 'Clothing' ? 'selected' : '' }}
                            >
                                👕 Clothing
                            </option>

                            <option
                                value="Food"
                                {{ old('parcel_type') == 'Food' ? 'selected' : '' }}
                            >
                                🍱 Food
                            </option>

                            <option
                                value="Fragile"
                                {{ old('parcel_type') == 'Fragile' ? 'selected' : '' }}
                            >
                                🥂 Fragile
                            </option>

                            <option
                                value="Other"
                                {{ old('parcel_type') == 'Other' ? 'selected' : '' }}
                            >
                                📦 Other
                            </option>

                        </select>

                        @error('parcel_type')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- WEIGHT --}}

                    <div class="form-group">

                        <label
                            for="weight"
                            class="form-label"
                        >
                            Weight (kg)
                            <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            id="weight"
                            name="weight"
                            class="form-input @error('weight') input-error @enderror"
                            value="{{ old('weight') }}"
                            placeholder="e.g. 2.50"
                            min="0.01"
                            step="0.01"
                            required
                        >

                        @error('weight')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="help-text">
                            Enter the approximate parcel weight.
                        </div>

                    </div>


                    {{-- DELIVERY DATE --}}

                    <div class="form-group">

                        <label
                            for="estimated_delivery_date"
                            class="form-label"
                        >
                            Estimated Delivery Date
                            <span class="required">*</span>
                        </label>

                        <input
                            type="date"
                            id="estimated_delivery_date"
                            name="estimated_delivery_date"
                            class="form-input @error('estimated_delivery_date') input-error @enderror"
                            value="{{ old('estimated_delivery_date') }}"
                            required
                        >

                        @error('estimated_delivery_date')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- BUTTONS --}}

            <div class="form-actions">

                <a
                    href="{{ route('user.parcels') }}"
                    class="cancel-btn"
                >
                    ← Cancel
                </a>

                <button
                    type="submit"
                    class="submit-btn"
                >
                    📦 Book Parcel
                </button>

            </div>

        </form>

    </div>

</div>

@endsection