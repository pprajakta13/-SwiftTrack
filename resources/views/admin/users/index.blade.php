@extends('admin.layout')

@section('title', 'Users | SwiftTrack')

@section('page-title', 'Users')

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
        min-width: 650px;
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
        font-size: 14px;
    }

    .role {
        padding: 6px 11px;
        border-radius: 20px;
        background: #dbeafe;
        color: #1d4ed8;
        font-size: 11px;
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
        👥 Registered Users
    </h1>

    <p>
        View users registered on the SwiftTrack platform.
    </p>

</div>


<div class="table-card">

    @if(isset($users) && $users->count())

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Registered
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($users as $user)

                        <tr>

                            <td>
                                #{{ $user->id }}
                            </td>

                            <td>
                                {{ $user->name }}
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>

                                <span class="role">
                                    {{ ucfirst($user->role) }}
                                </span>

                            </td>

                            <td>
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="empty">

            👥

            <h3>
                No users found
            </h3>

        </div>

    @endif

</div>

@endsection