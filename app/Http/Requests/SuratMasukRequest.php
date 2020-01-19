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
            'unit_id' => 'required',
            'nomor' => 'required',
            'kategori_id' => 'required',
            'perihal' => 'required',
            'tanggal_surat' => 'required',
            'tanggal_terima' => 'required',
            'lampiran' => 'required|mimes:pdf'
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
            'unit_id.required' => 'Pilih salah satu unit asal!',
            'nomor.required' => 'Nomor Surat wajib diisi!',
            'kategori_id.required' => 'Pilih salah satu kategori!',
            'perihal.required' => 'Perihal perlu diisi!',
            'tanggal_surat.required' => 'Tanggal surat perlu diisi!',
            'tanggal_terima.required' => 'Tanggal terima perlu diisi!',
            'lampiran.required' => 'Lampiran perlu diisi!',
            'lampiran.mimes' => 'Format lampiran harus berformat: pdf!'
        ];
    }
}
