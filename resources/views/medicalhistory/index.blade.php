@extends('layouts.app')

@section('title', 'Medical History Table')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/showTables.css') }}">
@endpush

@section('content')
    <div class="container py-4">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title text-center mb-4 ">Medical History</h5>

                <div class="table-responsive dark-table">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Patient name</th>
                                <th scope="col">Related Treatment</th>
                                <th scope="col">Procedure Summary</th>
                                <th scope="col">Date</th>
                                <th scope="col">View details</th>
                                @if($medicalhistories->contains(function($medicalhistory) {
                                    return auth()->user()->can('update', $medicalhistory)
                                        || auth()->user()->can('delete', $medicalhistory);
                                }))
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicalhistories as $medicalhistory)
                                <tr>
                                    <td>{{ $medicalhistory->id }}</td>
                                    <td>{{ $medicalhistory->patient->patient_name }}</td>
                                    <td>{{ $medicalhistory->treatment->id }}</td>
                                    <td>{{ $medicalhistory->procedure_Summary }}</td>
                                    <td>{{ $medicalhistory->medical_treat_date }}</td>
                                    <td>
                                        @can('view', $medicalhistory)
                                            <button class="badge-show "><a href="{{ route('medicalhistories.show', $medicalhistory) }}">View</a></button>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('update', $medicalhistory)
                                            <button class="badge-update"><a href="{{ route('medicalhistories.edit', $medicalhistory) }}">update</a></button>
                                        @endcan
                                        @can('delete', $medicalhistory)
                                            <form action="{{ route('medicalhistories.destroy', $medicalhistory) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are You Sure You Want To Delete This Medical Record')" class="badge-delete">delete</button>
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