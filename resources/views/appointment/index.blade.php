@extends('layouts.app')

@section('title','Appointments Table')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/showTables.css') }}">
@endpush

@section('content')
    <div class="container py-4">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title text-center mb-4 ">Appointments </h5>

                <div class="table-responsive dark-table">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Healer Dentist</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Attendance Status</th>
                                <th scope="col">Visit Type</th>
                                <th scope="col">View Details</th>
                                @if($appointments->contains(function($appointment) {
                                    return auth()->user()->can('update', $appointment)
                                        || auth()->user()->can('delete', $appointment);
                                }))
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>{{ $appointment->dentist->user->name }}</td>
                                        <td>{{ $appointment->patient->patient_name }}</td>
                                        <td>{{ $appointment->appointment_date }}</td>
                                        <td>{{ $appointment->appointment_time }}</td>
                                        <td>{{ number_format($appointment->appointment_cost, 2) }}</td>
                                        <td>{{ ucfirst($appointment->appointment_status) }}</td>
                                        <td>{{ $appointment->visit_type }}</td>
                                        <td>
                                            @can('view', $appointment)
                                                <button class="badge-show "><a href="{{ route('appointments.show', $appointment) }}">View</a></button>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('update', $appointment)
                                                <button class="badge-update"><a href="{{ route('appointments.edit', $appointment) }}">update</a></button>
                                            @endcan
                                            @can('delete', $appointment)
                                                <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are You Sure You Want To Delete This Appointment?')" class="badge-delete">delete</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection