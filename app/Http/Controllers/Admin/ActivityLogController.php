<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with(['user','parcel'])->latest('created_at');
        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('action','like',"%{$search}%")
                  ->orWhere('description','like',"%{$search}%");
            });
        }
        $logs = $query->paginate(15)->withQueryString();
        return view('admin.logs.index', compact('logs'));
    }
}
