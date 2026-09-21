<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalParcels = Parcel::count();

        $inTransit = Parcel::whereIn('current_status', [
            'Picked Up',
            'In Transit',
            'At Hub',
            'Out for Delivery'
        ])->count();

        $delivered = Parcel::where(
            'current_status',
            'Delivered'
        )->count();

        $totalUsers = User::where(
            'role',
            'user'
        )->count();

        return view('admin.dashboard', compact(
            'totalParcels',
            'inTransit',
            'delivered',
            'totalUsers'
        ));
    }
}