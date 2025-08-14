@extends('layouts.app')

@section('title', 'User Table')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/showTables.css') }}">
@endpush

@section('content')
    <div class="container py-4  px-4">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title mb-4 text-center">User Table</h5>
                <div class="table-responsive  dark-table">
                    <table class="table align-middle">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Permission Count</th>
                            <th scope="col">View Details</th>
                            @if($users->contains(function($user) {
                                return auth()->user()->can('update', $user)
                                    || auth()->user()->can('delete', $user);
                            }))
                                <th scope="col">Action</th>
                            @endif
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                    <td>{{ $user->permissions_count }}</td>
                                    <td>
                                        @can('view', $user)
                                            <button class="badge-show "><a href="{{ route('users.show', $user) }}">View</a></button>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('update', $user)
                                            <button class="badge-update"><a href="{{ route('users.edit', $user) }}">update</a></button>
                                        @endcan
                                        @can('delete', $user)
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are You Sure You Want To Delete This User?')" class="badge-delete">delete</button>
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