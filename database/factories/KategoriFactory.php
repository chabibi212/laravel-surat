<?php

use App\Models\Kategori;
use Faker\Generator as Faker;

$factory->define(Kategori::class, function (Faker $faker) {
    return [
        'nama' => 'Permintaan Barang'
    ];
});
