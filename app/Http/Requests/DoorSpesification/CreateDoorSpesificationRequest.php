<?php

namespace App\Http\Requests\DoorSpesification;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateDoorSpesificationRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'en' => 'required|array',
            'en.name' => 'required|string|max:255',
            'en.value' => 'required|string|max:255',

            'es' => 'required|array',
            'es.name' => 'required|string|max:255',
            'es.value' => 'required|string|max:255',
            'order' => 'required|integer'
        ];
    }

    public function attributes(): array
    {
        return [
            "en.name" => "Name (En)",
            "en.value" => "Value (En)",

            "es.name" => "Name (Es)",
            "es.value" => "Value (Es)",

            "order" => "Order"
        ];
    }

}
