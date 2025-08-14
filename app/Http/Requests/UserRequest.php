<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $userId = $this->route('user')?->id ?? null;

        return [
            'username' => [
                'required',
                'string',
                Rule::unique('users','username')->ignore($userId),
                'max:50',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users','email')->ignore($userId),
            ],
            'name' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'min:10',
                'max:20',
                Rule::unique('users','phone')->ignore($userId),
            ],
            'gender' => 'required|in:Male,Female',
            'role' => 'required|exists:roles,name',
            'permissions' => ['nullable','array'],
            'permissions.*' => ['exists:permissions,name'],
            'specialty' => [
                Rule::requiredIf($this->input('role') === 'dentist'),
                'nullable',
                'string',
            ],
            'years_of_experience' => [
                Rule::requiredIf($this->input('role') === 'dentist'),
                'nullable',
                'integer',
                'min:0',
                'max:50'
            ],
        ];
    }
}
