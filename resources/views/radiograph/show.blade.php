@extends('layouts.app')

@section('title', 'View Radiograph')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/viewDetails.css') }}">
@endpush

@section('content')
    <div class="container py-4 d-flex justify-content-center">
        <div class="card card-custom  ">
            <div class="card-body ">
                <h2 class="card-title mb-4 text-center">{{ $radiograph->patient->patient_name }}'s Radiograph Details</h2>
                <ul>
                    <li class="mt-2">Radiograph ID: {{ $radiograph->id }} </li>
                    <li class="mt-2">Supervising Dentist: {{ $radiograph->dentist->user->name }} </li>
                    <li class="mt-2">Patient: {{ $radiograph->patient->patient_name }} </li>
                    <li class="mt-2">Appointment ID: {{ $radiograph->appointment_id }} </li>
                    <li class="mt-2">Date Taken: {{ $radiograph->dateTaken }} </li>
                    <li class="mt-2">Radiograph Description: {{ $radiograph->imageDescription }} </li>
                    <li class="mt-2">Created At: {{ $radiograph->created_at }}</li>
                    <li class="mt-2">Updated At: {{ $radiograph->updated_at }}</li>
                    <li><br>
                        <h4>The Radiograph:</h4>
                        <div class="images">
                            <img src="{{ asset('storage/' . $radiograph->image_path) }}" alt="Radiograph Image" width="300">
                        </div>
                    </li>
                </ul>

                <div class="mt-4 text-center">
                    <button class="badge-back">
                        <a href="{{ route('radiographs.index') }}">Back</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection