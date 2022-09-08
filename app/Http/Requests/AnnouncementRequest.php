<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
            'content' => 'required',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
            '*.date' => 'Tanggal tidak valid',
            '*.date_format' => ':attribute tidak sesuai format (Tahun-bulan-tanggal)',
            '*.after_or_equal' => ':attribute tidak boleh kurang dari tanggal mulai',
        ];
    }

    /**
 * Get custom attributes for validator errors.
 *
 * @return array
 */
public function attributes()
{
    return [
        'content' => 'Isi pengumuman',
        'start_date' => 'Tanggal mulai',
        'end_date' => 'Tanggal selesai'
    ];
}
}
