<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'email' => 'required|email',
            'no_hp' => 'required|digits_between:9,15',
            'whatsapp' => 'required|digits_between:9,15',
            'facebook' => 'required|url',
            'instagram' => 'required|url',
            'youtube' => 'required|url',
            'alamat' => 'required',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
            '*.digit_between' => ':attribute harus memiliki panjang 9 sampai 15 digit',
            '*.url' => 'Link :attribute tidak valid',
            '*.numeric' => ':attribute tidak valid',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
            'no_hp' => 'No HP',
            'whatsapp' => 'Whatsapp',
            'facebook' => 'Facebook',
            'instagram' => 'instagram',
            'youtube' => 'Youtube',
            'alamat' => 'Alamat',
            'lat' => 'Latitude',
            'lon' => 'Longitude'
        ];
    }
}
