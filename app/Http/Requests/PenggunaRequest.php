<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenggunaRequest extends FormRequest
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
        switch($this->method()) {
            case 'POST':
                return [
                    'nip' => [
                        'required',
                        Rule::unique('pengguna')->ignore($this->id),
                    ],
                    'password' => 'required',
                    'password_confirmation' => 'required|same:password'
                ];
            case 'PUT':
                return [
                    'nip' => [
                        'required',
                        Rule::unique('pengguna')->ignore($this->id),
                    ],
                    'password_confirmation' => 'same:password'
                ];
            default:break;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nip.required' => 'nip perlu diisi!',
            'nip.unique' => 'nip sudah ada!',
            'password.required' => 'Password perlu diisi!',
            'password_confirmation.required' => 'Konfirmasi password perlu diisi!',
            'password_confirmation.same' => 'Konfirmasi password tidak sesuai!'
        ];
    }
}
