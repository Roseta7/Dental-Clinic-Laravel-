<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RadiographRequest extends FormRequest
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
        $rules = [
            'appointment_id' => 'required|exists:appointments,id',
            'dateTaken' => 'required|date|before_or_equal:today',
            'imageDescription' => 'nullable|string|max:255',            
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpeg,jpg,png,gif|max:2048'; //2MB
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'; //2MB
        }
        
        return $rules;
    }
}