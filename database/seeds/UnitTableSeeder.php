<?php

use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncateunit = DB::table('unit')
            ->truncate();

        $createunit = DB::table('unit')
            ->insert([
                [
                    'kode' => 'KADIN',
                    'nama' => 'Kepala Dinas',
                    'posisi' => 'Non-pimpinan',
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                ],
                [
                    'kode' => 'SKR',
                    'nama' => 'Sekretaris',
                    'posisi' => 'Non-pimpinan',
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                ],
                [
                    'kode' => 'KMR',
                    'nama' => 'Komisaris',
                    'posisi' => 'Pimpinan',
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                ]
            ]);
    }
}
