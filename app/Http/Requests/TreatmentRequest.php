<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreatmentRequest extends FormRequest
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
            'appointment_id' => 'required|exists:appointments,id',
            'treatment_date' => 'required|date',
            'treatment_type' => 'required|in:Restorative,Endodontics,Periodontics,Oral_Surgery,Orthodontics',
            'treatment_procedure' => 'required|string|max:300',
            'treatment_cost' => 'required|numeric|min:0|regex:/^\d{1,8}(\.\d{1,2})?$/',
            'treatment_status' => 'required|in:pending,in_progress,completed,cancelled,postponed',
        ];
    }
}
