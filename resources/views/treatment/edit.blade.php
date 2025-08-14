@extends('layouts.app')

@section('title', 'Edit Treatment')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/add_form.css') }}" />
@endpush

@section('content')
    <main>
        <div class="form-card">
            <div class="form-header">
                <i class="fas fa-tooth dental-icon"></i>
                <h1>Edit Treatment</h1>
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

            <form action="{{ route('treatments.update', $treatment->id) }}" method="POST" class="form-container">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="related-appointment" class="required">Related Appointment:</label>
                            <select id="related-appointment" name="appointment_id" required>
                                <option value="">Select...</option>
                                @foreach($appointments as $appointment)
                                    <option value="{{ $appointment->id }}" {{ old('appointment_id', $treatment->appointment_id) == $appointment->id ? 'selected' : '' }}>
                                        {{ $appointment->id }}- {{ $appointment->patient->patient_name }} with Dr. {{ $appointment->dentist->user->name }} Date: ({{ $appointment->appointment_date }})
                                    </option>
                                @endforeach
                            </select>
                            @error('appointment_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="reg-date" class="required">Treatment Date:</label>
                            <input type="date" name="treatment_date" id="reg-date" value="{{ old('treatment_date', $treatment->treatment_date) }}" required>
                            @error('treatment_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="form-group">
                            <label for="cost" class="required">Treatment Cost:</label>
                            <input type="number" name="treatment_cost" step="0.01" min="0" required id="cost" value="{{ old('treatment_cost', $treatment->treatment_cost) }}" required>
                            @error('treatment_cost')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="treatment" class="required">Treatment Procedure:</label>
                            <input type="text" name="treatment_procedure" id="treatment" value="{{ old('treatment_procedure', $treatment->treatment_procedure) }}" maxlength="300" placeholder="Enter Treatment Procedure.." required>
                            @error('treatment_procedure')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="form-group">
                            <label for="related-TreatmentStatus" class="required">Treatment Status:</label>
                            <select name="treatment_status" id="related-TreatmentStatus" required>
                                <option value="">Select...</option>
                                @foreach(['pending','in_progress','completed','cancelled','postponed'] as $status)
                                <option value="{{ $status }}" {{ old('treatment_status', $treatment) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            @error('treatment_status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="form-group">
                            <label for="related-TreatmentType" class="required">Treatment Type:</label>
                            <select name="treatment_type" id="related-TreatmentType">
                                <option value="">Select...</option>
                                @foreach(['Restorative','Endodontics','Periodontics','Oral_Surgery','Orthodontics'] as $type)
                                <option value="{{ $type }}" {{ old('treatment_type', $treatment) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('treatment_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Update</button>
            </form>
        </div>
    </main>
@endsection