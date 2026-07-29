<?php

namespace App\Http\Requests\Sertificate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTextRequest extends FormRequest
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
            'en' => 'nullable|array',
            'en.sertification_badge' => 'nullable|string|max:255',
            'en.sertification_title' => 'nullable|string|max:255',
            'en.sertification_description' => 'nullable|string',

            'es' => 'nullable|array',
            'es.sertification_badge' => 'nullable|string|max:255',
            'es.sertification_title' => 'nullable|string|max:255',
            'es.sertification_description' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'en.sertification_badge' => 'Sertification Badge (EN)',
            'en.sertification_title' => 'Sertification Title (EN)',
            'en.sertification_description' => 'Sertification Description (EN)',

            'es.sertification_badge' => 'Sertification Badge (ES)',
            'es.sertification_title' => 'Sertification Title (ES)',
            'es.sertification_description' => 'Sertification Description (ES)',
        ];
    }
}
