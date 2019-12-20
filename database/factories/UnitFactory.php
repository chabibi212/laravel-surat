<?php

use App\Models\Unit;
use Faker\Generator as Faker;

$factory->define(Unit::class, function (Faker $faker) {
    return [
        'kode' => 'KADIN',
        'nama' => 'Kepala Dinas'
    ];
});
