<?php

use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('semesters')->insert([
			[
				'tahun_ajar_id' => 1,
				'gasal_genap'=>1,
				'status'=>1,
			],
			[
				'tahun_ajar_id' => 1,
				'gasal_genap'=>2,
				'status'=>0,
			],
			[
				'tahun_ajar_id' => 2,
				'gasal_genap'=>1,
				'status'=>0,
			],
			[
				'tahun_ajar_id' => 2,
				'gasal_genap'=>2,
				'status'=>0,
			]
		]);
    }
}
