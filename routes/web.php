<?php

use App\Semester;
use App\Siswa;
use App\Karyawan;
use App\KelasBuka;
use App\MapelBuka;
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
	$semesterAktif = Semester::where('status',1)->first();
	if(!$semesterAktif){
		$semesterAktif = null;
		$jumlahSiswa = "Tidak Ada";
		$jumlahKaryawan = "Tidak Ada";
		$kelasBukas = "Tidak Ada";
		$jumlahKelasBuka = "Tidak Ada";
		$jumlahMapelBuka = "Tidak Ada";
		return view('admin.home',['semesterAktif'=>$semesterAktif,'jumlahSiswa'=>$jumlahSiswa,'jumlahKaryawan'=>$jumlahKaryawan,'jumlahKelasBuka'=>$jumlahKelasBuka,'jumlahMapelBuka'=>$jumlahMapelBuka]);
	}
	$jumlahSiswa = Siswa::all()->count();
	$jumlahKaryawan = Karyawan::all()->count();
	$kelasBukas = KelasBuka::where('tahun_ajar_id', $semesterAktif->tahunAjar->id)->get();
	$jumlahKelasBuka = $kelasBukas->count();
	$jumlahMapelBuka = MapelBuka::whereIn('kelas_buka_id',$kelasBukas->pluck('id'))->get()->count();
	return view('admin.home',['semesterAktif'=>$semesterAktif,'jumlahSiswa'=>$jumlahSiswa,'jumlahKaryawan'=>$jumlahKaryawan,'jumlahKelasBuka'=>$jumlahKelasBuka,'jumlahMapelBuka'=>$jumlahMapelBuka]);
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
//atur kelulusan
Route::resource('admin/aturkelulusan', 'AdminAturKelulusan');
Route::get('admin/aturkelulusan/lihat/{id}','AdminAturKelulusan@lihat');
Route::get('admin/aturkelulusan/proses/{id}','AdminAturKelulusan@proses');
Route::post('admin/aturkelulusan/ubahkelulusan/{id}','AdminAturKelulusan@ubahKelulusan');
Route::get('admin/aturkelulusan/lulustidak/{id}','AdminAturKelulusan@lulustidak');
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
	$karyawanId = Auth::user()->karyawan->id;
	//cari semester aktif
	$semesterAktif =Semester::where('status', 1)->first();
	if(empty($semesterAktif))
	{
		$kelasWaliKelas=null;
		$jumlahMapelBuka="Tidak Ada";
		return view('guru.home',['kelasWaliKelas'=>$kelasWaliKelas,'jumlahMapelBuka'=>$jumlahMapelBuka]);
	}
	//cari kelas yang diwalikelas tahun ajar ini
	$kelasWaliKelas= KelasBuka::where('tahun_ajar_id',$semesterAktif->tahunAjar->id)->where('wali_kelas_id',$karyawanId)->first();
	if(empty($kelasWaliKelas))
	{
		$kelasWaliKelas=null;
	}
	$kelasBukasId= KelasBuka::where('tahun_ajar_id',$semesterAktif->tahunAjar->id)->pluck('id');
	$jumlahMapelBuka = MapelBuka::where('pengajar_id', $karyawanId)->whereIn('kelas_buka_id',$kelasBukasId)->get()->count();
	return view('guru.home',['kelasWaliKelas'=>$kelasWaliKelas,'jumlahMapelBuka'=>$jumlahMapelBuka]);
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
