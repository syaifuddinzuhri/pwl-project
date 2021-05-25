<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod("POST")) {
            return [
                'name'                  => 'required|string',
                'no_ktp'                  => 'required|unique:users',
                'email'                 => 'required|email|string|unique:users',
                'phone'                 => 'required|string',
                'address'               => 'required|string',
                'gender'               => 'required|string',
                'password'              => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|min:8|string'
            ];
        }
        return [
            'name'                  => 'required|string',
            'no_ktp'                  => 'required',
            'email'                 => 'required|email|string',
            'phone'                 => 'required|string',
            'address'               => 'required|string',
            'gender'               => 'required|string',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|min:8|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required'                         => 'Nama tidak boleh kosong',
            'no_ktp.required'                         => 'Nomor KTP tidak boleh kosong',
            'email.required'                        => 'Email tidak boleh kosong',
            'email.unique'                          => 'Email sudah terdaftar',
            'email.email'                           => 'Email tidak valid',
            'no_ktp.unique'                          => 'Nomor KTP sudah terdaftar',
            'phone.required'                        => 'Nomor HP tidak boleh kosong',
            'gender.required'                        => 'Jenis kelamin tidak boleh kosong',
            'address.required'                      => 'Alamat tidak boleh kosong',
            'password.required'                     => 'Password tidak boleh kosong',
            'password.min'                          => 'Password minimal 8 karakter',
            'password.confirmed'                    => 'Password tidak sama',
            'password_confirmation.required'        => 'Konfirmasi password tidak boleh kosong',
            'password_confirmation.min'             => 'Konfirmasi password minimal 8 karakter',
        ];
    }
}