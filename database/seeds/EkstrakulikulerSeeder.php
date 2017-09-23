<?php

use Illuminate\Database\Seeder;

class EkstrakulikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('ekstrakulikulers')->insert([
				[
					'nama' => 'Pramuka',
					'jenis'=>1,
				],[
					'nama' => 'Science Club',
					'jenis'=>0,
				],[
					'nama' => 'Matematic Club',
					'jenis'=>0,
				]
			]);
    }
}
