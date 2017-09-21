<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SemesterSiswa;
use App\DaftarKelas;
use App\Kelompok;

class SiswaNilaiRaporController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('siswa');
    }

	public function rapor($id){
		$semesterSiswa=SemesterSiswa::findOrFail($id);
		$statusKelulusan="";
		if($semesterSiswa->semester->gasal_genap==2){
			//dapatkan status lulus
			$daftarKelas=DaftarKelas::where('siswa_id',$semesterSiswa->siswa->id)->where('kelas_buka_id',$semesterSiswa->kelasBuka->id)->first();
			if($daftarKelas->status_lulus){
				$statusKelulusan.="Berdasar hasil perolehan nilai semester 1 dan semester 2, siswa dinyatakan LULUS";
			}
			else{
				$statusKelulusan.="Berdasar hasil perolehan nilai semester 1 dan semester 2, siswa dinyatakan TIDAK LULUS";
			}
		}
		$kelompoks = Kelompok::all();
		return view('siswa.rapor',['semesterSiswa'=>$semesterSiswa,'kelompoks'=>$kelompoks,'statusKelulusan'=>$statusKelulusan]);
	}
}
