<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalHistoryRequest extends FormRequest
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
            'treatment_id' => 'required|exists:treatments,id',
            'procedure_Summary' => 'required|string|max:300',
            'diagnosis' => 'nullable|string',
            'previous_Treatments' => 'nullable|string',
            'medical_treat_date' => 'required|date|before_or_equal:today',
            'medications' => 'nullable|string|max:300'
        ];
    }
}
