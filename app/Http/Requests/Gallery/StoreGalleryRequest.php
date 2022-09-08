<?php

namespace App\Http\Requests\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
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
            'title' => 'required',
            'path' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul foto wajib diisi',
            'path.required' => 'Foto wajib diisi',
            'path.image' => 'Foto tidak valid',
        ];
    }
}
