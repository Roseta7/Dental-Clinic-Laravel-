<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
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
        $patientId = $this->route('patient')?->id ?? null;

        return [
            'patient_name' => 'required|string|max:255',
            'patient_gender' => 'required|in:Male,Female',
            'patient_phone' => [
                'required',
                'string',
                'min:10',
                'max:20',
                Rule::unique('patients','patient_phone')->ignore($patientId),
            ],
            'patient_email' => [
                'required',
                'email',
                Rule::unique('patients','patient_email')->ignore($patientId),
            ],
            'date_of_birth' => 'required|date|before:today',
        ];
    }
}
