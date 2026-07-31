<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarranyPageRequest extends FormRequest
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

            // PDF Dosyası ve Gizli URL Alanı
            'translations.*.pdf_file' => 'nullable|file|mimes:pdf|max:20480', // Maksimum 20 MB boyutunda PDF dosyası
            'translations.*.page_content.pdf_url' => 'nullable|string',

            // Page Content (JSON) - Metin Alanları
            'translations.*.page_content.header_title' => 'nullable|string|max:255',
            'translations.*.page_content.back_link' => 'nullable|string|max:255',
            'translations.*.page_content.loading_text' => 'nullable|string|max:255',
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
            'translations.*.pdf_file.mimes' => 'Yüklenen dosya mutlaka PDF formatında (.pdf) olmalıdır.',
            'translations.*.pdf_file.max' => 'Yüklenen PDF dosyası en fazla 20 MB boyutunda olabilir.',
        ];
    }
}
