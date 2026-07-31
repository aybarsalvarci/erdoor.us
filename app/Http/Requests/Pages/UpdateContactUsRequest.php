<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactUsRequest extends FormRequest
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

            // 2. İletişim Bilgileri (Info Section)
            'translations.*.content.info_section' => ['nullable', 'array'],
            'translations.*.content.info_section.title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.info_section.location_title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.info_section.location_text' => ['nullable', 'string', 'max:255'],
            'translations.*.content.info_section.phone_title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.info_section.phone_text' => ['nullable', 'string', 'max:255'],
            'translations.*.content.info_section.email_title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.info_section.email_text' => ['nullable', 'string', 'max:255'],
            'translations.*.content.info_section.hours_title' => ['nullable', 'string', 'max:255'],
            'translations.*.content.info_section.hours_text' => ['nullable', 'string'],
            'translations.*.content.info_section.map_query' => ['nullable', 'string'],

            // 3. İletişim Formu Ayarları (Form Section)
            'translations.*.content.form_section' => ['nullable', 'array'],
            'translations.*.content.form_section.title' => ['nullable', 'string', 'max:255'],

            'translations.*.content.form_section.name_label' => ['nullable', 'string', 'max:255'],
            'translations.*.content.form_section.name_placeholder' => ['nullable', 'string', 'max:255'],

            'translations.*.content.form_section.email_label' => ['nullable', 'string', 'max:255'],
            'translations.*.content.form_section.email_placeholder' => ['nullable', 'string', 'max:255'],

            'translations.*.content.form_section.phone_label' => ['nullable', 'string', 'max:255'],
            'translations.*.content.form_section.phone_placeholder' => ['nullable', 'string', 'max:255'],

            'translations.*.content.form_section.role_label' => ['nullable', 'string', 'max:255'],
            'translations.*.content.form_section.role_placeholder' => ['nullable', 'string', 'max:255'],

            'translations.*.content.form_section.message_label' => ['nullable', 'string', 'max:255'],
            'translations.*.content.form_section.message_placeholder' => ['nullable', 'string', 'max:255'],

            'translations.*.content.form_section.button_text' => ['nullable', 'string', 'max:255'],

            // Seçilebilir Roller Listesi (Repeater)
            'translations.*.content.form_section.role_options' => ['nullable', 'array'],
            'translations.*.content.form_section.role_options.*' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'translations.*.title' => 'sayfa başlığı',
            'translations.*.slug' => 'URL (slug)',
            'translations.*.description' => 'meta açıklaması',

            'translations.*.content.info_section.title' => 'iletişim bilgileri başlığı',
            'translations.*.content.info_section.phone_text' => 'telefon numarası',
            'translations.*.content.info_section.email_text' => 'email adresi',
            'translations.*.content.info_section.map_query' => 'harita sorgusu',

            'translations.*.content.form_section.title' => 'form başlığı',
            'translations.*.content.form_section.button_text' => 'form buton metni',

            'translations.*.content.form_section.role_options.*' => 'rol seçeneği',
        ];
    }
}
