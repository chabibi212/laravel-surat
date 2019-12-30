<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Tahap extends Model
{
    protected $table = 'tahap';
    protected $fillable = [
        'nama',
        'jenis',
        
    ];

    static function orderByCreatedAtDesc()
    {
        $tahap = Tahap::orderBy('created_at', 'desc');

        return $tahap;
    }
}