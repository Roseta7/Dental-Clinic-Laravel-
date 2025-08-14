@extends('layouts.app')

@section('title', 'View Treatment')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/viewDetails.css') }}">
@endpush

@section('content')
    <div class="container py-4 d-flex justify-content-center">
        <div class="card card-custom  ">
            <div class="card-body ">
                <h2 class="card-title mb-4 text-center">{{ $treatment->patient->patient_name }}'s Treatment Details</h2>
                <ul>
                    <li class="mt-2">Treatment ID: {{ $treatment->id }} </li>
                    <li class="mt-2">Healer Dentist: {{ $treatment->dentist->user->name }}</li>
                    <li class="mt-2">Patient: {{ $treatment->patient->patient_name }} </li>
                    <li class="mt-2">Appointment ID: {{ $treatment->appointment_id }} </li>
                    <li class="mt-2">Treatment Date: {{ $treatment->treatment_date }} </li>
                    <li class="mt-2">Treatment Type: {{ $treatment->treatment_type }}</li>
                    <li class="mt-2">Treatment Procedure: {{ $treatment->treatment_procedure }}</li>
                    <li class="mt-2">Treatment Cost: {{ number_format($treatment->treatment_cost, 2) }}</li>
                    <li class="mt-2">Treatment Status: {{ ucfirst($treatment->treatment_status) }}</li>
                    <li class="mt-2">Created At: {{ $treatment->created_at }}</li>
                    <li class="mt-2">Updated At: {{ $treatment->updated_at }}</li>
                </ul>

                <div class="mt-4 text-center">
                    <button class="badge-back">
                        <a href="{{ route('treatments.index') }}">Back</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection