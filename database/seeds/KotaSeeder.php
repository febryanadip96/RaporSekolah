<?php

use Illuminate\Database\Seeder;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('kotas')->insert([
				[
        'nama' => 'Surabaya',],
				[
        'nama' => 'Palembang',],
				[
        'nama' => 'Tulung Agung',],
				[
        'nama' => 'Larantuka',],
				[
        'nama' => 'Mojokerto',],
				[
        'nama' => 'Pacitan', ],
				[
        'nama' => 'Bojonegoro',],
				[
        'nama' => 'Malang',],
				[
        'nama' => 'Semarang',],
				[
        'nama' => 'Gianyar',],
				[
        'nama' => 'Banyuwangi',],
				[
        'nama' => 'Cimahi',],
				[
        'nama' => 'Sidoarjo',]
			]);
    }
}
