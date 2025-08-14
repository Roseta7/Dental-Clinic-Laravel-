@extends('layouts.app')

@section('title', 'Invoices Table')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/showTables.css') }}">
@endpush

@section('content')
    <div class="container py-4">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title text-center mb-4 ">Invoices</h5>

                <div class="table-responsive dark-table">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Dentist</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Appointment ID</th>
                                <th scope="col">Total Bill</th>
                                <th scope="col">Payment Date</th>
                                <th scope="col">Payment Methode</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">View Details</th>
                                @if($invoices->contains(function($invoice) {
                                    return auth()->user()->can('update', $invoice)
                                        || auth()->user()->can('delete', $invoice);
                                }))
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->dentist->user->name }}</td>
                                    <td>{{ $invoice->patient->patient_name }}</td>
                                    <td>{{ $invoice->appointment_id }}</td>
                                    <td>{{number_format($invoice->totalbill, 2)}}</td>
                                    <td>{{ $invoice->paymentDate }}</td>
                                    <td>{{ ucfirst($invoice->paymentMethode) }}</td>
                                    <td>{{ ucfirst($invoice->paymentStatus) }}</td>
                                    <td>
                                        @can('view', $invoice)
                                            <button class="badge-show "><a href="{{ route('invoices.show', $invoice) }}">View</a></button>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('update', $invoice)
                                            <button class="badge-update"><a href="{{ route('invoices.edit', $invoice) }}">update</a></button>
                                        @endcan
                                        @can('delete', $invoice)
                                            <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are You Sure You Want To Delete This Invoice?')" class="badge-delete">delete</button>
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