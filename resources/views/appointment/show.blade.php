@extends('layouts.app')

@section('title', 'View Appointment')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/viewDetails.css') }}">
@endpush

@section('content')
    <div class="container py-4 d-flex justify-content-center">
        <div class="card card-custom  ">
            <div class="card-body ">
                <h2 class="card-title mb-4 text-center">{{ $appointment->patient->patient_name }}'s Appointment Details</h2>
                <ul>
                    <li class="mt-2">Appointment ID: {{ $appointment->id }} </li>
                    <li class="mt-2">Healer Dentist: {{ $appointment->dentist->user->name }}</li>
                    <li class="mt-2">Patient: {{ $appointment->patient->patient_name }} </li>
                    <li class="mt-2">Appointment Date: {{ $appointment->appointment_date }} </li>
                    <li class="mt-2">Appointment Time: {{ $appointment->appointment_time }}</li>
                    <li class="mt-2">Appointment Cost: {{ number_format($appointment->appointment_cost, 2) }}</li>
                    <li class="mt-2">Appointment Status: {{ ucfirst($appointment->appointment_status) }}</li>
                    <li class="mt-2">Visit Type: {{ $appointment->visit_type }}</li>
                    <li class="mt-2">Created At: {{ $appointment->created_at }}</li>
                    <li class="mt-2">Updated At: {{ $appointment->updated_at }}</li>
                </ul>

                <div class="mt-4 text-center">
                    <button class="badge-back">
                        <a href="{{ route('appointments.index') }}">Back</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection