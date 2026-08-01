<?php

namespace App\Http\Requests\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
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
            'image_id' => 'required|integer',

            'en'       => 'required|array',
            'en.title' => 'required|string|max:255',

            'es'       => 'required|array',
            'es.title' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'image_id.required' => 'Lütfen galeride gösterilecek bir görsel seçiniz.',
            'image_id.integer'  => 'Seçilen görsel formatı geçersiz.',

            'en.title.required' => 'Görselin İngilizce başlığı zorunludur.',
            'en.title.max'      => 'İngilizce başlık en fazla 255 karakter olabilir.',

            'es.title.max'      => 'İspanyolca başlık en fazla 255 karakter olabilir.',
        ];
    }
}
