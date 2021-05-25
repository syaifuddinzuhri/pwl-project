<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return [
                'car_type_id' => 'required',
                'merk' => 'required|string',
                'no_plat' => 'required|string',
                'color' => 'required|string',
                'year' => 'required|numeric',
                'price' => 'required',
                'fine' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png|max:3072',
            ];
        }

        if ($this->isMethod('PUT')) {
            return [
                'car_type_id' => 'required',
                'merk' => 'required|string',
                'no_plat' => 'required|string',
                'color' => 'required|string',
                'year' => 'required|numeric',
                'price' => 'required',
                'fine' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'car_type_id.required' => 'Tipe mobil harus diisi',
            'merk.required' => 'Merk mobil harus diisi',
            'color.required' => 'Warna mobil harus diisi',
            'no_plat.required' => 'Nomor plat mobil harus diisi',
            'year.required' => 'Tahun mobil harus diisi',
            'price.required' => 'Harga sewa mobil harus diisi',
            'fine.required' => 'Harga denda mobil harus diisi',
            'image.required' => 'Gambar mobil harus diisi',
            'image.mimes' => 'Gambar harus berupa JPG | PNG',
            'image.max' => 'Ukuran gambar maksmial 3MB',
        ];
    }
}