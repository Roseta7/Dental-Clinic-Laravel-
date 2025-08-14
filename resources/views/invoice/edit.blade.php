@extends('layouts.app')

@section('title', 'Edit Invoice')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/add_form.css') }}">
@endpush

@section('content')
    <main>
        <div class="form-card">
            <div class="form-header">
                <i class="fas fa-tooth dental-icon"></i>
                <h1>Edit Invoice</h1>
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
            <form action="{{ route('invoices.update', $invoice) }}" method="POST" class="form-container">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <!-- Column 1 -->
                    <div class="form-col">
                        <div class="form-group">
                            <label for="appointment" class="required">Related Appointment:</label>
                            <select id="appointment" name="appointment_id" required>
                                <option value="">-- Select Appointment --</option>
                                @foreach($appointments as $appointment)
                                    <option value="{{ $appointment->id }}" {{ old('appointment_id', $invoice->appointment_id) == $appointment->id ? 'selected' : '' }}>
                                        {{ $appointment->id }}- {{ $appointment->patient->patient_name }} with Dr. {{ $appointment->dentist->user->name }} Date: ({{ $appointment->appointment_date }})
                                    </option>
                                @endforeach
                            </select>
                            @error('appointment_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="required">Payment Status:</label>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="paid" name="paymentStatus" value="Paid" {{ old('paymentStatus', $invoice->paymentStatus) == 'Paid' ? 'checked' : '' }} />
                                    <label for="paid">Paid</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="unpaid" name="paymentStatus" value="Unpaid"  {{ old('paymentStatus', $invoice->paymentStatus) == 'Unpaid' ? 'checked' : '' }} />
                                    <label for="unpaid">Unpaid</label>
                                </div>
                            </div>
                            @error('paymentStatus')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="form-col">
                        <div class="form-group">
                            <label for="number" class="required">Total Bill:</label>
                            <input type="number" name="totalbill" id="number" step="0.01" min="0" value="{{ old('totalbill', $invoice->totalbill) }}" placeholder="Enter Total bill" />
                            @error('totalbill')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Column 3 -->
                    <div class="form-col">
                        <div class="form-group">
                            <label for="payment" class="required">Payment Date:</label>
                            <input type="datetime-local" id="payment" name="paymentDate" value="{{ old('paymentDate', $invoice->paymentDate) }}" required />
                            @error('paymentDate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="required">Payment Methode:</label>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="credit" name="paymentMethode" value="CreditCard" {{ old('paymentMethode', $invoice->paymentMethode) == 'CreditCard' ? 'checked' : '' }} />
                                    <label for="credit">Credit Card</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="cash" name="paymentMethode" value="Cash" {{ old('paymentMethode', $invoice->paymentMethode) == 'Cash' ? 'checked' : '' }} />
                                    <label for="cash">Cash</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="paypal" name="paymentMethode" value="PayPal" {{ old('paymentMethode', $invoice->paymentMethode) == 'PayPal' ? 'checked' : '' }} />
                                    <label for="paypal">PayPal</label>
                                </div>
                            </div>
                            @error('paymentMethode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn-submit">Update</button>
            </form>
        </div>
    </main>
@endsection