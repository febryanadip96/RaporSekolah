<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(KotaSeeder::class);
        // $this->call(IdentitasSekolahSeeder::class);
        // $this->call(IjazahSeeder::class);
        // $this->call(PekerjaanSeeder::class);
        // $this->call(PredikatSeeder::class);
        // $this->call(PeringkatSeeder::class);
        // $this->call(EkstrakulikulerSeeder::class);
        $this->call(SekolahSeeder::class);
    }
}
