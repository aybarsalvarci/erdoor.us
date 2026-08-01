<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'keywords' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'sender_email' => 'nullable|email|max:255',
            'notification_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,ico|max:1024',
            'footer_content' => 'nullable|string',
            'footer_copyright' => 'nullable|string|max:255',
            'footer_address' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Site başlığı alanı zorunludur.',
            'description.required' => 'Site açıklaması alanı zorunludur.',
            'contact_email.email' => 'Geçerli bir iletişim e-posta adresi giriniz.',
            'logo.image' => 'Logo dosyası geçerli bir resim olmalıdır.',
            'logo.max' => 'Logo boyutu en fazla 2MB olabilir.',
            'favicon.image' => 'Favicon dosyası geçerli bir resim olmalıdır.',
            'favicon.max' => 'Favicon boyutu en fazla 1MB olabilir.',
        ];
    }
}
