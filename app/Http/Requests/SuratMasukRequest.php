<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratMasukRequest extends FormRequest
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
            'asal' => 'required',
            'perihal' => 'required',
            'kategori_id' => 'required',
            'tahap_id' => 'required',
            'tanggal_surat' => 'required',
            'tanggal_terima' => 'required',
            'lampiran' => 'mimes:pdf'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'asal.required' => 'Asal perlu diisi!',
            'kategori_id.required' => 'Pilih salah satu tujuan kategori!',
            'perihal.required' => 'Perihal perlu diisi!',
            'tahap_id.required' => 'Pilih salah satu Tahap!',

            'tanggal_surat.required' => 'Tanggal surat perlu diisi!',
            'tanggal_terima.required' => 'Tanggal terima perlu diisi!',
            'lampiran.mimes' => 'Format lampiran harus berformat: pdf!'
        ];
    }
}
