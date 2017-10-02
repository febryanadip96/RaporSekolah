<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SemesterSiswa;
use App\Kelompok;
use Carbon\Carbon;
use App\User;
use App\MapelBuka;
use App\NilaiRapor;
use App\Ketidakhadiran;
use App\NilaiSikap;
use App\DaftarKelas;
use App\IdentitasSekolah;
use App\NilaiEkstrakulikuler;
use App\Ekstrakulikuler;
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
        $kepalaSekolah = User::where('role',2)->first();
        $kelompoks = Kelompok::all();
        //tanggal sekarang
        Carbon::setLocale('id');
        $tanggalHariIni=Carbon::now(+7)->format('d F Y');
        return view('guru.walikelas.raporakhirsemester',['sekolah'=>$sekolah,'semesterSiswa'=>$semesterSiswa,'kelompoks'=>$kelompoks,'tanggalHariIni'=>$tanggalHariIni,'kepalaSekolah'=>$kepalaSekolah,'statusKelulusan'=>$statusKelulusan]);
    }

    public function aturKelulusan($semesterSiswaId){
        $semesterSiswa=SemesterSiswa::findOrFail($semesterSiswaId);
        $daftarKelas=DaftarKelas::where('siswa_id',$semesterSiswa->siswa->id)->where('kelas_buka_id',$semesterSiswa->kelasBuka->id)->first();
        if($semesterSiswa->semester->gasal_genap==2){
            //tentukan keluluran
			//inisialisasi variabel
            $lulus=true;
            $nilaiPengetahuanBawahKkm=0;
            $nilaiKetrampilanBawahKkm=0;
            $batasKetidakhadiran = $semesterSiswa->semester->tahunAjar->total_hari_efektif*15/100;//batas ketidakhadiran

            //cek minimal 3 mata pelajaran di bawah kkm
            $siswa=$semesterSiswa->siswa;
            $semestersTahunAjar= $semesterSiswa->semester->tahunAjar->semester->pluck('id');
            //mendapatakan semester gasalnya
            $semesterSiswas=SemesterSiswa::where('siswa_id',$siswa->id)->whereIn('semester_id',$semestersTahunAjar)->pluck('id');
            $mapelBukas=MapelBuka::where('kelas_buka_id',$semesterSiswa->kelasBuka->id)->get();
            foreach ($mapelBukas as $key => $mapelBuka) {
              $nilaiRaporPengetahuanRata=NilaiRapor::where('mapel_buka_id',$mapelBuka->id)->whereIn('semester_siswa_id',$semesterSiswas)->avg('nilai_pengetahuan');
              if($nilaiRaporPengetahuanRata!=null){
                if($nilaiRaporPengetahuanRata<$mapelBuka->kkm){
                	$nilaiPengetahuanBawahKkm++;
                }
              }
              $nilaiRaporKetrampilanRata=NilaiRapor::where('mapel_buka_id',$mapelBuka->id)->whereIn('semester_siswa_id',$semesterSiswas)->avg('nilai_ketrampilan');
              if($nilaiRaporKetrampilanRata!=null){
                if($nilaiRaporKetrampilanRata<$mapelBuka->kkm){
                  $nilaiKetrampilanBawahKkm++;
                }
              }
            }

			if($nilaiPengetahuanBawahKkm>3){
              $lulus=false;
            }
            if($nilaiKetrampilanBawahKkm>3){
              $lulus=false;
            }

            //tanpa keterangan
            $tanpaKeterangans=Ketidakhadiran::whereIn('semester_siswa_id',$semesterSiswas)->where('status',2)->count();
            if($tanpaKeterangans>$batasKetidakhadiran){
              $lulus=false;
            }

            //nilai sikap
			$keteranganNilaiSikapSpiritual="";
			$keteranganNilaiSikapSosial="";

            $nilaiSikapSpiritual=NilaiSikap::whereIn('semester_siswa_id',$semesterSiswas)->avg('nilai_spiritual');
			$predikatSikapSpiritual = Predikat::findOrFail($this->getNilaiPredikat($nilaiSikapSpiritual));
            $nilaiSikapSosial=NilaiSikap::whereIn('semester_siswa_id',$semesterSiswas)->avg('nilai_sosial');
			$predikatSikapSosial = Predikat::findOrFail($this->getNilaiPredikat($nilaiSikapSosial));

			if(!$predikatSikapSpiritual->lulus_ki1_ki2){
				$lulus=false;
				$keteranganNilaiSikapSpiritual=$predikatSikapSpiritual->predikat_ki1_ki2.' (Tidak Lulus)';
			}
			else{
				$keteranganNilaiSikapSpiritual=$predikatSikapSpiritual->predikat_ki1_ki2.' (Lulus)';
			}
            if(!$predikatSikapSosial->lulus_ki1_ki2){
              	$lulus=false;
				$keteranganNilaiSikapSosial=$predikatSikapSosial->predikat_ki1_ki2.' (Tidak Lulus)';
			}
			else{
				$keteranganNilaiSikapSosial=$predikatSikapSosial->predikat_ki1_ki2.' (Lulus)';
			}

			//ekskul wajib
			$ekskulsWajib=Ekstrakulikuler::where('jenis',1)->get();
			$keteranganEkskul="";
			foreach ($ekskulsWajib as $key => $ekskulWajib) {
				$nilaiEkskul = NilaiEkstrakulikuler::whereIn('semester_siswa_id',$semesterSiswas)->where('ekstrakulikuler_id',$ekskulWajib->id)->avg('nilai');
				$predikatEkskul = Predikat::findOrFail($this->getNilaiPredikat($nilaiEkskul));
				if(!$predikatEkskul->lulus_ki1_ki2){
					$lulus=false;
					$keteranganEkskul.=$ekskulWajib->nama." ".$predikatEkskul->predikat_ki1_ki2." (Tidak Lulus)\n";
				}
				else{
					$keteranganEkskul.=$ekskulWajib->nama." ".$predikatEkskul->predikat_ki1_ki2." (Lulus)\n";
				}
			}

			//saran kelulusan
			$saran = "";
			if($lulus){
				$saran="Siswa boleh dilulus";
			}
			else{
				$saran ="Siswa tidak boleh diluluskan";
			}

			//return value
            return view('guru.walikelas.aturkelulusan',[
				'semesterSiswa'=>$semesterSiswa,
	            'daftarKelas'=>$daftarKelas,
	            'tanpaKeterangans'=>$tanpaKeterangans,
	            'batasKetidakhadiran'=>$batasKetidakhadiran,
	            'nilaiPengetahuanBawahKkm'=>$nilaiPengetahuanBawahKkm,
	            'nilaiKetrampilanBawahKkm'=>$nilaiKetrampilanBawahKkm,
				'keteranganNilaiSikapSpiritual'=>$keteranganNilaiSikapSpiritual,
				'keteranganNilaiSikapSosial'=>$keteranganNilaiSikapSosial,
				'keteranganEkskul'=>$keteranganEkskul,
				'saran'=>$saran,
				'lulus'=>$lulus,
			]);
        }
        else{
            return redirect(action('GuruWaliKelasController@index'));
        }
    }

    public function ubahKelulusan(Request $request, $semesterSiswaId){
        $semesterSiswa=SemesterSiswa::findOrFail($semesterSiswaId);
        $daftarKelas=DaftarKelas::where('siswa_id',$semesterSiswa->siswa->id)->where('kelas_buka_id',$semesterSiswa->kelasBuka->id)->first();
        $daftarKelas->status_lulus=$request['lulus'];
        $daftarKelas->save();
        return redirect(action('GuruCetakRaporController@aturKelulusan',['semesterSiswaId'=>$semesterSiswaId]))->with('status','Data Kelulusan telah diperbarui');
    }

	private function getNilaiPredikat($nilai)
    {
        $predikats = Predikat::all();
        foreach ($predikats as $key => $predikat) {
            if($predikat->nilai_awal<=$nilai && $predikat->nilai_akhir>=$nilai){
                return $predikat->id;
            }
        }
    }
}
