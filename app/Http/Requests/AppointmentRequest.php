<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'dentist_id' => 'required|exists:dentists,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:h:i',
            'appointment_cost' => 'required|numeric|min:0|regex:/^\d{1,8}(\.\d{1,2})?$/',
            'appointment_status' => 'required|in:upcoming,in-progress,completed,cancelled,rescheduled',
            'visit_type' => 'required|in:checkup,emergency,consultation,follow_up,treatment'
        ];
    }
}