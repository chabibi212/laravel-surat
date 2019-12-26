<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';

    protected $fillable = [
            'unit_id',
            'tahap_id',
            'kategori_id',
            'nomor',
            'asal',
            'perihal',
            'tanggal_surat',
            'tanggal_terima',
            'lampiran',
            'status' ,
            'pengguna_id',
            'tahap_id',
        ];

    protected $dates = [
        'tanggal_terima'
    ];

    public function Unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }
    
    public function Tahap()
    {
        return $this->belongsTo('App\Models\Tahap');
    }

    public function Kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}
