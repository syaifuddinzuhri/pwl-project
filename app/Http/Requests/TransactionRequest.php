<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'lease_date'                 => 'required',
            'return_date'                => 'required',
            'date_of_return'             => 'required',
            'proof_of_payment'           => 'required',
            'payment_status'             => 'required',
        ];
    }

    public function messages()
    {
        return [
            'lease_date.required'         => 'Tanggal sewa tidak boleh kosong',
            'return_date.required'        => 'Tanggal pengembalian tidak boleh kosong',
            'date_of_return.required'     => 'Tanggal kembali tidak boleh kosong',
            'proof_of_payment.required'   => 'Bukti pembayaran tidak boleh kosong',
            'payment_status.required'     => 'Status pembayaran tidak boleh kosong',
        ];
    }
}
