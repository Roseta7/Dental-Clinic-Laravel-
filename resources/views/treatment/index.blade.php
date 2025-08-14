@extends('layouts.app')

@section('title', 'Treatments Table')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/showTables.css') }}">
@endpush

@section('content')
    <div class="container py-4">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title text-center mb-4 ">Treatment</h5>

                <div class="table-responsive  dark-table">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Healer Dentist</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Appointment ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Type</th>
                                <th scope="col">Procedure</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Status</th>
                                <th scope="col">View Details</th>
                                @if($treatments->contains(function($treatment) {
                                    return auth()->user()->can('update', $treatment)
                                        || auth()->user()->can('delete', $treatment);
                                }))
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($treatments as $treatment)
                                <tr>
                                    <td>{{ $treatment->id }}</td>
                                    <td>{{ $treatment->dentist->user->name }}</td>
                                    <td>{{ $treatment->patient->patient_name }}</td>
                                    <td>{{ $treatment->appointment_id }}</td>
                                    <td>{{ $treatment->treatment_date }}</td>
                                    <td>{{ $treatment->treatment_type }}</td>
                                    <td>{{ $treatment->treatment_procedure }}</td>
                                    <td>{{number_format($treatment->treatment_cost, 2)}}</td>
                                    <td>{{ ucfirst($treatment->treatment_status) }}</td>
                                    <td>
                                        @can('view', $treatment)
                                            <button class="badge-show "><a href="{{ route('treatments.show', $treatment) }}">View</a></button>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('update', $treatment)
                                            <button class="badge-update"><a href="{{ route('treatments.edit', $treatment) }}">update</a></button>
                                        @endcan
                                        @can('delete', $treatment)
                                            <form action="{{ route('treatments.destroy', $treatment) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are You Sure You Want To Delete This Treatment?')" class="badge-delete">delete</button>
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