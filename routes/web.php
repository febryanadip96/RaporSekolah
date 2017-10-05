<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
//route home
Route::get('home', 'HomeController@index');

//admin & kepala sekolah
//home
Route::get('admin/home', function(){
	return view('admin.home');
})->middleware('kepalasekolah');
//profile admin
Route::resource('admin/profile', 'AdminProfileController');
//identitas sekolah
Route::resource('admin/identitas', 'AdminIdentitasController');
//tahun ajar
Route::resource('admin/tahunajar', 'AdminTahunAjarController');
//semester
Route::resource('admin/semester', 'AdminSemesterController');
//karyawan
Route::resource('admin/karyawan', 'AdminKaryawanController');
Route::get('admin/karyawan/keluar/{id}','AdminKaryawanController@keluar');
//siswa
Route::resource('admin/siswa', 'AdminSiswaController');
Route::get('admin/siswa/pindahkeluar/{id}','AdminSiswaController@keluarPindah');
Route::get('admin/siswa/semester/{id}','AdminSiswaController@semester');
Route::get('admin/siswa/rapor/{id}','AdminSiswaController@rapor');
//kelas
Route::resource('admin/kelas', 'AdminKelasController');
//kelas buka
Route::resource('admin/kelasbuka', 'AdminKelasBukaController');
//atur kelas buka
Route::resource('admin/aturkelas', 'AdminAturKelasController');
//kelompok mapel
Route::resource('admin/kelompok','AdminKelompokMapelController');
//mapel
Route::resource('admin/mapel','AdminMapelController');
//komptensi dasar
Route::resource('admin/kd','AdminKdController');
//mapel buka
Route::resource('admin/mapelbuka','AdminMapelBukaController');
//daftar siswa mapel
Route::resource('admin/daftarsiswamapel','AdminDaftarSiswaMapelController');
//predikat
Route::resource('admin/predikat','AdminPredikatController');
//ekskul
Route::resource('admin/ekskul','AdminEkskulController');
//peringkat
Route::resource('admin/peringkat','AdminPeringkatController');
//pekerjaan
Route::resource('admin/pekerjaan','AdminPekerjaanController');
//ijazah
Route::resource('admin/ijazah','AdminIjazahController');
//kota
Route::resource('admin/kota','AdminKotaController');
//sekolah
Route::resource('admin/sekolah','AdminSekolahController');
//siswa keluar pindah
Route::resource('admin/keluarpindah','AdminSiswaKeluarPindahController');
//guru keluar
Route::resource('admin/gurukeluar', 'AdminGuruKeluarController');




//guru
Route::get('guru/home', function(){
	return view('guru.home');
})->middleware('guru');
//mata pelajaran
Route::get('guru/matapelajaran', 'GuruMataPelajaranController@index');
//mata pelajaran show
Route::get('guru/matapelajaran/{id}', 'GuruMataPelajaranController@show');
//wali kelas
Route::get('guru/walikelas', 'GuruWaliKelasController@index');
//show nilai sikap
Route::get('guru/walikelas/nilaisikap/{id}', 'GuruNilaiSikapController@edit');
//post nilai sikap
Route::post('guru/walikelas/nilaisikap/{id}','GuruNilaiSikapController@update');
//ekstrakulikuler
Route::resource('guru/walikelas/ekstrakulikuler', 'GuruEkskulController');
//prestasi
Route::resource('guru/walikelas/prestasi','GuruPrestasiController');
//ketidakhadiran
Route::resource('guru/walikelas/ketidakhadiran', 'GuruAbsenController');
//catatan
//show catatan
Route::get('guru/walikelas/catatan/{id}', 'GuruCatatanController@edit');
//post catatan
Route::post('guru/walikelas/catatan/{id}','GuruCatatanController@update');

//cetak rapor tengah semester
Route::get('guru/walikelas/cetakraportengahsemester/{semesterSiswaId}', 'GuruCetakRaporController@tengah');
//cetak rapor akhir semester
Route::get('guru/walikelas/cetakraporakhirsemester/{semesterSiswaId}', 'GuruCetakRaporController@akhir');
//atur kelulusan
//get
Route::get('guru/walikelas/aturkelulusan/{semesterSiswaId}', 'GuruCetakRaporController@aturKelulusan');
//post
Route::post('guru/walikelas/aturkelulusan/{semesterSiswaId}', 'GuruCetakRaporController@ubahKelulusan');


//pts pas
//index berdasar mapelbuka
Route::get('guru/matapelajaran/ptspas/{id}','GuruPtsPasController@index');
//post
Route::post('guru/matapelajaran/ptspas/{mapelBukaId}','GuruPtsPasController@store');
//ulangan harian
//index berdasarkan mapelbuka
Route::get('guru/matapelajaran/uh/{id}','GuruUlanganHarianController@index');
//show nilai ulangan harian
Route::get('guru/matapelajaran/uh/{mapelBukaId}/kd/{id}','GuruUlanganHarianController@show');
//post nilai ulangan harian
Route::post('guru/matapelajaran/uh/{mapelBukaId}/kd/{id}','GuruUlanganHarianController@store');
//tugas
//index berdasarkan mapelbuka
Route::get('guru/matapelajaran/tugas/{id}','GuruTugasController@index');
//show nilai tugas
Route::get('guru/matapelajaran/tugas/{mapelBukaId}/kd/{id}','GuruTugasController@show');
//post nilai tugas
Route::post('guru/matapelajaran/tugas/{mapelBukaId}/kd/{id}','GuruTugasController@store');
//praktek
//index berdasarkan mapelbuka
Route::get('guru/matapelajaran/praktek/{id}','GuruPraktekController@index');
//show nilai praktek
Route::get('guru/matapelajaran/praktek/{mapelBukaId}/kd/{id}','GuruPraktekController@show');
//post nilai praktek
Route::post('guru/matapelajaran/praktek/{mapelBukaId}/kd/{id}','GuruPraktekController@store');
//portofolio
//index berdasarkan mapelbuka
Route::get('guru/matapelajaran/portofolio/{id}','GuruPortofolioController@index');
//show nilai portofolio
Route::get('guru/matapelajaran/portofolio/{mapelBukaId}/kd/{id}','GuruPortofolioController@show');
//post nilai portofolio
Route::post('guru/matapelajaran/portofolio/{mapelBukaId}/kd/{id}','GuruPortofolioController@store');
//proyek
//index berdasarkan mapelbuka
Route::get('guru/matapelajaran/proyek/{id}','GuruProyekController@index');
//show nilai proyek
Route::get('guru/matapelajaran/proyek/{mapelBukaId}/kd/{id}','GuruProyekController@show');
//post nilai proyek
Route::post('guru/matapelajaran/proyek/{mapelBukaId}/kd/{id}','GuruProyekController@store');
//produk
//index berdasarkan mapelbuka
Route::get('guru/matapelajaran/produk/{id}','GuruProdukController@index');
//show nilai proyek
Route::get('guru/matapelajaran/produk/{mapelBukaId}/kd/{id}','GuruProdukController@show');
//post nilai proyek
Route::post('guru/matapelajaran/produk/{mapelBukaId}/kd/{id}','GuruProdukController@store');





//siswa
Route::get('siswa/home', function(){
	return view('siswa.home');
})->middleware('siswa');
//nilai rapor
Route::get('siswa/lihatrapor/{id}','SiswaNilaiRaporController@rapor');
