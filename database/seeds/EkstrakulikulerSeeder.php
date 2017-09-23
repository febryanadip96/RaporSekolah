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
				],[
					'nama' => 'Science Club',
				],[
					'nama' => 'Matematic Club',
				]
			]);
    }
}
