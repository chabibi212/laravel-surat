<?php

use Illuminate\Database\Seeder;

class TahapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tahapTruncate = DB::table('tahap')
            ->truncate();

        $tahapCreate = DB::table('tahap')
            ->insert([
            [    
                'nama' => 'Persiapan Penyusunan RPJMD'
            ],
        [
                'nama' => 'Penyusunan RPJMD'
            ]
        ]);
    }
}
