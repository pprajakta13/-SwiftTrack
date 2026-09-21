<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Parcel;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $totalParcels = Parcel::where('user_id', $userId)->count();
        $inTransit = Parcel::where('user_id', $userId)->whereIn('current_status', ['Picked Up','In Transit','At Hub','Out for Delivery'])->count();
        $delivered = Parcel::where('user_id', $userId)->where('current_status', 'Delivered')->count();
        $booked = Parcel::where('user_id', $userId)->where('current_status', 'Booked')->count();
        $recentParcels = Parcel::where('user_id', $userId)->latest()->take(5)->get();

        return view('user.dashboard', compact('totalParcels','inTransit','delivered','booked','recentParcels'));
    }
}
