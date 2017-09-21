<?php

use Illuminate\Database\Seeder;

class IdentitasSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identitas_sekolahs')->insert([
            'nama' => 'SMP Kartika Nasional',
            'nis' => '204056021442',
            'email' => 'smpkartikanasionalplus08@yahoo.com',
            'alamat' => 'Jl. Raya Tenggilis No. 8 Surabaya',
            'kelurahan' => 'Kendangsari',
            'kecamatan' => 'Kec. Tenggilis Mejoyo',
            'kota_id' => 1,
            'provinsi' => 'Jawa Timur',
        ]);
    }
}
