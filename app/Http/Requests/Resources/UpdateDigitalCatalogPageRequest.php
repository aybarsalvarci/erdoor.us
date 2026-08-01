<?php

namespace App\Http\Requests\Resources;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDigitalCatalogPageRequest extends FormRequest
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
            'icon' => 'nullable|string|max:100',
            'image_id' => 'nullable|integer',

            // Çeviriler Dizisi
            'translations' => 'required|array',

            // Tüm diller (en, es) için ortak kurallar
            'translations.*.title' => 'required|string|max:255',
            'translations.*.slug' => 'required|string|max:255',
            'translations.*.link_text' => 'required|string|max:255',
            'translations.*.description' => 'required|string',

            // PDF Dosyası (Eğer yükleniyorsa sadece PDF olmalı. Örn max boyut: 50MB = 51200 KB)
            'translations.*.pdf_file' => 'nullable|file|mimes:pdf|max:51200',

            // Sayfa İçeriği JSON Alanları (page_content)
            'translations.*.page_content' => 'nullable|array',
            'translations.*.page_content.pdf_url' => 'nullable|string',
            'translations.*.page_content.header_title' => 'nullable|string|max:255',
            'translations.*.page_content.back_link' => 'nullable|string|max:255',
            'translations.*.page_content.loading_text' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'translations.*.title.required' => 'Her dil için sayfa başlığı (Title) zorunludur.',
            'translations.*.slug.required' => 'Her dil için URL (Slug) zorunludur.',
            'translations.*.link_text.required' => 'Her dil için Link Metni zorunludur.',
            'translations.*.description.required' => 'Her dil için Sayfa Açıklaması zorunludur.',
            'translations.*.pdf_file.mimes' => 'Yüklediğiniz dosya sadece PDF formatında olmalıdır.',
            'translations.*.pdf_file.max' => 'Yüklediğiniz PDF dosyası en fazla 50 MB boyutunda olabilir.',
        ];
    }
}
