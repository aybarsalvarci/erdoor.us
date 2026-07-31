<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWhyWpcRequest extends FormRequest
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

            // Genel Bilgiler (SEO)
            'translations.*.title' => ['required', 'string', 'max:255'],
            'translations.*.slug' => ['required', 'string', 'max:255'],
            'translations.*.description' => ['nullable', 'string'],

            // Content İçeriği (Ana kapsayıcı)
            'translations.*.content' => ['nullable', 'array'],

            // 1. Kapak Bölümü (Hero Section)
            'translations.*.content.hero_section' => ['nullable', 'array'],
            'translations.*.content.hero_section.eyebrow' => ['nullable', 'string', 'max:255'],
            'translations.*.content.hero_section.link_text' => ['nullable', 'string', 'max:255'],
            'translations.*.content.hero_section.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.hero_section.description' => ['nullable', 'string'],
            'translations.*.content.hero_section.note_1' => ['nullable', 'string', 'max:255'],
            'translations.*.content.hero_section.note_2' => ['nullable', 'string', 'max:255'],
            'translations.*.content.hero_section.image' => ['nullable', 'string'], // media picker URL döner

            // 2. Giriş Bölümü (Intro Section)
            'translations.*.content.intro_section' => ['nullable', 'array'],
            'translations.*.content.intro_section.label' => ['nullable', 'string', 'max:255'],
            'translations.*.content.intro_section.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.intro_section.paragraph_1' => ['nullable', 'string'],
            'translations.*.content.intro_section.paragraph_2' => ['nullable', 'string'],

            // 3. Avantajlar (Benefits Section)
            'translations.*.content.benefits_section' => ['nullable', 'array'],
            'translations.*.content.benefits_section.label' => ['nullable', 'string', 'max:255'],
            'translations.*.content.benefits_section.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.benefits_section.description' => ['nullable', 'string'],

            // Avantaj Kartları Listesi (Repeater)
            'translations.*.content.benefits_section.cards' => ['nullable', 'array'],
            'translations.*.content.benefits_section.cards.*.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.benefits_section.cards.*.description' => ['nullable', 'string'],
            'translations.*.content.benefits_section.cards.*.icon' => ['nullable', 'string'],

            // 4. Karşılaştırma Bölümü (Comparison Section)
            'translations.*.content.comparison_section' => ['nullable', 'array'],
            'translations.*.content.comparison_section.label' => ['nullable', 'string', 'max:255'],
            'translations.*.content.comparison_section.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.comparison_section.description' => ['nullable', 'string'],
            'translations.*.content.comparison_section.quote' => ['nullable', 'string', 'max:255'],
            'translations.*.content.comparison_section.button_text' => ['nullable', 'string', 'max:255'],
            'translations.*.content.comparison_section.button_link' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'translations.*.title' => 'sayfa başlığı',
            'translations.*.slug' => 'URL (slug)',
            'translations.*.description' => 'meta açıklaması',

            'translations.*.content.hero_section.title' => 'kapak (hero) başlığı',
            'translations.*.content.hero_section.image' => 'kapak görseli',

            'translations.*.content.intro_section.title' => 'giriş başlığı',

            'translations.*.content.benefits_section.title' => 'avantajlar başlığı',
            'translations.*.content.benefits_section.cards.*.title' => 'avantaj kart başlığı',
            'translations.*.content.benefits_section.cards.*.description' => 'avantaj kart açıklaması',
            'translations.*.content.benefits_section.cards.*.icon' => 'avantaj kart görseli',

            'translations.*.content.comparison_section.title' => 'karşılaştırma alanı başlığı',
        ];
    }
}
