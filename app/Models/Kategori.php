<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = [
        'nama',
        
    ];

    static function orderByCreatedAtDesc()
    {
        $kategori = kategori::orderBy('created_at', 'desc');

        return $kategori;
    }
}
