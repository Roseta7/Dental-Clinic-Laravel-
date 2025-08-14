@extends('layouts.app')

@section('title', 'Add New Appointment')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/add_form.css') }}">
@endpush

@section('content')
    <!-- Main Content -->
    <main>
        <div class="form-card">
            <div class="form-header">
                <i class="fas fa-tooth dental-icon"></i>
                <h1>Add New Appointment</h1>
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

            <form action="{{ route('appointments.store') }}" method="POST" class="form-container">
                @csrf

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="related-patient" class="required">Related Patient:</label>
                            <select id="related-patient" name="patient_id">
                                <option value="">Select Patient</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->patient_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="reg-date" class="required">Appointment Date:</label>
                            <input type="date" name="appointment_date" id="reg-date" value="{{ old('appointment_date') }}">
                            @error('appointment_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cost" class="required">Appointment Cost:</label>
                            <input type="number" min="0" name="appointment_cost" step="0.01" id="cost" value="{{ old('appointment_cost') }}" required>
                            @error('appointment_cost')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="form-col">

                        <div class="form-group">
                            <label for="healer-dentist" class="required">Healer Dentist:</label>
                            <select id="healer-dentist" name="dentist_id">
                                <option value="">Select Dentist</option>
                                @foreach($dentists as $dentist)
                                    <option value="{{ $dentist->id }}" {{ old('dentist_id') == $dentist->id ? 'selected' : '' }}>
                                        {{ $dentist->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dentist_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="time" class="required">Appointment Time:</label>
                            <input type="text" id="time" name="appointment_time" value="{{ old('appointment_time') }}">
                            @error('appointment_time')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="required">Attendance Status:</label>
                            <select name="appointment_status" id="status" class="required">
                                <option value="">Select Status</option>
                                @foreach(['upcoming','in-progress','completed','cancelled','rescheduled'] as $status)
                                    <option value="{{ $status }}" {{ old('appointment_status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('appointment_status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="required">Visit Type:</label>
                            <select name="visit_type" id="status" class="required">
                                <option value="">Select Status</option>
                                @foreach(['checkup','emergency','consultation','follow_up','treatment'] as $type)
                                    <option value="{{ $type }}" {{ old('visit_type') == $type ? 'selected' : '' }}>
                                        {{ ucfirst($type) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('visit_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Save</button>
            </form>
        </div>
    </main>
@endsection
    </body>
</html>