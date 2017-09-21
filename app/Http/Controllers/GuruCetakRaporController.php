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
            //mendapatakan semester gasalnya
            $lulus=true;
            $nilaiPengetahuanBawahKkm=0;
            $nilaiKetrampilanBawahKkm=0;
            $batasKetidakhadiran = $semesterSiswa->semester->tahunAjar->total_hari_efektif*15/100;

            //cek minimal 3 mata pelajaran di bawah kkm
            $siswa=$semesterSiswa->siswa;
            $semestersTahunAjar= $semesterSiswa->semester->tahunAjar->semester->pluck('id');
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

            //tanpa keterangan
            $tanpaKeterangans=Ketidakhadiran::whereIn('semester_siswa_id',$semesterSiswas)->where('status',2)->count();

            //ubah status lulus
            //nilai sikap
            $nilaiSikaps=NilaiSikap::whereIn('semester_siswa_id',$semesterSiswas)->get();
            $tambahan="";
            foreach ($nilaiSikaps as $key => $nilaiSikap) {
                if(!empty($nilaiSikap->predikatSosial)){
                    if(!$nilaiSikap->predikatSosial->lulus_ki1_ki2){
                        $lulus=false;
                        $tambahan.="Terdapat nilai sikap yang tidak sesuai kriteria kelulusan";
                    }
                }
            }
            if($nilaiPengetahuanBawahKkm>3){
                $lulus=false;
            }
            if($nilaiKetrampilanBawahKkm>3){
                $lulus=false;
            }
            if($tanpaKeterangans>$batasKetidakhadiran){
                $lulus=false;
            }

            return view('guru.walikelas.aturkelulusan',['semesterSiswa'=>$semesterSiswa,
            'daftarKelas'=>$daftarKelas,
            'tanpaKeterangans'=>$tanpaKeterangans,
            'batasKetidakhadiran'=>$batasKetidakhadiran,
            'nilaiPengetahuanBawahKkm'=>$nilaiPengetahuanBawahKkm,
            'nilaiKetrampilanBawahKkm'=>$nilaiKetrampilanBawahKkm,'tambahan'=>$tambahan,'lulus'=>$lulus]);
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
}
