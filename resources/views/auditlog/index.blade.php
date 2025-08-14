@extends('layouts.app')

@section('title', 'Audit Logs Table')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/showTables.css') }}">
@endpush

@section('content')
    <div class="container py-4">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title text-center mb-4 ">Audit Logs</h5>
                <div class="table-responsive dark-table">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Action Type</th>
                                <th scope="col">The Modified Table</th>
                                <th scope="col">Record ID</th>
                                <th scope="col">Time</th>
                                <th scope="col">View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->user->id }}</td>
                                    <td>{{ $log->user->name }}</td>
                                    <td>{{ $log->action_type }}</td>
                                    <td>{{ $log->table_name }}</td>
                                    <td>{{ $log->record_id }}</td>
                                    <td>{{ $log->action_time->format('Y-m-d H:i:s') }}</td>
                                    @can('view', $log)
                                        <td>
                                            <button class="badge-show"><a href="{{ route('audit-logs.show', $log) }}">View</a></button>
                                        </td>
                                    @endcan
                                    <!-- <td>{{ Str::limit($log->action_details, 100) }}</td> -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection