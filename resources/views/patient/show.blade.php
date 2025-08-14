@extends('layouts.app')

@section('title', 'View Patient')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/viewDetails.css') }}">
@endpush

@section('content')
    <div class="container py-4 d-flex justify-content-center">
        <div class="card card-custom px-4 py-4">
            <div class="card-body ">
                <h2 class="card-title mb-4 text-center">{{ $patient->patient_name }} Info</h2>
                <ul>
                    <li class="mt-2">Patient ID: {{ $patient->id }}</li><br>
                    <li class="mt-2">Patient Name: {{ $patient->patient_name }}</li><br>
                    <li class="mt-2">Patient Gender: {{ $patient->patient_gender }}</li><br>
                    <li class="mt-2">Patient Email: {{ $patient->patient_email }}</li><br>
                    <li class="mt-2">Patient Phone: {{ $patient->patient_phone }}</li><br>
                    <li class="mt-2">Birth Date: {{ $patient->date_of_birth }}</li><br>
                    <li class="mt-2">Created At: {{ $patient->created_at }}</li><br>
                    <li class="mt-2">Updated At: {{ $patient->updated_at }}</li><br>
                </ul>

                <div class="mt-4 text-center">
                    <button class="badge-back">
                        <a href="{{ route('patients.index') }}">Back</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection