@extends('layouts.app')

@section('title', 'Radiographs Table')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/showTables.css') }}">
@endpush

@section('content')
    <div class="container py-4">
        <div class="card card-custom">
            <div class="card-body h-">
                <h5 class="card-title text-center mb-4 ">RadioGraph</h5>
                <div class="table-responsive dark-table">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Supervising Dentist</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Appointment ID</th>
                                <th scope="col">Date Taken</th>
                                <th scope="col">Radiograph Description</th>
                                <th scope="col">View details</th>
                                @if($radiographs->contains(function($radiograph) {
                                    return auth()->user()->can('update', $radiograph)
                                        || auth()->user()->can('delete', $radiograph);
                                }))
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($radiographs as $radiograph)
                                <tr>
                                    <td>{{ $radiograph->id }}</td>
                                    <td>{{ $radiograph->dentist->user->name }}</td>
                                    <td>{{ $radiograph->patient->patient_name }}</td>
                                    <td>{{ $radiograph->appointment_id }}</td>
                                    <td>{{ $radiograph->dateTaken }}</td>
                                    <td>{{ $radiograph->imageDescription }}</td>
                                    <td>
                                        @can('view', $radiograph)
                                            <button class="badge-show "><a href="{{ route('radiographs.show', $radiograph) }}">View</a></button>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('update', $radiograph)
                                            <button class="badge-update"><a href="{{ route('radiographs.edit', $radiograph) }}">update</a></button>
                                        @endcan
                                        @can('delete', $radiograph)
                                            <form action="{{ route('radiographs.destroy', $radiograph->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are You Sure You Want To Delete This Radiography?')" class="badge-delete">delete</button>
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