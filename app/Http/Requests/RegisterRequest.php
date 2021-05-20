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
        return [
            'name'                  => 'required|string',
            'email'                 => 'required|email|string|unique:users',
            'phone'                 => 'required|string',
            'address'               => 'required|string',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|min:8|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required'                         => 'Nama tidak boleh kosong',
            'email.required'                        => 'Email tidak boleh kosong',
            'email.unique'                          => 'Email sudah terdaftar',
            'email.email'                           => 'Email tidak valid',
            'phone.required'                        => 'Nomor HP tidak boleh kosong',
            'address.required'                      => 'Alamat tidak boleh kosong',
            'password.required'                     => 'Password tidak boleh kosong',
            'password.min'                          => 'Password minimal 8 karakter',
            'password.confirmed'                    => 'Password tidak sama',
            'password_confirmation.required'        => 'Konfirmasi password tidak boleh kosong',
            'password_confirmation.min'             => 'Konfirmasi password minimal 8 karakter',
        ];
    }
}