@extends('layouts.app')

@section('title', 'View Invoice')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/viewDetails.css') }}">
@endpush

@section('content')
    <div class="container py-4 d-flex justify-content-center">
        <div class="card card-custom  ">
            <div class="card-body ">
                <h2 class="card-title mb-4 text-center">{{ $invoice->patient->patient_name }}'s Invoice Details</h2>
                <ul>
                    <li class="mt-2">Invoice ID: {{ $invoice->id }} </li>
                    <li class="mt-2">Dentist: {{ $invoice->dentist->user->name }}</li>
                    <li class="mt-2">Patient: {{ $invoice->patient->patient_name }} </li>
                    <li class="mt-2">Appointment ID: {{ $invoice->appointment_id }} </li>
                    <li class="mt-2">Total Bill: {{number_format($invoice->totalbill, 2)}}</li>
                    <li class="mt-2">Payment Date: {{ $invoice->paymentDate }}</li>
                    <li class="mt-2">Payment Methode: {{ ucfirst($invoice->paymentMethode) }}</li>
                    <li class="mt-2">Payment Status: {{ ucfirst($invoice->paymentStatus) }}</li>
                    <li class="mt-2">Created At: {{ $invoice->created_at }}</li>
                    <li class="mt-2">Updated At: {{ $invoice->updated_at }}</li>
                </ul>

                <div class="mt-4 text-center">
                    <button class="badge-back">
                        <a href="{{ route('invoices.index') }}">Back</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection