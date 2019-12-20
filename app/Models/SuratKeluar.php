<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';

    protected $fillable = [
            'unit_id',
            'pengguna_id',
            'kategori_id',
            'nomor',
            'asal',
            'perihal',
            'tanggal_surat',
            'tanggal_kirim',
            'lampiran'
    ];

    protected $dates = [
        'tanggal_kirim'
    ];

    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan');
    }
}
