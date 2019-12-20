<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    protected $table = 'unit';
    protected $fillable = [
        'kode',
        'nama',
        'posisi'
    ];

    static function orderByCreatedAtDesc()
    {
        $unit = unit::orderBy('created_at', 'desc');

        return $unit;
    }

    static function getunitPosisiPimpinan()
    {
        $unit = unit::where('posisi', '=', 'Pimpinan')
            ->get();

        return $unit;
    }
}
