<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTechnicalCertificatesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Admin yetkisine sahip olduğumuz için formun gönderilmesine izin veriyoruz
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
            // Global Ayarlar
            'icon' => 'required|string|max:255',
            'image_id' => 'nullable|integer|exists:media,id',

            // Çeviriler Dizisi
            'translations' => 'required|array',

            // Temel SEO ve Çeviri Alanları
            'translations.*.title' => 'required|string|max:255',
            'translations.*.slug' => 'required|string|max:255',
            'translations.*.link_text' => 'required|string|max:255',
            'translations.*.description' => 'required|string',

            // Page Content (JSON) - Hero Alanı
            'translations.*.page_content.hero.back_link' => 'nullable|string|max:255',
            'translations.*.page_content.hero.eyebrow' => 'nullable|string|max:255',
            'translations.*.page_content.hero.title' => 'nullable|string', // İçinde HTML <br> olabileceği için max sınırı koymuyoruz veya geniş tutuyoruz
            'translations.*.page_content.hero.description' => 'nullable|string',

            // Page Content (JSON) - Kütüphane (Library) Alanı
            'translations.*.page_content.library.eyebrow' => 'nullable|string|max:255',
            'translations.*.page_content.library.title' => 'nullable|string|max:255',
            'translations.*.page_content.library.filter_all' => 'nullable|string|max:255',
            'translations.*.page_content.library.filter_cert' => 'nullable|string|max:255',
            'translations.*.page_content.library.filter_tech' => 'nullable|string|max:255',
            'translations.*.page_content.library.search_placeholder' => 'nullable|string|max:255',
            'translations.*.page_content.library.view_link' => 'nullable|string|max:255',
            'translations.*.page_content.library.empty_text' => 'nullable|string|max:255',

            // Page Content (JSON) - Yardım ve Destek (Help) Alanı
            'translations.*.page_content.help.eyebrow' => 'nullable|string|max:255',
            'translations.*.page_content.help.title' => 'nullable|string|max:255',
            'translations.*.page_content.help.description' => 'nullable|string',
            'translations.*.page_content.help.button_text' => 'nullable|string|max:255',
            'translations.*.page_content.help.button_link' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'icon.required' => 'Sayfa ikonu alanı zorunludur.',
            'translations.*.title.required' => 'Sayfa başlığı tüm diller için zorunludur.',
            'translations.*.slug.required' => 'URL (Slug) alanı tüm diller için zorunludur.',
            'translations.*.link_text.required' => 'Buton/Link metni tüm diller için zorunludur.',
            'translations.*.description.required' => 'Sayfa açıklaması tüm diller için zorunludur.',
        ];
    }
}
