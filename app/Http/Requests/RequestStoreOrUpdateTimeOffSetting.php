<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateTimeOffSetting extends FormRequest
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
            'jenis_timeoff' => 'required',
            'description_timeoff' => 'required',
            'code_timeoff' => 'required',
            'durasi_timeoff' => 'required',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ":attribute harus diisi."
        ];
    }

    public function attributes()
    {
        return [
            'jenis_timeoff' => "Jenis cuti",
            'description_timeoff' => "Deskripsi jenis cuti",
            'code_timeoff' => "Kode jenis cuti",
            'durasi_timeoff' => "Durasi hari jenis cuti",
        ];
    }
}
