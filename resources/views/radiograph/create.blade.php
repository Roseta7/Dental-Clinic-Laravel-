@extends('layouts.app')

@section('title', 'Add New Radiography')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">
@endpush

@section('content')
    <main>
        <div class="form-card">
            <div class="form-header">
                <i class="fas fa-tooth dental-icon"></i>
                <h1>Add New RadioGraph</h1>
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

            <form action="{{ route('radiographs.store') }}" method="POST" class="form-container" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="related-appointment" class="required">Related Appointment:</label>
                            <select id="related-appointment" name="appointment_id">
                                <option value="">Select...</option>
                                @foreach($appointments as $appointment)
                                    <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                        {{ $appointment->id }}- {{ $appointment->patient->patient_name }} with Dr. {{ $appointment->dentist->user->name }} Date: ({{ $appointment->appointment_date }})
                                    </option>
                                @endforeach
                            </select>
                            @error('appointment_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="form-group">
                            <label for="reg-date" class="required">RadioGraph Date:</label>
                            <input type="date" name="dateTaken" id="reg-date" value="{{ old('dateTaken') }}" required>
                            @error('dateTaken')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="form-group">
                            <label for="radiograph" class="required">RadioGraph Description:</label>
                            <input type="text" name="imageDescription" id="radiograph" value="{{ old('imageDescription') }}" placeholder="Enter RadioGraph Description..">
                            @error('imageDescription')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="form-col">
                        <div class="form-group">
                            <label for="image-upload">Upload Image:</label>
                            <div class="file-upload-container">
                                <label for="image-upload" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i> Choose Radiograph Image
                                </label>
                                <input type="file" id="image-upload" name="image" accept="image/*" required>
                            </div>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn-submit">Save</button>
            </form>
        </div>
    </main>
@endsection