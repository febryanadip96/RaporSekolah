<?php

use Illuminate\Database\Seeder;

class IjazahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ijazahs')->insert([
            'nama' => 'D3 Manajemen',
        ]);
    }
}
