<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required_with_all:username,job_title',
            'username' => 'required_with_all:name,job_title|unique:users,username,'.$this->user()->username.',username',
            'job_title' => 'required_with_all:name,username',
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
            '*.required_with_all' => ':attribute wajib diisi',
            'username.unique' => 'Username sudah ada',
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
