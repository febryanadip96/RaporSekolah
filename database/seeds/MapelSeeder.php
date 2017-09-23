<?php

use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('mata_pelajarans')->insert([
				[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Islam',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>1,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Kristen',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>1,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Katolik',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>1,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Hindu',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>1,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Budha',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>1,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Konghucu',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>1,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Islam',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>2,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Kristen',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>2,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Katolik',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>2,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Hindu',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>2,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Budha',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>2,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Konghucu',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>2,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Islam',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>3,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Kristen',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>3,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Katolik',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>3,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Hindu',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>3,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Budha',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>3,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Agama dan Budi Pekerti',
					'keterangan'=>'Konghucu',
					'jenis'=>1,
					'urutan'=>1,
					'kelas_id'=>3,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Pancasila dan Kewarganegaraan',
					'keterangan'=>'',
					'jenis'=>0,
					'urutan'=>2,
					'kelas_id'=>1,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Pancasila dan Kewarganegaraan',
					'keterangan'=>'',
					'jenis'=>0,
					'urutan'=>2,
					'kelas_id'=>2,
					'kelompok_id'=>1,
				],[
					'nama' => 'Pendidikan Pancasila dan Kewarganegaraan',
					'keterangan'=>'',
					'jenis'=>0,
					'urutan'=>2,
					'kelas_id'=>3,
					'kelompok_id'=>1,
				],[
					'nama' => 'Bahasa Indonesia',
					'keterangan'=>'',
					'jenis'=>0,
					'urutan'=>3,
					'kelas_id'=>1,
					'kelompok_id'=>1,
				],[
					'nama' => 'Bahasa Indonesia',
					'keterangan'=>'',
					'jenis'=>0,
					'urutan'=>3,
					'kelas_id'=>2,
					'kelompok_id'=>1,
				],[
					'nama' => 'Bahasa Indonesia',
					'keterangan'=>'',
					'jenis'=>0,
					'urutan'=>3,
					'kelas_id'=>3,
					'kelompok_id'=>1,
				]
			]);
    }
}
