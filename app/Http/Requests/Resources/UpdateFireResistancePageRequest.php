<?php

namespace App\Http\Requests\Resources;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFireResistancePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Yetki kontrolünü true yapıyoruz (Admin tarafında olduğunuz için)
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
            'translations.*.page_content.hero.title' => 'nullable|string|max:255',
            'translations.*.page_content.hero.description' => 'nullable|string',

            // Page Content (JSON) - Video Alanı
            'translations.*.page_content.video.label' => 'nullable|string|max:255',
            'translations.*.page_content.video.iframe' => 'nullable|string',
            'translations.*.page_content.video.error_title' => 'nullable|string|max:255',
            'translations.*.page_content.video.error_desc' => 'nullable|string|max:255',

            // Page Content (JSON) - Notlar Alanı
            'translations.*.page_content.notes.eyebrow' => 'nullable|string|max:255',
            'translations.*.page_content.notes.title' => 'nullable|string|max:255',
            'translations.*.page_content.notes.disclaimer' => 'nullable|string',

            // Page Content (JSON) - Dinamik Adımlar (Steps) Dizisi
            'translations.*.page_content.notes.steps' => 'nullable|array',
            'translations.*.page_content.notes.steps.*.title' => 'nullable|string|max:255',
            'translations.*.page_content.notes.steps.*.description' => 'nullable|string',
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
