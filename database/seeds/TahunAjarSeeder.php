<?php

use Illuminate\Database\Seeder;

class TahunAjarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('tahun_ajars')->insert([
			[
				'nama' => '2016/2017',
				'total_hari_efektif'=>333,
			],
			[
				'nama' => '2017/2018',
				'total_hari_efektif'=>335,
			]
		]);
    }
}
