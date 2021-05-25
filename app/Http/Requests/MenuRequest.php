<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'icon'                  => 'required|string',
            'permission_id'         => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => 'Nama tidak boleh kosong',
            'icon.required'             => 'Icon tidak boleh kosong',
            'permission_id.required'    => 'Permission tidak boleh kosong',
        ];
    }
}
