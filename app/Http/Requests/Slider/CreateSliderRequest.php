<?php

namespace App\Http\Requests\Slider;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateSliderRequest extends FormRequest
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
            'media_id' => 'required|integer|exists:media,id',
            'url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->status == 1
        ]);
    }
}
