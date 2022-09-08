<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
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
            'form' => 'required|mimes:pdf,doc,docx,rtf,xls,xlsx,txt',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama file harus diisi',
            'form.required' => 'Berkas harus diisi',
            'form.mimes' => 'Berkas harus pdf,doc,docx,rtf,xls,xlsx, atau txt',
        ];
    }
}
