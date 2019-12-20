<?php

use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoriTruncate = DB::table('kategori')
            ->truncate();

        $kategoriCreate = DB::table('kategori')
            ->insert([
            [    
                'nama' => 'Permintaan Barang'
            ],
        [
                'nama' => 'Ijin Kirim'
            ]
        ]);
    }
}
