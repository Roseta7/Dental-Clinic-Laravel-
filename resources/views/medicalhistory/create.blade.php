@extends('layouts.app')

@section('title', 'Add New Medical History')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/add.css') }}" />
@endpush

@section('content')
    <!-- Main Content -->
    <main>
        <div class="form-card">
            <div class="form-header">
                <i class="fas fa-tooth dental-icon"></i>
                <h1>Add Medical History</h1>
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

            <form action="{{ route('medicalhistories.store') }}" method="POST" class="form-container">
                @csrf

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="treatment" class="required">Related Treatment:</label>
                            <select id="treatment" name="treatment_id" required>
                                <option value="">Select...</option>
                                @foreach($treatments as $treatment)
                                    <option value="{{ $treatment->id }}" {{ old('treatment_id') == $treatment->id ? 'selected' : '' }}>
                                        {{ $treatment->id }}- {{ $treatment->appointment->patient->patient_name }} with Dr. {{ $treatment->appointment->dentist->user->name }} On Date: ({{ $treatment->treatment_date }})
                                    </option>
                                @endforeach
                            </select>
                            @error('treatment_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="diagnosis">Diagnosis:</label>
                            <textarea id="diagnosis" name="diagnosis" rows="3" cols="50">{{ old('diagnosis') }}</textarea>
                            <br>
                            @error('diagnosis')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Treatment">Previous Treatment:</label>
                            <textarea id="Treatment" name="previous_Treatments" rows="3" cols="50">{{ old('previous_Treatments') }}</textarea>
                            <br>
                            @error('previous_Treatments')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Medication">Medications:</label>
                            <textarea id="Medication" name="medications" rows="3" cols="50">{{ old('medications') }}</textarea>
                            @error('medications')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="form-group">
                            <label for="Procedur" class="required">Procedure Summary:</label>
                            <select id="Procedur" name="procedure_Summary" data-old="{{ old('procedure_summary') }}">
                                <option value="">Select treatment first...</option>
                                @foreach($treatments as $treatment)
                                    <option value="{{ $treatment->treatment_procedure }}" {{ old('procedure_Summary') == $treatment->treatment_procedure ? 'selected' : '' }}>
                                        {{ $treatment->treatment_procedure }}
                                    </option>
                                @endforeach
                            </select>
                            @error('procedure_Summary')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-col date-field">
                        <div class="form-group">
                            <label for="reg-date" class="required"> Medical Date:</label>
                            <input type="date" name="medical_treat_date" id="reg-date" value="{{ old('medical_treat_date') }}" required>
                            @error('medical_treat_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Save</button>
            </form>
        </div>
    </main>
    @push('scripts')
        <script src="{{ asset('js/medicalhistory_form.js') }}"></script>
    @endpush
@endsection
