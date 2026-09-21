<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parcel;

class ParcelController extends Controller
{
    public function index()
    {
        $parcels = Parcel::with('user')
            ->latest()
            ->get();

        return view(
            'admin.parcels.index',
            compact('parcels')
        );
    }
}