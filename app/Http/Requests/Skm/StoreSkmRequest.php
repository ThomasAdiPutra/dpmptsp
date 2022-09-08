<?php

namespace App\Http\Requests\Skm;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkmRequest extends FormRequest
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
            'start_period' => 'required|date_format:Y-m-d',
            'end_period' => 'required|date_format:Y-m-d|after_or_equal:start_period',
            'male' => 'required|numeric|min:0',
            'female' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
            '*.date_format' => 'Format tanggal tidak valid',
            'end_period.after_or_equal' => 'Tanggal selesai periode tidak boleh kurang dari tanggal mulai periode',
            '*.numeric' => 'Jumlah peserta :attribute harus angka',
            '*.min' => 'Jumlah peserta :attribute minimal 0',
        ];
    }

    public function attributes()
    {
        return [
            'start_period' => 'Tanggal mulai periode',
            'end_period' => 'Tanggal selesai periode',
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
        ];
    }
}
