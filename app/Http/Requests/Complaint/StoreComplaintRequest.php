<?php

namespace App\Http\Requests\Complaint;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequest extends FormRequest
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
            'name' => 'required|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email',
            'alamat' => 'required',
            'no_hp' => 'required|digits_between:9,15',
            'judul_aduan' => 'required',
            'isi_aduan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'name.regex' => 'Nama hanya boleh mengandung huruf A-Z dan Spasi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'no_hp.required' => 'No HP wajib diisi',
            'no_hp.digits_between' => 'No HP terdiri dari 9 angka sampai 15 angka',
            'judul_aduan.required' => 'Judul aduan wajib diisi',
            'isi_aduan.required' => 'Isi aduan wajib diisi'
        ];
    }
}
