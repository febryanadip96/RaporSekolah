<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Rannu Tamunglo',
            'username' => 'kartikaadmin',
            'role' => 1,
            'password' => bcrypt('kartikaadmin1234'),
        ]);
    }
}
