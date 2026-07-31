<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutUsRequest extends FormRequest
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

            // 1. Genel Bilgiler (SEO)
            'translations.*.title' => ['required', 'string', 'max:255'],
            'translations.*.slug' => ['required', 'string', 'max:255'],
            'translations.*.description' => ['nullable', 'string'],

            // Content İçeriği (Ana kapsayıcı)
            'translations.*.content' => ['nullable', 'array'],

            // 2. Kapak Bölümü (Hero Section)
            'translations.*.content.hero_section' => ['nullable', 'array'],
            'translations.*.content.hero_section.eyebrow' => ['nullable', 'string', 'max:255'],
            'translations.*.content.hero_section.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.hero_section.description' => ['nullable', 'string'],

            // 3. Giriş Bölümü (Intro Section)
            'translations.*.content.intro_section' => ['nullable', 'array'],
            'translations.*.content.intro_section.label' => ['nullable', 'string', 'max:255'],
            'translations.*.content.intro_section.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.intro_section.paragraph_1' => ['nullable', 'string'],
            'translations.*.content.intro_section.paragraph_2' => ['nullable', 'string'],

            // Fabrika Kartları Listesi (Repeater)
            'translations.*.content.intro_section.factories' => ['nullable', 'array'],
            'translations.*.content.intro_section.factories.*.image' => ['nullable', 'string'], // URL döner
            'translations.*.content.intro_section.factories.*.country' => ['nullable', 'string', 'max:255'],
            'translations.*.content.intro_section.factories.*.type' => ['nullable', 'string', 'max:255'],

            // 4. Küresel Erişim (Global Section)
            'translations.*.content.global_section' => ['nullable', 'array'],
            'translations.*.content.global_section.label' => ['nullable', 'string', 'max:255'],
            'translations.*.content.global_section.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.global_section.button_text' => ['nullable', 'string', 'max:255'],
            'translations.*.content.global_section.button_link' => ['nullable', 'string', 'max:255'],

            // Grup Logoları Listesi (Repeater - Sadece URL listesi)
            'translations.*.content.global_section.logos' => ['nullable', 'array'],
            'translations.*.content.global_section.logos.*' => ['nullable', 'string'],

            // Metin Paragrafları Listesi (Repeater - Sadece metin listesi)
            'translations.*.content.global_section.paragraphs' => ['nullable', 'array'],
            'translations.*.content.global_section.paragraphs.*' => ['nullable', 'string'],
        ];
    }


    public function attributes(): array
    {
        return [
            'translations.*.title' => 'sayfa başlığı',
            'translations.*.slug' => 'URL (slug)',
            'translations.*.description' => 'meta açıklaması',

            'translations.*.content.hero_section.title' => 'kapak başlığı',
            'translations.*.content.hero_section.description' => 'kapak açıklaması',

            'translations.*.content.intro_section.title' => 'giriş başlığı',

            'translations.*.content.intro_section.factories.*.country' => 'fabrika ülkesi',
            'translations.*.content.intro_section.factories.*.type' => 'fabrika tesis tipi',
            'translations.*.content.intro_section.factories.*.image' => 'fabrika görseli',

            'translations.*.content.global_section.title' => 'global alan başlığı',
            'translations.*.content.global_section.logos.*' => 'grup logosu',
            'translations.*.content.global_section.paragraphs.*' => 'içerik paragrafı',
        ];
    }
}
