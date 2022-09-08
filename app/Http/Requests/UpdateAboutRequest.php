<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'logo' => 'nullable|image',
            'profil' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'maklumat pelayanan' => 'nullable|string',
            'tugas pokok' => 'nullable|string',
            'fungsi' => 'nullable|string',
            'sop' => 'nullable|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'image' => 'Logo tidak valid',
            'string' => ':attribute harus berupa teks',
            'mimes:pdf' => 'SOP harus pdf'
        ];
    }
}
