<?php

use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('kelas')->insert([
				[
					'tingkat' => 7,
				],[
					'tingkat' => 8,
				],[
					'tingkat' => 9,
				]
			]);
    }
}
