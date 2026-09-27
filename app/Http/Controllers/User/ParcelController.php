<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Parcel;
use App\Models\ParcelStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParcelController extends Controller
{
    /**
     * Display user's parcels.
     */
    public function index()
    {
        $parcels = Parcel::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.parcels.index', compact('parcels'));
    }


    /**
     * Show booking form.
     */
    public function create()
    {
        return view('user.parcels.create');
    }


    /**
     * Store a new parcel booking.
     *
     * USER enters receiver + parcel details.
     * ADMIN will enter sender details later.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_name' => [
                'required',
                'string',
                'max:255',
            ],

            'receiver_phone' => [
                'required',
                'string',
                'max:20',
            ],

            'receiver_address' => [
                'required',
                'string',
                'max:1000',
            ],

            'parcel_type' => [
                'required',
                'string',
                'max:100',
            ],

            'weight' => [
                'required',
                'numeric',
                'min:0.1',
                'max:9999',
            ],

            'estimated_delivery_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
        ]);


        $parcel = DB::transaction(function () use ($validated) {

            /*
             * Generate unique tracking number.
             */
            do {
                $trackingNumber =
                    'ST' . strtoupper(Str::random(10));

            } while (
                Parcel::where(
                    'tracking_number',
                    $trackingNumber
                )->exists()
            );


            /*
             * Create parcel.
             *
             * Sender details are intentionally left NULL.
             * Admin will add them later.
             */
            $parcel = Parcel::create([

                'tracking_number' =>
                    $trackingNumber,

                'user_id' =>
                    auth()->id(),

                'sender_name' =>
                    null,

                'sender_phone' =>
                    null,

                'sender_address' =>
                    null,

                'receiver_name' =>
                    $validated['receiver_name'],

                'receiver_phone' =>
                    $validated['receiver_phone'],

                'receiver_address' =>
                    $validated['receiver_address'],

                'parcel_type' =>
                    $validated['parcel_type'],

                'weight' =>
                    $validated['weight'],

                'current_status' =>
                    'Booked',

                'estimated_delivery_date' =>
                    $validated['estimated_delivery_date'],
            ]);


            /*
             * Create first tracking history.
             */
            ParcelStatusHistory::create([

                'parcel_id' =>
                    $parcel->id,

                'status' =>
                    'Booked',

                'location' =>
                    'Booking Centre',

                'remarks' =>
                    'Parcel booking created. Awaiting pickup.',

                'updated_by' =>
                    auth()->id(),
            ]);


            /*
             * Create audit log.
             */
            AuditLog::create([

                'user_id' =>
                    auth()->id(),

                'parcel_id' =>
                    $parcel->id,

                'action' =>
                    'Parcel Booked',

                'description' =>
                    'New parcel ' .
                    $parcel->tracking_number .
                    ' was booked.',
            ]);


            return $parcel;
        });


        return redirect()
            ->route(
                'user.parcels.show',
                $parcel->tracking_number
            )
            ->with(
                'success',
                'Parcel booked successfully! Your tracking number is ' .
                $parcel->tracking_number
            );
    }


    /**
     * Show parcel tracking page.
     */
    public function show(string $trackingNumber)
    {
        $parcel = Parcel::where(
                'tracking_number',
                $trackingNumber
            )
            ->where(
                'user_id',
                auth()->id()
            )
            ->firstOrFail();


        $history = $parcel
            ->statusHistories()
            ->with('updater')
            ->latest('created_at')
            ->get();


        return view(
            'user.parcels.show',
            compact(
                'parcel',
                'history'
            )
        );
    }
}