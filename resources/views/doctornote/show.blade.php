@extends('layouts.app')

@section('title', 'View Note')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/viewDetails.css') }}">
@endpush

@section('content')
    <div class="container py-4 d-flex justify-content-center">
        <div class="card card-custom  ">
            <div class="card-body ">
                <h2 class="card-title mb-4 text-center">{{ $doctornote->patient->patient_name }}'s Note Details</h2>
                <ul>
                    <li class="mt-2">Note ID: {{ $doctornote->id }} </li>
                    <li class="mt-2">Written By Doctor: {{ $doctornote->dentist->user->name }}</li>
                    <li class="mt-2">Patient: {{ $doctornote->patient->patient_name }} </li>
                    <li class="mt-2">Related Appointment: {{ $doctornote->treatment->appointment_id }} </li>
                    <li class="mt-2">Related Treatment: {{ $doctornote->treatment->id }}</li>
                    <li class="mt-2">Note Description: {{ $doctornote->noteDescription }}</li>
                    <li class="mt-2">Date Created: {{ $doctornote->dateCreated }}</li>
                    <li class="mt-2">Created At: {{ $doctornote->created_at }}</li>
                    <li class="mt-2">Updated At: {{ $doctornote->updated_at }}</li>
                </ul>

                <div class="mt-4 text-center">
                    <button class="badge-back">
                        <a href="{{ route('doctornotes.index') }}">Back</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection