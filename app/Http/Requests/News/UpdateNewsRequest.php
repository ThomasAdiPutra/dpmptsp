<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id|numeric',
            'thumbnail' => 'image|nullable',
            'title' => 'required|string',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Kategori harus diisi',
            'category_id.exists' => 'Kategori tidak tersedia',
            'category_id.numeric' => 'Kategori tidak valid',
            'thumbnail.image' => 'Gambar tidak valid',
            'title.required' => 'Judul berita wajib diisi',
            'title.string' => 'Judul berita hanya boleh mengandung huruf dan angka',
            'content.required' => 'Isi berita wajib diisi',
        ];
    }
}
