<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateUser extends FormRequest
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
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|',
            'role' => 'required|in:admin,tu,teacher',
            // nik unique but not for current user
            'nik' => 'required|unique:users,id,'.$this->user()->id,
            'address' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required|date|before:today',
            'phone_number' => 'required|digits_between:10,13|numeric',
            'gender' => 'required',
            'religion' => 'required',
            'marriage' => 'required',
            'employee_stats' => 'required',
            'employee_tier' => 'required',
            'institution' => 'required',
            'join_date' => 'required|date|before:today',
            'stop_date' => 'nullable|date|after:join_date',
        ];

        if($this->isMethod('POST')){
            $rules['password'] = 'required|min:6';
            $rules['confirmation_password'] = 'required|same:password';
            $rules['email'] .= 'unique:users,id,'.$this->user()->id;
            $rules['avatar'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'role.required' => 'Kolom role harus diisi.',
            'role.in' => 'Role tidak valid.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.mimes' => 'Format gambar tidak valid.',
            'avatar.max' => 'Gambar tidak boleh lebih dari 2MB.',
            'confirmation_password.required' => 'Kolom konfirmasi password harus diisi.',
            'confirmation_password.same' => 'Konfirmasi password tidak sama.',
            'nik.required' => 'Kolom NIK harus diisi.',
            'nik.unique' => 'NIK sudah digunakan.',
            'address.required' => 'Kolom alamat harus diisi.',
            'birth_place.required' => 'Kolom tempat lahir harus diisi.',
            'birth_date.required' => 'Kolom tanggal lahir harus diisi.',
            'birth_date.date' => 'Format tanggal lahir tidak valid.',
            'birth_date.before' => 'Tanggal lahir tidak valid.',
            'phone_number.required' => 'Kolom nomor telepon harus diisi.',
            'phone_number.digits_between' => 'Nomor telepon tidak valid.',
            'gender.required' => 'Kolom jenis kelamin harus diisi.',
            'religion.required' => 'Kolom agama harus diisi.',
            'marriage.required' => 'Kolom status pernikahan harus diisi.',
            'employee_stats.required' => 'Kolom status kepegawaian harus diisi.',
            'employee_tier.required' => 'Kolom golongan harus diisi.',
            'institution.required' => 'Kolom instansi harus diisi.',
            'join_date.required' => 'Kolom tanggal bergabung harus diisi.',
            'join_date.date' => 'Format tanggal bergabung tidak valid.',
            'join_date.before' => 'Tanggal bergabung tidak valid.',
            'stop_date.date' => 'Format tanggal berhenti tidak valid.',
            'stop_date.after' => 'Tanggal berhenti tidak valid.',
        ];
    }
}
