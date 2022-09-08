<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'icon' => 'required|starts_with:fa',
            'name' => 'required|unique:services,name',
            'description' => 'required',
            'detail' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'icon' => 'Ikon',
            'name' => 'Nama',
            'description' => 'Deskripsi singkat',
            'detail' => 'Detil',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
            'icon.starts_with' => ':attribute tidak valid',
            'name.unique' => 'Layanan sudah ada',
        ];

    }
}
