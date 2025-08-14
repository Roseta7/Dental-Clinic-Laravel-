@extends('layouts.app')

@section('title', 'View User')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/viewDetails.css') }}">
@endpush

@section('content')
    <div class="container py-4 d-flex justify-content-center">
        <div class="card card-custom  ">
            <div class="card-body ">
                <h2 class="card-title mb-4 text-center">{{ $user->name }} Info</h2>
                <ul>
                    <li class="mt-2">User ID: {{ $user->id }}</li><br>
                    <li class="mt-2">Username: {{ $user->username }}</li><br>
                    <li class="mt-2">Name: {{ $user->name }}</li><br>
                    <li class="mt-2">User Role: {{ $user->roles->pluck('name')->implode(', ') }}</li><br>
                    <li class="mt-2">User Penmission: {{ $user->permissions->pluck('name')->implode(', ') }}</li><br>
                    <li class="mt-2">Email: {{ $user->email }}</li><br>
                    <li class="mt-2">User Phone: {{ $user->phone }}</li><br>
                    <li class="mt-2">User Gender: {{ $user->gender }}</li><br>
                    <li class="mt-2">Created At: {{ $user->created_at }}</li><br>
                    <li class="mt-2">Updated At: {{ $user->updated_at }}</li><br>

                    @if($user->hasRole('dentist') && $user->dentist)
                        <li class="mt-2">Specialty: {{ $user->dentist->specialty }}</li><br>
                        <li class="mt-2">Years of Experience: {{ $user->dentist->years_of_experience }}</li><br>
                    @endif
                </ul>
                
                <div class="mt-4 text-center">
                    <button class="badge-back">
                        <a href="{{ route('users.index') }}">Back</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection