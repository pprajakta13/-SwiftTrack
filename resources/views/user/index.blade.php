@extends('user.layout')

@section('title', 'My Parcels - SwiftTrack')

@section('page-heading', 'My Parcels')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold">
            My Parcels
        </h1>

        <p class="text-slate-500 mt-1">
            View and track all your parcels.
        </p>

    </div>

    <a href="{{ route('user.parcels.create') }}"
       class="bg-blue-600 text-white px-5 py-3
              rounded-xl font-semibold hover:bg-blue-700">

        + Book Parcel

    </a>

</div>


<div class="bg-white rounded-2xl
            border border-slate-200 overflow-hidden">

    @if($parcels->count())

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="text-left px-6 py-4">
                            Tracking Number
                        </th>

                        <th class="text-left px-6 py-4">
                            Receiver
                        </th>

                        <th class="text-left px-6 py-4">
                            Type
                        </th>

                        <th class="text-left px-6 py-4">
                            Status
                        </th>

                        <th class="text-left px-6 py-4">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($parcels as $parcel)

                        <tr class="border-t border-slate-100">

                            <td class="px-6 py-4 font-semibold">
                                {{ $parcel->tracking_number }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $parcel->receiver_name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $parcel->parcel_type }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="px-3 py-1 rounded-full
                                             bg-blue-100 text-blue-700
                                             text-xs font-semibold">

                                    {{ $parcel->current_status }}

                                </span>

                            </td>

                            <td class="px-6 py-4">

                                <a
                                    href="{{ route('user.parcels.show', $parcel->tracking_number) }}"
                                    class="text-blue-600 font-semibold">

                                    Track →

                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="p-12 text-center">

            <div class="text-5xl mb-4">
                📦
            </div>

            <h2 class="text-xl font-bold">
                No parcels found
            </h2>

            <p class="text-slate-500 mt-2">
                You haven't booked any parcels yet.
            </p>

        </div>

    @endif

</div>

@endsection