<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomePageRequest extends FormRequest
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
            // Ana translations dizisi
            'translations' => ['required', 'array'],

            // Genel Bilgiler
            'translations.*.title' => ['required', 'string', 'max:255'],
            'translations.*.slug' => ['required', 'string', 'max:255'],
            'translations.*.description' => ['nullable', 'string'],

            // Content İçeriği (Ana kapsayıcı)
            'translations.*.content' => ['nullable', 'array'],

            // 1. Giriş Bölümü (Intro Section)
            'translations.*.content.intro_section' => ['nullable', 'array'],
            'translations.*.content.intro_section.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.intro_section.paragraph_1' => ['nullable', 'string'],
            'translations.*.content.intro_section.paragraph_2' => ['nullable', 'string'],
            'translations.*.content.intro_section.quote' => ['nullable', 'string', 'max:255'],

            // 2. Avantajlar (Benefits Section)
            'translations.*.content.benefits_section' => ['nullable', 'array'],
            'translations.*.content.benefits_section.*.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.benefits_section.*.icon' => ['nullable', 'string'], // media picker url döndürüyor
            'translations.*.content.benefits_section.*.is_featured' => ['nullable', 'in:0,1'],

            // 3. Karşılaştırma Bölümü (Comparison Section)
            'translations.*.content.comparison_section' => ['nullable', 'array'],
            'translations.*.content.comparison_section.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.comparison_section.label_1' => ['nullable', 'string', 'max:255'],
            'translations.*.content.comparison_section.label_2' => ['nullable', 'string', 'max:255'],

            // Karşılaştırma Görselleri
            'translations.*.content.comparison_section.image_1' => ['nullable', 'string'],
            'translations.*.content.comparison_section.image_2' => ['nullable', 'string'],

            // Karşılaştırma Listesi (Features)
            'translations.*.content.comparison_section.features' => ['nullable', 'array'],
            'translations.*.content.comparison_section.features.*' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'translations.*.title' => 'sayfa başlığı',
            'translations.*.slug' => 'URL (slug)',
            'translations.*.description' => 'meta açıklaması',

            'translations.*.content.intro_section.title' => 'giriş ana başlığı',
            'translations.*.content.benefits_section.*.title' => 'avantaj başlığı',
            'translations.*.content.benefits_section.*.icon' => 'avantaj görseli',

            'translations.*.content.comparison_section.image_1' => 'sol görsel (marka)',
            'translations.*.content.comparison_section.image_2' => 'sağ görsel (rakip)',
        ];
    }
}
