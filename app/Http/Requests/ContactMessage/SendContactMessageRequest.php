<?php

namespace App\Http\Requests\ContactMessage;

use Illuminate\Foundation\Http\FormRequest;

class SendContactMessageRequest extends FormRequest
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
            'full_name' => 'required|string|max:50',
            'email' => 'required|email:rfc,dns|max:100',
            'phone' => [
                'required',
                'string',
                'min:10',
                'max:20',
                'regex:/^[\+\(\)\-\s\d]+$/'
            ],
            'role' => 'required|string|max:50',
            'message' => 'required|string|max:255',
        ];
    }
}
