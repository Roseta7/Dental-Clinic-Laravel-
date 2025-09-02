@extends('layouts.app')

@section('title', 'View Audit Logs')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/viewDetails.css') }}">
@endpush

@section('content')
    <div class="container py-4 d-flex justify-content-center">
        <div class="card card-custom px-4 py-4">
            <div class="card-body ">
                <h2 class="card-title mb-4 text-center">Audit Log Details</h2>
                <div class="mb-3"><strong>Log ID:</strong> {{ $audit_log->id }}</div>
                <div class="mb-3"><strong>User ID:</strong> {{ $audit_log->user->id }}</div>
                <div class="mb-3"><strong>User:</strong> {{ $audit_log->user->name }}</div>
                <div class="mb-3"><strong>Action:</strong> {{ $audit_log->action_type }}</div>
                <div class="mb-3"><strong>Table:</strong> {{ $audit_log->table_name }}</div>
                <div class="mb-3"><strong>Record ID:</strong> {{ $audit_log->record_id }}</div>
                <div class="mb-3"><strong>Timestamp:</strong> {{ $audit_log->action_time->format('Y-m-d H:i:s') }}</div>

                <h4 class="mb-3 text-info">Changes</h4>
                @php
                    $details = json_decode($audit_log->action_details, true);
                @endphp

                @if($audit_log->action_type === 'Update' && isset($details['old']) && isset($details['new']))
                    <div class="table-responsive">
                        <table class="custom-dark-table">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Old Value</th>
                                    <th>New Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details['old'] as $field => $oldValue)
                                    <tr>
                                        <td data-label="Field">{{ $field }}</td>

                                        <td class="col-long" data-label="Old Value">
                                            <span style="color: #f87171;">{{ is_array($oldValue) ? json_encode($oldValue) : $oldValue }}</span>
                                        </td>

                                        <td class="col-long" data-label="New Value" >
                                            <span style="color: #34d399;">{{ is_array($details['new'][$field]) ? json_encode($details['new'][$field]) : $details['new'][$field] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @elseif($audit_log->action_type === 'Delete' && isset($details['old']))
                    <div class="table-responsive">
                        <table class="custom-dark-table">
                            <thead>
                                <tr>
                                    <th class="p-3">Field</th>
                                    <th>Deleted Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details['old'] as $field => $value)
                                    <tr>
                                        <td data-label="Field">{{ $field }}</td>
                                        
                                        <td class="col-long" data-label="Deleted Value">
                                            <span style="color: #f87171;">{{ is_array($value) ? json_encode($value) : $value }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No detailed change data available.</p>
                @endif

                <div class="mt-4 text-center">
                    <button class="badge-back">
                        <a href="{{ route('audit-logs.index') }}" style="text-decoration: none;">Back</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection