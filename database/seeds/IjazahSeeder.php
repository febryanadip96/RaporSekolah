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
				[
        'nama' => 'D3 Teknik Sipil',],
				[
        'nama' => 'S1 Pend. Sejarah',],
				[
        'nama' => 'S1 Pend. Biologi',],
				[
        'nama' => 'S1 Pend. Bhs Inggris',],
				[
        'nama' => 'S1 Pend. Bahasa Indonesia',],
				[
        'nama' => 'S1 Pend. Matematika',],
				[
        'nama' => 'S1 Pend. PU/BP',],
				[
        'nama' => 'S1 Pend. Tarbiyah',],
				[
        'nama' => 'S2 Pendidikan',],
				[
        'nama' => 'S1 Agama',],
				[
        'nama' => 'S1 Pend. Olah Raga',],
				[
        'nama' => 'D1 (Diploma 1)',],
				[
        'nama' => 'SMA IPS',],
				[
        'nama' => 'SMA IPA',],
			]);
    }
}
