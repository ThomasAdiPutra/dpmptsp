<?php

namespace App\Http\Requests\Skm;

use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
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
            'skm_id' => 'required|exists:skm,id',
            'skm_indicator_id' => 'required|exists:skm_indicators,id',
            'score' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'skm_id.*' => 'Periode tidak valid',
            'skm_indicator_id.*' => 'Indikator tidak valid',
            'score.required' => 'Score wajib diisi',
            'score.numeric' => 'Score harus berupa angka',
        ];
    }
}
