<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Parcel;
use App\Models\ParcelStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParcelController extends Controller
{
    /**
     * Display all parcels.
     */
    public function index(Request $request)
    {
        $statuses = [
            'Booked',
            'Picked Up',
            'In Transit',
            'At Hub',
            'Out for Delivery',
            'Delivered',
            'Cancelled',
        ];


        $query = Parcel::with('user')->latest();


        /*
         * Search.
         */
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'tracking_number',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'sender_name',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'receiver_name',
                    'like',
                    "%{$search}%"
                );

            });
        }


        /*
         * Status filter.
         */
        if ($request->filled('status')) {

            $query->where(
                'current_status',
                $request->status
            );
        }


        $parcels = $query
            ->paginate(10)
            ->withQueryString();


        return view(
            'admin.parcels.index',
            compact(
                'parcels',
                'statuses'
            )
        );
    }


    /**
     * Update sender details and parcel status.
     */
    public function update(
        Request $request,
        Parcel $parcel
    ) {

        $statuses = [
            'Booked',
            'Picked Up',
            'In Transit',
            'At Hub',
            'Out for Delivery',
            'Delivered',
            'Cancelled',
        ];


        $validated = $request->validate([

            'sender_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sender_phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'sender_address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'status' => [
                'required',
                'string',
                'in:' . implode(',', $statuses),
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ]);


        /*
         * Update parcel.
         */
        $parcel->update([

            'sender_name' =>
                $validated['sender_name'] ?? null,

            'sender_phone' =>
                $validated['sender_phone'] ?? null,

            'sender_address' =>
                $validated['sender_address'] ?? null,

            'current_status' =>
                $validated['status'],

        ]);


        /*
         * Create tracking history.
         */
        ParcelStatusHistory::create([

            'parcel_id' =>
                $parcel->id,

            'status' =>
                $validated['status'],

            'location' =>
                $validated['location'] ?? null,

            'remarks' =>
                $validated['remarks'] ?? null,

            'updated_by' =>
                Auth::id(),

        ]);


        /*
         * Audit log.
         */
        AuditLog::create([

            'user_id' =>
                Auth::id(),

            'parcel_id' =>
                $parcel->id,

            'action' =>
                'Parcel Updated',

            'description' =>
                'Parcel ' .
                $parcel->tracking_number .
                ' was updated by admin.',

        ]);


        return redirect()
            ->route('admin.parcels')
            ->with(
                'success',
                'Parcel updated successfully.'
            );
    }
}