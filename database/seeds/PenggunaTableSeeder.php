<?php

use Illuminate\Database\Seeder;

class PenggunaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truncatePengguna = DB::table('pengguna')
            ->truncate();

        $createPengguna = DB::table('pengguna')
            ->insert([
                [
                    'nama'=>'Admin',
                    'email'=>'-',
                    'nip'=>'A101',
                    'password' => bcrypt('secret'),
                    'unit_id' => 1,
                    'role' => 'Super Admin'
                ]
            ]);
    }
}
