<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\SemesterSiswa;
use App\IdentitasSekolah;
use App\DaftarKelas;
use App\Kelompok;
use App\User;
use App\Predikat;
use App\Kelas;

class GuruCetakRaporController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guru');
    }

    public function tengah($semesterSiswaId){
        $semesterSiswa = SemesterSiswa::findOrFail($semesterSiswaId);
        $kelompoks = Kelompok::all();
		$sekolah=IdentitasSekolah::findOrFail(1);
        //tanggal sekarang
        Carbon::setLocale('id');
        $tanggalHariIni=Carbon::now(+7)->format('d F Y');;
        return view('guru.walikelas.raportengahsemester',['sekolah'=>$sekolah,'semesterSiswa'=>$semesterSiswa,'kelompoks'=>$kelompoks,'tanggalHariIni'=>$tanggalHariIni]);
    }

    public function akhir($semesterSiswaId){
        $semesterSiswa=SemesterSiswa::findOrFail($semesterSiswaId);
        $statusKelulusan="";
		$sekolah=IdentitasSekolah::findOrFail(1);
        if($semesterSiswa->semester->gasal_genap==2){
            //dapatkan status lulus
            $daftarKelas=DaftarKelas::where('siswa_id',$semesterSiswa->siswa->id)->where('kelas_buka_id',$semesterSiswa->kelasBuka->id)->first();
			if($daftarKelas->status_lulus){
				if(!empty(Kelas::where('tingkat',($daftarKelas->kelasBuka->kelas->tingkat+1))->first())){
 					$statusKelulusan.="Berdasar hasil perolehan nilai semester 1 dan semester 2, siswa dinyatakan NAIK KE KELAS ".($daftarKelas->kelasBuka->kelas->tingkat+1);
 				}
 				else{
 					$statusKelulusan.="Berdasar hasil perolehan nilai semester 1 dan semester 2, siswa dinyatakan LULUS";
				}
			}
			else{
				$statusKelulusan.="Berdasar hasil perolehan nilai semester 1 dan semester 2, siswa dinyatakan TINGGAL DI KELAS ".($daftarKelas->kelasBuka->kelas->tingkat);
			}
        }
        //kepala sekolah
        $kepalaSekolah = User::where('role',1)->first();
        $kelompoks = Kelompok::all();
        //tanggal sekarang
        Carbon::setLocale('id');
        $tanggalHariIni=Carbon::now(+7)->format('d F Y');
        return view('guru.walikelas.raporakhirsemester',['sekolah'=>$sekolah,'semesterSiswa'=>$semesterSiswa,'kelompoks'=>$kelompoks,'tanggalHariIni'=>$tanggalHariIni,'kepalaSekolah'=>$kepalaSekolah,'statusKelulusan'=>$statusKelulusan]);
    }

	private function getNilaiPredikat($nilai)
    {
        $predikats = Predikat::all();
        foreach ($predikats as $key => $predikat) {
            if($predikat->nilai_awal<=floor($nilai) && $predikat->nilai_akhir>=floor($nilai)){
                return $predikat->id;
            }
        }
    }
}
