@extends('admin.layout')
@section('title','Activity Logs | SwiftTrack')
@section('page-heading','Activity Logs')
@section('content')
<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6"><div><h2 class="text-2xl font-black">System Activity</h2><p class="text-slate-500">Audit trail for parcel actions.</p></div><form method="GET" class="flex gap-2"><input name="search" value="{{ request('search') }}" placeholder="Search activity" class="rounded-xl border px-4 py-3"><button class="rounded-xl bg-slate-900 text-white px-5 py-3 font-bold">Search</button></form></div><div class="bg-white rounded-2xl border overflow-hidden"><div class="overflow-x-auto"><table class="w-full text-sm"><thead class="bg-slate-50"><tr><th class="text-left px-6 py-4">Time</th><th class="text-left px-6 py-4">Actor</th><th class="text-left px-6 py-4">Action</th><th class="text-left px-6 py-4">Description</th><th class="text-left px-6 py-4">Parcel</th></tr></thead><tbody>@forelse($logs as $log)<tr class="border-t"><td class="px-6 py-4 whitespace-nowrap">{{ $log->created_at?->format('d M Y, h:i A') }}</td><td class="px-6 py-4">{{ $log->user?->name ?? 'System' }}</td><td class="px-6 py-4"><span class="px-3 py-1 rounded-full bg-slate-100 font-bold">{{ $log->action }}</span></td><td class="px-6 py-4">{{ $log->description }}</td><td class="px-6 py-4 font-semibold">{{ $log->parcel?->tracking_number ?? '—' }}</td></tr>@empty<tr><td colspan="5" class="p-10 text-center text-slate-500">No activity recorded yet.</td></tr>@endforelse</tbody></table></div></div><div class="mt-6">{{ $logs->links() }}</div>
@endsection
@extends('admin.layout')

@section('title', 'Activity Logs | SwiftTrack')

@section('page-title', 'Activity Logs')

@section('content')

<style>

    .heading {
        margin-bottom: 22px;
    }

    .heading h1 {
        color: #0f172a;
        font-size: 25px;
        margin-bottom: 5px;
    }

    .heading p {
        color: #64748b;
        font-size: 14px;
    }

    .table-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        overflow: hidden;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 750px;
    }

    th {
        background: #f8fafc;
        color: #64748b;
        text-align: left;
        padding: 15px;
        font-size: 12px;
    }

    td {
        padding: 16px 15px;
        border-top: 1px solid #e2e8f0;
        font-size: 13px;
    }

    .action {
        color: #2563eb;
        font-weight: bold;
    }

    .empty {
        text-align: center;
        padding: 60px;
        color: #64748b;
    }

</style>


<div class="heading">

    <h1>
        📋 Activity Logs
    </h1>

    <p>
        Monitor important activities performed in the system.
    </p>

</div>


<div class="table-card">

    @if(isset($logs) && $logs->count())

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Date & Time
                        </th>

                        <th>
                            User
                        </th>

                        <th>
                            Action
                        </th>

                        <th>
                            Description
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($logs as $log)

                        <tr>

                            <td>
                                {{ $log->created_at->format('d M Y, h:i A') }}
                            </td>

                            <td>
                                {{ $log->user->name ?? 'System' }}
                            </td>

                            <td class="action">
                                {{ $log->action }}
                            </td>

                            <td>
                                {{ $log->description }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="empty">

            📋

            <h3>
                No activity logs yet
            </h3>

            <p>
                System activities will appear here.
            </p>

        </div>

    @endif

</div>

@endsection