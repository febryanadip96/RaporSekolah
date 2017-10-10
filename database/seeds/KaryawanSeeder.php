<?php

use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$karyawans = factory(App\Karyawan::class,25)->create();
    }
}
