<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';

    protected $fillable = [
            'kategori_id',
            'jenis',
            'unit_id',
            'nomor',
            'perihal',
            'tanggal_surat',
            'tanggal_terima',
            'lampiran',
            'ttd' ,
            'disposisi',
            'disposisi_telaah',
            'telaah',
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
