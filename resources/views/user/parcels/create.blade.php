@extends('user.layout')

@section('title', 'Book New Parcel | SwiftTrack')

@section('page-title', 'Book New Parcel')

@section('content')

<style>

    /* ================================
       MAIN PAGE
    ================================= */

    .parcel-page {
        max-width: 1200px;
        margin: 0 auto;
    }

    .parcel-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }

    .parcel-header-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background: #dbeafe;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
        flex-shrink: 0;
    }

    .parcel-header h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        color: #0f172a;
    }

    .parcel-header p {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 14px;
    }


    /* ================================
       ERROR BOX
    ================================= */

    .error-box {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 14px;
        padding: 18px 20px;
        margin-bottom: 24px;
        color: #991b1b;
    }

    .error-title {
        font-weight: 700;
        margin-bottom: 8px;
    }

    .error-box ul {
        margin: 0;
        padding-left: 20px;
        font-size: 14px;
    }


    /* ================================
       SENDER + RECEIVER
    ================================= */

    .people-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
        margin-bottom: 22px;
    }


    /* ================================
       CARD
    ================================= */

    .parcel-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
    }

    .card-header {
        padding: 21px 24px;
        border-bottom: 1px solid #eef2f7;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .card-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        flex-shrink: 0;
    }

    .sender-icon {
        background: #dbeafe;
    }

    .receiver-icon {
        background: #dcfce7;
    }

    .parcel-icon {
        background: #f3e8ff;
    }

    .card-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
        color: #172554;
    }

    .card-header p {
        margin: 4px 0 0;
        color: #64748b;
        font-size: 13px;
    }

    .card-body {
        padding: 24px;
    }


    /* ================================
       FORM
    ================================= */

    .form-group {
        margin-bottom: 19px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #334155;
    }

    .required {
        color: #ef4444;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
        color: #94a3b8;
        z-index: 2;
        pointer-events: none;
    }

    .textarea-icon {
        top: 16px;
        transform: none;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #cbd5e1;
        border-radius: 11px;
        background: #ffffff;
        color: #1e293b;
        font-family: inherit;
        font-size: 14px;
        outline: none;
        transition: all 0.2s ease;
    }

    .form-input,
    .form-select {
        height: 46px;
        padding: 0 14px 0 43px;
    }

    .form-textarea {
        min-height: 105px;
        padding: 13px 14px 13px 43px;
        resize: vertical;
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: #94a3b8;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
    }


    /* ================================
       PARCEL DETAILS
    ================================= */

    .parcel-details {
        margin-bottom: 22px;
    }

    .parcel-fields {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .select-wrapper {
        position: relative;
    }

    .select-arrow {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        pointer-events: none;
        font-size: 12px;
    }

    .form-select {
        appearance: none;
        padding-right: 40px;
    }


    /* ================================
       TRACKING INFO
    ================================= */

    .tracking-info {
        margin-top: 23px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 13px;
        padding: 16px 18px;
        display: flex;
        align-items: flex-start;
        gap: 13px;
    }

    .tracking-info-icon {
        width: 34px;
        height: 34px;
        background: #2563eb;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        flex-shrink: 0;
    }

    .tracking-info h3 {
        margin: 1px 0 4px;
        color: #1d4ed8;
        font-size: 14px;
    }

    .tracking-info p {
        margin: 0;
        color: #2563eb;
        font-size: 13px;
        line-height: 1.5;
    }


    /* ================================
       BUTTONS
    ================================= */

    .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
        padding-bottom: 25px;
    }

    .cancel-btn,
    .book-btn {
        height: 46px;
        padding: 0 23px;
        border-radius: 11px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .cancel-btn {
        background: #ffffff;
        color: #475569;
        border: 1px solid #cbd5e1;
    }

    .cancel-btn:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }

    .book-btn {
        border: none;
        background: #2563eb;
        color: white;
        box-shadow: 0 6px 14px rgba(37, 99, 235, 0.20);
    }

    .book-btn:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(37, 99, 235, 0.28);
    }


    /* ================================
       RESPONSIVE
    ================================= */

    @media (max-width: 900px) {

        .people-grid {
            grid-template-columns: 1fr;
        }

        .parcel-fields {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 600px) {

        .parcel-header {
            align-items: flex-start;
        }

        .parcel-header h1 {
            font-size: 24px;
        }

        .card-header,
        .card-body {
            padding: 18px;
        }

        .form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .cancel-btn,
        .book-btn {
            width: 100%;
        }

    }

</style>


<div class="parcel-page">

    {{-- ============================
         PAGE HEADER
    ============================= --}}

    <div class="parcel-header">

        <div class="parcel-header-icon">
            📦
        </div>

        <div>

            <h1>
                Book New Parcel
            </h1>

            <p>
                Enter sender, receiver and parcel details to create a new shipment.
            </p>

        </div>

    </div>


    {{-- ============================
         VALIDATION ERRORS
    ============================= --}}

    @if($errors->any())

        <div class="error-box">

            <div class="error-title">
                ⚠️ Please check the following:
            </div>

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ============================
         FORM
    ============================= --}}

    <form
        method="POST"
        action="{{ route('user.parcels.store') }}"
    >

        @csrf


        {{-- ============================
             SENDER + RECEIVER
        ============================= --}}

        <div class="people-grid">


            {{-- SENDER --}}
            <div class="parcel-card">

                <div class="card-header">

                    <div class="card-icon sender-icon">
                        📤
                    </div>

                    <div>

                        <h2>
                            Sender Details
                        </h2>

                        <p>
                            Enter the sender's information
                        </p>

                    </div>

                </div>


                <div class="card-body">


                    {{-- SENDER NAME --}}

                    <div class="form-group">

                        <label
                            class="form-label"
                            for="sender_name"
                        >
                            Sender Name
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                👤
                            </span>

                            <input
                                type="text"
                                id="sender_name"
                                name="sender_name"
                                class="form-input"
                                value="{{ old('sender_name', auth()->user()->name) }}"
                                placeholder="Enter sender name"
                                required
                            >

                        </div>

                    </div>


                    {{-- SENDER PHONE --}}

                    <div class="form-group">

                        <label
                            class="form-label"
                            for="sender_phone"
                        >
                            Phone Number
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                📞
                            </span>

                            <input
                                type="tel"
                                id="sender_phone"
                                name="sender_phone"
                                class="form-input"
                                value="{{ old('sender_phone') }}"
                                placeholder="Enter phone number"
                                required
                            >

                        </div>

                    </div>


                    {{-- SENDER ADDRESS --}}

                    <div class="form-group">

                        <label
                            class="form-label"
                            for="sender_address"
                        >
                            Pickup Address
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon textarea-icon">
                                📍
                            </span>

                            <textarea
                                id="sender_address"
                                name="sender_address"
                                class="form-textarea"
                                placeholder="Enter complete pickup address"
                                required
                            >{{ old('sender_address') }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            {{-- RECEIVER --}}
            <div class="parcel-card">

                <div class="card-header">

                    <div class="card-icon receiver-icon">
                        📥
                    </div>

                    <div>

                        <h2>
                            Receiver Details
                        </h2>

                        <p>
                            Enter the receiver's information
                        </p>

                    </div>

                </div>


                <div class="card-body">


                    {{-- RECEIVER NAME --}}

                    <div class="form-group">

                        <label
                            class="form-label"
                            for="receiver_name"
                        >
                            Receiver Name
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                👤
                            </span>

                            <input
                                type="text"
                                id="receiver_name"
                                name="receiver_name"
                                class="form-input"
                                value="{{ old('receiver_name') }}"
                                placeholder="Enter receiver name"
                                required
                            >

                        </div>

                    </div>


                    {{-- RECEIVER PHONE --}}

                    <div class="form-group">

                        <label
                            class="form-label"
                            for="receiver_phone"
                        >
                            Phone Number
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                📞
                            </span>

                            <input
                                type="tel"
                                id="receiver_phone"
                                name="receiver_phone"
                                class="form-input"
                                value="{{ old('receiver_phone') }}"
                                placeholder="Enter phone number"
                                required
                            >

                        </div>

                    </div>


                    {{-- RECEIVER ADDRESS --}}

                    <div class="form-group">

                        <label
                            class="form-label"
                            for="receiver_address"
                        >
                            Delivery Address
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon textarea-icon">
                                📍
                            </span>

                            <textarea
                                id="receiver_address"
                                name="receiver_address"
                                class="form-textarea"
                                placeholder="Enter complete delivery address"
                                required
                            >{{ old('receiver_address') }}</textarea>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================
             PARCEL DETAILS
        ============================= --}}

        <div class="parcel-card parcel-details">

            <div class="card-header">

                <div class="card-icon parcel-icon">
                    📦
                </div>

                <div>

                    <h2>
                        Parcel Details
                    </h2>

                    <p>
                        Provide information about your shipment
                    </p>

                </div>

            </div>


            <div class="card-body">

                <div class="parcel-fields">


                    {{-- PARCEL TYPE --}}

                    <div class="form-group">

                        <label
                            class="form-label"
                            for="parcel_type"
                        >
                            Parcel Type
                            <span class="required">*</span>
                        </label>

                        <div class="select-wrapper">

                            <span class="input-icon">
                                📦
                            </span>

                            <select
                                id="parcel_type"
                                name="parcel_type"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Select parcel type
                                </option>

                                <option
                                    value="Document"
                                    {{ old('parcel_type') == 'Document' ? 'selected' : '' }}
                                >
                                    Document
                                </option>

                                <option
                                    value="Electronics"
                                    {{ old('parcel_type') == 'Electronics' ? 'selected' : '' }}
                                >
                                    Electronics
                                </option>

                                <option
                                    value="Clothing"
                                    {{ old('parcel_type') == 'Clothing' ? 'selected' : '' }}
                                >
                                    Clothing
                                </option>

                                <option
                                    value="Food"
                                    {{ old('parcel_type') == 'Food' ? 'selected' : '' }}
                                >
                                    Food
                                </option>

                                <option
                                    value="Fragile"
                                    {{ old('parcel_type') == 'Fragile' ? 'selected' : '' }}
                                >
                                    Fragile
                                </option>

                                <option
                                    value="Other"
                                    {{ old('parcel_type') == 'Other' ? 'selected' : '' }}
                                >
                                    Other
                                </option>

                            </select>

                            <span class="select-arrow">
                                ▼
                            </span>

                        </div>

                    </div>


                    {{-- WEIGHT --}}

                    <div class="form-group">

                        <label
                            class="form-label"
                            for="weight"
                        >
                            Weight (kg)
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                ⚖️
                            </span>

                            <input
                                type="number"
                                id="weight"
                                name="weight"
                                class="form-input"
                                value="{{ old('weight') }}"
                                min="0.1"
                                step="0.01"
                                placeholder="e.g. 2.5"
                                required
                            >

                        </div>

                    </div>


                    {{-- DELIVERY DATE --}}

                    <div class="form-group">

                        <label
                            class="form-label"
                            for="estimated_delivery_date"
                        >
                            Estimated Delivery
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                📅
                            </span>

                            <input
                                type="date"
                                id="estimated_delivery_date"
                                name="estimated_delivery_date"
                                class="form-input"
                                value="{{ old('estimated_delivery_date') }}"
                                min="{{ date('Y-m-d') }}"
                                required
                            >

                        </div>

                    </div>

                </div>


                {{-- TRACKING INFORMATION --}}

                <div class="tracking-info">

                    <div class="tracking-info-icon">
                        i
                    </div>

                    <div>

                        <h3>
                            Automatic Tracking Number
                        </h3>

                        <p>
                            A unique SwiftTrack tracking number will be
                            automatically generated after booking.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================
             ACTION BUTTONS
        ============================= --}}

        <div class="form-actions">

            <a
                href="{{ route('user.dashboard') }}"
                class="cancel-btn"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="book-btn"
            >
                📦 &nbsp; Book Parcel
            </button>

        </div>

    </form>

</div>

@endsection