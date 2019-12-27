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
                    'kode' => 'BU',
                    'nama' => 'Biro Umum',
                    'posisi' => '-',
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                ],
                [
                    'kode' => 'DISPERINDAG',
                    'nama' => 'Dinas Perindustrian dan Perdagangan',
                    'posisi' => '-',
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                ],
                [
                    'kode' => 'DISPENDUK',
                    'nama' => ' Dinas Kependudukan',
                    'posisi' => '-',
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                ]
            ]);
    }
}
