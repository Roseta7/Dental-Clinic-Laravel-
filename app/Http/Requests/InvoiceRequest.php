<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'totalbill' => 'required|numeric|min:0|regex:/^\d{1,8}(\.\d{1,2})?$/',
            'paymentDate' => 'nullable|date',
            'paymentMethode' => 'nullable|in:CreditCard,PayPal,Cash',
            'paymentStatus' => 'required|in:Paid,Unpaid'
        ];
    }
}
