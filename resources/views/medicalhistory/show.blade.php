@extends('layouts.app')

@section('title', 'View Medical Record')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/viewDetails.css') }}">
@endpush

@section('content')
    <div class="container py-4 d-flex justify-content-center">
        <div class="card card-custom  ">
            <div class="card-body ">
                <h2 class="card-title mb-4 text-center">{{ $medicalhistory->patient->patient_name }}'s Medical Record Details</h2>
                <ul>
                    <li class="mt-2">Medical ID: {{ $medicalhistory->id }} </li>
                    <li class="mt-2">Healer Dentist: {{ $medicalhistory->dentist->user->name }}</li>
                    <li class="mt-2">Patient: {{ $medicalhistory->patient->patient_name }} </li>
                    <li class="mt-2">Treatment ID: {{ $medicalhistory->treatment->id }} </li>
                    <li class="mt-2">Procedure Summary: {{ $medicalhistory->procedure_Summary }} </li>
                    <li class="mt-2">Diagnosis: {{ $medicalhistory->diagnosis }}</li>
                    <li class="mt-2">Previous Treatments: {{ $medicalhistory->previous_Treatments }}</li>
                    <li class="mt-2">Date: {{ $medicalhistory->medical_treat_date }}</li>
                    <li class="mt-2">Medications: {{ $medicalhistory->medications }}</li>
                    <li class="mt-2">Created At: {{ $medicalhistory->created_at }}</li>
                    <li class="mt-2">Updated At: {{ $medicalhistory->updated_at }}</li>
                </ul>

                <div class="mt-4 text-center">
                    <button class="badge-back">
                        <a href="{{ route('medicalhistories.index') }}">Back</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection