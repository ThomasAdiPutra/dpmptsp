<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required|same:new_password',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
            'new_password_confirmation.same' => 'Password dan Konfirmasi Password beda',
        ];
    }

    public function attributes()
    {
        return [
            'old_password' => 'Password lama',
            'new_password' => 'Password Baru',
            'new_password_confirmation' => 'Konfirmasi Password Baru',
        ];
    }
}
