<?php

use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('sekolahs')->insert([
				[
					'nama' => 'SD Kartika Nasional Plus',
					'negeri_swasta'=>1,
					'alamat'=>'Jl. Panjang Jiwo Permai No. 6',
				]
			]);
    }
}
