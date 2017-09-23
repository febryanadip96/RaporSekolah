<?php

use Illuminate\Database\Seeder;

class KelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('kelompoks')->insert([
				[
					'nama' => 'A',
				],[
					'nama' => 'B',
				]
			]);
    }
}
