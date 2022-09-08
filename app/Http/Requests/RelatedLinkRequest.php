<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RelatedLinkRequest extends FormRequest
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
            'name' => 'required',
            'logo' => 'required|image',
            'link' => 'required|url',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
            'logo.image' => 'Logo harus gambar',
            'link' => 'Link tidak valid',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'logo' => 'Logo',
            'link' => 'Link'
        ];
    }
}
