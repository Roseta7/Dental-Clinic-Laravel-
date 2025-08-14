@extends('layouts.app')

@section('title', 'Edit Patient')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/add_form.css') }}">
@endpush

@section('content')
    <!-- Main Content -->
    <main>
        <div class="form-card">
            <div class="form-header">
                <i class="fas fa-tooth dental-icon"></i>

                <h1>Edit Patient</h1>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Errors occurred in the entered data.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="form-container">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="username" class="required">Patient Name:</label>
                            <input type="text" id="username" name="patient_name" value="{{ old('patient_name', $patient->patient_name) }}" placeholder="Enter username">
                            @error('patient_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="required">Email:</label>
                            <input type="email" id="email" name="patient_email" value="{{ old('patient_email', $patient->patient_email) }}" placeholder="Enter email">
                            @error('patient_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-col">

                        <div class="form-group">
                            <label for="phone" class="required">Phone:</label>
                            <input type="tel" id="phone" name="patient_phone" value="{{ old('patient_phone', $patient->patient_phone) }}" placeholder="Enter phone number">
                            @error('patient_phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="required">Gender:</label>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="male" name="patient_gender" value="Male" {{ old('patient_gender', $patient->patient_gender) == 'Male' ? 'checked' : '' }}>
                                    <label for="male">Male</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="female" name="patient_gender" value="Female" {{ old('patient_gender', $patient->patient_gender) == 'Female' ? 'checked' : '' }}>
                                    <label for="female">Female</label>
                                </div>
                            </div>
                                @error('patient_gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                    <div class="form-col date-field">
                        <div class="form-group">
                            <label for="reg-date" class="required">Birth Date:</label>
                            <input type="date" id="reg-date" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth) }}">
                            @error('date_of_birth')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Update</button>
            </form>
        </div>
    </main>
@endsection