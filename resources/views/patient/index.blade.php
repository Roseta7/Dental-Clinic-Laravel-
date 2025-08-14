@extends('layouts.app')

@section('title','Patients Table')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/showTables.css') }}">
@endpush

@section('content')
    <div class="container py-4">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title text-center mb-4 ">Patients </h5>

                <div class="table-responsive dark-table">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Birth Date</th>
                                <th scope="col">View Details</th>
                                @if($patients->contains(function($patient) {
                                    return auth()->user()->can('update', $patient)
                                        || auth()->user()->can('delete', $patient);
                                }))
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                                <tr>
                                    <td>{{ $patient->id }}</td>
                                    <td>{{ $patient->patient_name }}</td>
                                    <td>{{ $patient->patient_gender }}</td>
                                    <td>{{ $patient->patient_email }}</td>
                                    <td>{{ $patient->patient_phone }}</td>
                                    <td>{{ $patient->date_of_birth }}</td>
                                    <td>
                                        @can('view', $patient)
                                            <button class="badge-show "><a href="{{ route('patients.show', $patient) }}">View</a></button>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('update', $patient)
                                            <button class="badge-update"><a href="{{ route('patients.edit', $patient) }}">update</a></button>
                                        @endcan
                                        @can('delete', $patient)
                                            <form action="{{ route('patients.destroy', $patient) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are You Sure You Want To Delete This Patient?')" class="badge-delete">delete</button>
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