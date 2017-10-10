<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KelasBuka;
use App\Semester;
use App\SemesterSiswa;
use App\MapelBuka;
use App\NilaiRapor;
use App\Ketidakhadiran;
use App\NilaiSikap;
use App\Predikat;
use App\Ekstrakulikuler;
use App\NilaiEkstrakulikuler;
use App\DaftarKelas;

class AdminAturKelulusan extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('kepalasekolah');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$semester=Semester::where('status',1)->firstOrFail();
		$tahunAjarAktif = $semester->tahunAjar;
		$kelasBukas = KelasBuka::orderBy('id', 'DESC')->where('tahun_ajar_id',$tahunAjarAktif->id)->get();
		return view('admin.aturkelulusan.index',['kelasBukas'=>$kelasBukas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelasBuka = KelasBuka::findOrFail($id);
		$semesterAktif = Semester::where('status',1)->firstOrFail();
		//cek semester aktif harus genap
        if($semesterAktif->gasal_genap==2){
			return view('admin.aturkelulusan.show',['kelasBuka'=>$kelasBuka]);
        }
        else{
            return redirect(action('AdminAturKelulusan@index'))->with('status','Semester saat ini bukan semester genap');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

	public function proses($id){
		$kelasBuka = KelasBuka::findOrFail($id);
		$semesterAktif = Semester::where('status',1)->firstOrFail();
		//cek semester aktif harus genap
        if($semesterAktif->gasal_genap==2){
			$semesterSiswas = SemesterSiswa::where('kelas_buka_id',$kelasBuka->id)->where('semester_id',$semesterAktif->id)->get();
			foreach ($semesterSiswas as $key => $semesterSiswa) {
				$daftarKelas=DaftarKelas::where('siswa_id',$semesterSiswa->siswa->id)->where('kelas_buka_id',$semesterSiswa->kelasBuka->id)->first();
	            //tentukan keluluran
				//inisialisasi variabel
	            $lulus=true;
				$banyakMataPelajaran=0;
	            $nilaiPengetahuanBawahKkm=0;
	            $nilaiKetrampilanBawahKkm=0;
	            $batasKetidakhadiran = $semesterSiswa->semester->tahunAjar->total_hari_efektif*15/100;//batas ketidakhadiran

				//total mata pelajaran yang diambil
				$banyakMataPelajaran=$semesterSiswa->nilaiRapor->count();

	            //cek minimal 3 mata pelajaran di bawah kkm
	            $siswa=$semesterSiswa->siswa;
	            $semestersTahunAjar= $semesterSiswa->semester->tahunAjar->semester->pluck('id');
	            //mendapatakan kedua semesternya
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

				//tentukan kelulusan
				if($lulus){
					$daftarKelas->status_lulus=1;
				}
				else{
					$daftarKelas->status_lulus=0;
				}
				$daftarKelas->save();
			}
			return back()->with('status','Proses Kelulusan telah dilakukan');
        }
        else{
            return redirect(action('AdminAturKelulusan@index'))->with('status','Semester saat ini bukan semester genap');
        }
	}

	public function lulustidak($id)
	{
		$daftarKelas = DaftarKelas::findOrFail($id);
		if($daftarKelas->status_lulus){
			$daftarKelas->status_lulus=0;
		}
		else{
			$daftarKelas->status_lulus=1;
		}
		$daftarKelas->save();
		return back();
	}

	public function lihat($id)
	{
		$daftarKelas=DaftarKelas::findOrFail($id);
		$semesterAktif = Semester::where('status',1)->firstOrFail();
		$semesterSiswa=SemesterSiswa::where('semester_id',$semesterAktif->id)->where('kelas_buka_id',$daftarKelas->kelasBuka->id)->where('siswa_id',$daftarKelas->siswa->id)->firstOrFail();
        if($semesterAktif->gasal_genap==2){
            //tentukan keluluran
			//inisialisasi variabel
            $lulus=true;
			$banyakMataPelajaran=0;
            $nilaiPengetahuanBawahKkm=0;
            $nilaiKetrampilanBawahKkm=0;
            $batasKetidakhadiran = $semesterSiswa->semester->tahunAjar->total_hari_efektif*15/100;//batas ketidakhadiran

			//total mata pelajaran yang diambil
			$banyakMataPelajaran=$semesterSiswa->nilaiRapor->count();

            //cek minimal 3 mata pelajaran di bawah kkm
            $siswa=$semesterSiswa->siswa;
            $semestersTahunAjar= $semesterSiswa->semester->tahunAjar->semester->pluck('id');
            //mendapatakan kedua semesternya
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
				$saran ="Siswa harus tinggal kelas";
			}

			//return value
            return view('admin.aturkelulusan.lihatdata',[
				'banyakMataPelajaran'=>$banyakMataPelajaran,
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
			return back()->with('status','Semester bukan semester genap');
		}
	}

	public function ubahKelulusan(Request $request, $id){
        $daftarKelas=DaftarKelas::findOrFail($id);
        $daftarKelas->status_lulus=$request['lulus'];
        $daftarKelas->save();
        return redirect(action('AdminAturKelulusan@lihat',['id'=>$id]))->with('status','Data Kelulusan telah diperbarui');
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
