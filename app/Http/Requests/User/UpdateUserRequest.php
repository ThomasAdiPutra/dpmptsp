<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user = User::where('id', $this->route('user')->id)->first();
        return [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->username.',username',
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
