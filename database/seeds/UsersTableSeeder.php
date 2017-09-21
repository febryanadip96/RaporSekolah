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
            'name' => 'Admin Rapor SMP Kartika Nasional Plus',
            'username' => 'kartikanasionalplusadmin',
            'role' => 1,
            'password' => bcrypt('kartikanasional1234'),
        ]);
    }
}
