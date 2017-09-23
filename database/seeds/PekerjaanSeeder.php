<?php

use Illuminate\Database\Seeder;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('pekerjaans')->insert([
				[
          'nama' => 'Tidak Ada',
        ],[
          'nama' => 'Ibu Rumah Tangga',
        ],[
          'nama' => 'Wiraswasta',
        ],[
          'nama' => 'Karyawan',
        ],[
          'nama' => 'Pegawai Negeri',
        ]
			]);
    }
}
