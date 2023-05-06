<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateSubmission extends FormRequest
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
            'employee_id' => 'required|numeric',
            'submission_type' => 'required|numeric',
            'start_timeoff' => 'required|date',
            'finish_timeoff' => 'required|date',
            'submission_desc' => 'required|string',
            'submission_file' => 'required|file',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'employee_id.required' => 'Kolom ini tidak boleh kosong',
            'employee_id.numeric' => 'Kolom ini harus berupa angka',
            'submission_type.required' => 'Kolom ini tidak boleh kosong',
            'submission_type.numeric' => 'Kolom ini harus berupa angka',
            'start_timeoff.required' => 'Kolom ini tidak boleh kosong',
            'start_timeoff.date' => 'Kolom ini harus berupa tanggal',
            'finish_timeoff.required' => 'Kolom ini tidak boleh kosong',
            'finish_timeoff.date' => 'Kolom ini harus berupa tanggal',
            'submission_desc.required' => 'Kolom ini tidak boleh kosong',
            'submission_desc.string' => 'Kolom ini harus berupa string',
            'submission_file.required' => 'Kolom ini tidak boleh kosong',
            'submission_file.string' => 'Kolom ini harus berupa string',
            'submission_file.file' => 'Kolom ini harus berupa file'
        ];
    }
}
