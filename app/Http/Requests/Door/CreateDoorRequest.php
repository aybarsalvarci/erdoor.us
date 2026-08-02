<?php

namespace App\Http\Requests\Door;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateDoorRequest extends FormRequest
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
            'spec_image_id' => 'required|exists:media,id',
            'media_id' => 'required|int|exists:media,id',
            'status' => 'required|boolean',

            'en' => 'required|array',
            'en.name' => 'required|string|max:255',
            'en.short_description' => 'nullable|string|max:255',
            'en.description' => 'nullable|string',
            'en.collection_name' => 'required|string|max:255',
            'en.slug' => 'required|string|max:255',

            'es' => 'nullable|array',
            'es.name' => 'nullable|string|max:255',
            'es.short_description' => 'nullable|string|max:255',
            'es.description' => 'nullable|string',
            'es.collection_name' => 'nullable|string|max:255',
            'es.slug' => 'nullable|string|max:255',
        ];
    }

    public function prepareForValidation()
    {
        $en = $this->input('en', []);
        $en['slug'] = isset($en['name']) ? str()->slug($en['name']) : null;

        $es = $this->input('es', []);
        $es['slug'] = isset($es['name']) ? str()->slug($es['name']) : null;

        $this->merge([
            "status" => $this->status == 1,
            "en" => $en,
            "es" => $es,
        ]);
    }

    public function attributes(): array
    {
        return [
            "en.name" => "Name (English)",
            "es.name" => "Name (Spanish)",
            'en.description' => 'Description (English)',
            'es.description' => 'Description (Spanish)',
            'en.collection_name' => 'Collection Name (English)',
            'es.collection_name' => 'Collection Name (Spanish)',
            'media_id' => 'Thumbnail Image',
            'spec_image_id' => 'Specification Image',
            'status' => 'Status',
        ];
    }
}
