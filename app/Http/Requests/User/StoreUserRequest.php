<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'password-confirmation' => 'required|same:password',
            'job_title' => 'required',
            'image' => 'nullable|image',
            'permissions' => 'nullable|array',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
            'username.unique' => 'Username sudah ada',
            'password-confirmation.same' =>'Password dan Konfirmasi Password beda',
            'image.image' => 'Foto tidak valid',
            'permissions.array' => 'Hak akses tidak valid',
            '*.url' => 'Link :attribute tidak valid',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'username' => 'Username',
            'job_title' => 'Jabatan',
            'image' => 'Foto',
            'permissions' => 'Hak akses',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'twitter' => 'Twitter',
        ];
    }
}
