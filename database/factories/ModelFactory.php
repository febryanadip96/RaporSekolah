<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->userName,
        'password' => $password ?: $password = bcrypt('secret'),
		'role'=>2,
    ];
});

$factory->define(App\Siswa::class, function ($faker) {
    return [
		'nis' =>$faker->numerify('####'),
		'nisn'=>$faker->numerify('####'),
		'jenis_kelamin'=>$faker->randomElement($array = array (0,1)),
		'tanggal_lahir'=>$faker->date($format = 'Y-m-d', $max = 'now'),
		'tempat_lahir_id'=>1,
		'alamat' =>$faker->address,
		'agama' =>$faker->randomElement($array = array (0,1,2,3,4,5)),
		'tanggal_masuk' =>\Carbon\Carbon::now(),
		'tahun_ajar_id' =>1,
		'telpon_rumah' =>$faker->phoneNumber,
		'sekolah_asal_id' =>1,
		'kelas_awal_id' =>1,
		'anak_ke' =>$faker->randomElement($array = array (1,2,3)),
		'ayah' =>$faker->name,
		'ibu' =>$faker->name,
		'wali' =>$faker->name,
		'pekerjaan_ayah_id' =>$faker->randomElement($array = array (1,3,4,5)),
		'pekerjaan_ibu_id' =>$faker->randomElement($array = array (1,2,3,4,5)),
		'pekerjaan_wali_id' =>$faker->randomElement($array = array (1,2,3,4,5)),
		'alamat_ortu'=>$faker->address,
		'alamat_wali' =>$faker->address,
		'telpon_rumah_ortu' =>$faker->phoneNumber,
		'telpon_rumah_wali' =>$faker->phoneNumber,
		'user_id' =>function () {
			return factory(App\User::class)->create([
				'role'=>3,
			])->id;
		},
    ];
});

$factory->define(App\Karyawan::class, function ($faker) {
    static $password;

    return [
		'user_id' =>function () {
			return factory(App\User::class)->create()->id;
		},
		'nik'=>$faker->numerify('####'),
		'super'=>0,
		'jenis_kelamin' =>$faker->randomElement($array = array (0,1)),
		'tanggal_lahir' =>$faker->date($format = 'Y-m-d', $max = 'now'),
		'tempat_lahir_id' =>1,
		'alamat' =>$faker->address,
		'no_telp' =>$faker->phoneNumber,
		'ijazah_id' =>$faker->randomElement($array = array (1,3,4,5,6,7,8,9,10,11,12,13,14)),
		'agama' =>$faker->randomElement($array = array (0,1,2,3,4,5)),
    ];
});
