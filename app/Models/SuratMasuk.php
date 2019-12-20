<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';

    protected $fillable = [
            'unit_id',
            'pengguna_id',
            'kategori_id',
            'nomor',
            'asal',
            'perihal',
            'tanggal_surat',
            'tanggal_terima',
            'lampiran',
            'status' 
        ];

    protected $dates = [
        'tanggal_terima'
    ];

    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai');
    }
}
