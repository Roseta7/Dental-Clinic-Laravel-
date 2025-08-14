@extends('layouts.app')

@section('title', 'Add New Note')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/add.css') }}" />
@endpush

@section('content')
    <main>
        <div class="form-card">
            <div class="form-header">
                <i class="fas fa-tooth dental-icon"></i>
                <h1>Add New Note</h1>
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

            <form action="{{ route('doctornotes.store') }}" method="POST" class="form-container">
                @csrf

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="related-treatment" class="required">Related Treatment:</label>
                            <select id="related-treatment" name="treatment_id" required>
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
                    </div>

                    <div class="form-col">
                        <div class="form-group">
                            <label for="reg-date" class="required">Date Created:</label>
                            <input type="date" id="reg-date" name="dateCreated" value="{{ old('dateCreated') }}" required>
                            @error('dateCreated')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="form-group">
                            <label for="note" class="required">Note Description:</label>
                            <input type="text" id="note" name="noteDescription" value="{{ old('noteDescription') }}" placeholder="Enter Note Description.." required>
                            @error('noteDescription')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button class="btn-submit" type="submit">Save</button>
            </form>
        </div>
    </main>
@endsection