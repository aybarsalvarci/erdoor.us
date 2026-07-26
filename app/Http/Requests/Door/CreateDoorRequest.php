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
            'en' => 'required|array',
            'en.name' => 'required|string|max:255',
            'en.description' => 'nullable|string|max:255',
            'en.collection_name' => 'required|string|max:255',
            'en.slug' => 'required|string|max:255',

            'es' => 'required|array',
            'es.name' => 'required|string|max:255',
            'es.description' => 'nullable|string|max:255',
            'es.collection_name' => 'required|string|max:255',
            'es.slug' => 'required|string|max:255',

            'media_id' => 'required|int|exists:media,id',
            'status' => 'required|boolean',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            "status" => $this->status == 1,
            "en.slug" => str()->slug($this->input('en.name')),
            "es.slug" => str()->slug($this->input('es.name')),
        ]);
    }

    public function attributes(): array
    {
        return [
            "en.name" => "Name (English)",
            "en.es" => "Name (Spanish)",
            'en.description' => 'Description (English)',
            'es.desciption' => 'Description (Spanish)',
            'media_id' => 'Thumbnail Image',
            'status' => 'Status',
        ];
    }
}
