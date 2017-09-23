<?php

use Illuminate\Database\Seeder;

class PredikatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('predikats')->insert([
					[
					'nilai_awal' => 0,
					'nilai_akhir' => 50,
					'predikat_ki1_ki2'=> 'K',
					'predikat_ki3_ki4'=>'D',
					'lulus_ki1_ki2'=>false,],
					[
					'nilai_awal' => 51,
					'nilai_akhir' => 65,
					'predikat_ki1_ki2'=> 'C',
					'predikat_ki3_ki4'=>'C',
					'lulus_ki1_ki2'=>false,],
					[
					'nilai_awal' => 66,
					'nilai_akhir' => 80,
					'predikat_ki1_ki2'=> 'B',
					'predikat_ki3_ki4'=>'B',
					'lulus_ki1_ki2'=>true,],
					[
					'nilai_awal' => 81,
					'nilai_akhir' => 100,
					'predikat_ki1_ki2'=> 'SB',
					'predikat_ki3_ki4'=>'A',
					'lulus_ki1_ki2'=>true,]
			]);
    }
}
