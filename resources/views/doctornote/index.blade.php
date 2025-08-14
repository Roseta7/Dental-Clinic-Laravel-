@extends('layouts.app')

@section('title', 'Doctor Notes Table')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/showTables.css') }}">
@endpush

@section('content')
            <div class="container py-4">
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4 ">Doctor Notes</h5>

                        <div class="table-responsive dark-table">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Written By</th>
                                        <th scope="col">Patient</th>
                                        <th scope="col">Related Appointment</th>
                                        <th scope="col">Related Treatment</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">View details</th>
                                        @if($doctornotes->contains(function($doctornote) {
                                            return auth()->user()->can('update', $doctornote)
                                                || auth()->user()->can('delete', $doctornote);
                                        }))
                                            <th scope="col">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($doctornotes as $doctornote)
                                        <tr>
                                            <td>{{ $doctornote->id }}</td>
                                            <td>Dr. {{ $doctornote->dentist->user->name }}</td>
                                            <td>{{ $doctornote->patient->patient_name }}</td>
                                            <td>{{ $doctornote->treatment->appointment_id }}</td>
                                            <td>{{ $doctornote->treatment->id }}</td>
                                            <td>{{ $doctornote->dateCreated }}</td>
                                            <td>
                                                @can('view', $doctornote)
                                                    <button class="badge-show "><a href="{{ route('doctornotes.show', $doctornote) }}">View</a></button>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('update', $doctornote)
                                                    <button class="badge-update"><a href="{{ route('doctornotes.edit', $doctornote) }}">update</a></button>
                                                @endcan
                                                @can('delete', $doctornote)
                                                    <form action="{{ route('doctornotes.destroy', $doctornote) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are You Sure You Want To Delete This Note')" class="badge-delete">delete</button>
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
