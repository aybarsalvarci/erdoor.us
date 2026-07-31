<?php

namespace App\Http\Requests\Certificates;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificateRequest extends FormRequest
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
            'category'    => 'required|string|in:certificate,technical',
            'icon'        => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'type'        => 'nullable|string|max:255',
            'description' => 'nullable|string',

            'file'        => 'nullable|file|mimes:pdf,doc,docx|max:10240',

            'order'       => 'nullable|integer|min:0',
            'status'      => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'category.required' => 'Lütfen bir kategori seçiniz.',
            'category.in'       => 'Geçersiz bir kategori seçtiniz.',
            'icon.required'     => 'İkon sınıfı alanı zorunludur.',
            'title.required'    => 'Doküman başlığı zorunludur.',
            'file.mimes'        => 'Yüklenen dosya sadece PDF, DOC veya DOCX formatında olmalıdır.',
            'file.max'          => 'Yüklenen dosya boyutu en fazla 10 MB olabilir.',
            'status.required'   => 'Lütfen geçerli bir durum (Aktif/Pasif) seçiniz.',
        ];
    }
}
