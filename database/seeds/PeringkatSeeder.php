<?php

use Illuminate\Database\Seeder;

class PeringkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('peringkats')->insert([
				[
					'juara' => 'Juara 1',
				],[
					'juara' => 'Juara 2',
				],[
					'juara' => 'Juara 3',
				],[
					'juara' => 'Juara Harapan 1',
				],[
					'juara' => 'Juara Harapan 2',
				],[
					'juara' => 'Juara Harapan 3',
				]
			]);
    }
}
