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
    public function index()
    {
        $parcels = Parcel::where('user_id', auth()->id())->latest()->get();
        return view('user.parcels.index', compact('parcels'));
    }

    public function create()
    {
        return view('user.parcels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => ['required','string','max:255'],
            'sender_phone' => ['required','string','max:20'],
            'sender_address' => ['required','string','max:1000'],
            'receiver_name' => ['required','string','max:255'],
            'receiver_phone' => ['required','string','max:20'],
            'receiver_address' => ['required','string','max:1000'],
            'parcel_type' => ['required','string','max:100'],
            'weight' => ['required','numeric','min:0.1','max:9999'],
            'estimated_delivery_date' => ['required','date','after_or_equal:today'],
        ]);

        $parcel = DB::transaction(function () use ($validated) {
            do {
                $trackingNumber = 'ST' . strtoupper(Str::random(10));
            } while (Parcel::where('tracking_number', $trackingNumber)->exists());

            $parcel = Parcel::create([
                'tracking_number' => $trackingNumber,
                'user_id' => auth()->id(),
                'sender_name' => $validated['sender_name'],
                'sender_phone' => $validated['sender_phone'],
                'sender_address' => $validated['sender_address'],
                'receiver_name' => $validated['receiver_name'],
                'receiver_phone' => $validated['receiver_phone'],
                'receiver_address' => $validated['receiver_address'],
                'parcel_type' => $validated['parcel_type'],
                'weight' => $validated['weight'],
                'current_status' => 'Booked',
                'estimated_delivery_date' => $validated['estimated_delivery_date'],
            ]);

            ParcelStatusHistory::create([
                'parcel_id' => $parcel->id,
                'status' => 'Booked',
                'location' => 'Booking Centre',
                'remarks' => 'Parcel booking created successfully.',
                'updated_by' => auth()->id(),
            ]);

            AuditLog::create([
                'user_id' => auth()->id(),
                'parcel_id' => $parcel->id,
                'action' => 'Parcel Booked',
                'description' => 'New parcel '.$parcel->tracking_number.' was booked.',
            ]);

            return $parcel;
        });

        return redirect()->route('user.parcels.show', $parcel->tracking_number)->with('success', 'Parcel booked successfully!');
    }

    public function show(string $trackingNumber)
    {
        $parcel = Parcel::where('tracking_number', $trackingNumber)->where('user_id', auth()->id())->firstOrFail();
        $history = $parcel->statusHistories()->with('updater')->latest('created_at')->get();
        return view('user.parcels.show', compact('parcel','history'));
    }
}
