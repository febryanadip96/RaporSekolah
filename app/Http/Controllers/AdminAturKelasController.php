<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\KelasBuka;
use App\DaftarKelas;
use App\Siswa;
use App\TahunAjar;
use App\Semester;
use App\SemesterSiswa;
use App\NilaiSikap;
use App\Predikat;
use App\Ekstrakulikuler;
use App\NilaiEkstrakulikuler;

class AdminAturKelasController extends Controller
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
        //
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
        $this->validate($request,[
            'siswa_id'=>'required',
            'kelas_buka_id'=>'required',
		],[
			'siswa_id.required'=>'Siswa yang diinputkan tidak valid',
			'kelas_buka_id.required'=>'Kelas yang diinputkan tidak valid',
		]);
        $daftarKelas=DaftarKelas::where('siswa_id',$request['siswa_id'])->where('kelas_buka_id',$request['kelas_buka_id'])->get();
        $kelasBuka = KelasBuka::findOrFail($request['kelas_buka_id']);
        $semesters = Semester::where('tahun_ajar_id',$kelasBuka->tahun_ajar_id)->get();
				$ekskulsWajib = Ekstrakulikuler::where('jenis',1)->get();
        if(count($daftarKelas)==0)
        {
            DaftarKelas::create([
                'siswa_id' => $request['siswa_id'],
                'kelas_buka_id' =>$request['kelas_buka_id'],
                'status_lulus' => 0,
                ]);
            foreach ($semesters as $key => $semester) {
                $semesterSiswaId=SemesterSiswa::create([
                    'siswa_id'=>$request['siswa_id'],
                    'kelas_buka_id'=>$request['kelas_buka_id'],
                    'semester_id'=>$semester->id,
                    ])->id;
                NilaiSikap::create([
                    'nilai_spiritual'=>0,
                    'nilai_sosial'=>0,
					'predikat_spiritual_id'=>$this->getNilaiPredikat(0),
	                'predikat_sosial_id'=>$this->getNilaiPredikat(0),
                    'semester_siswa_id'=>$semesterSiswaId,
                ]);
				foreach ($ekskulsWajib as $key => $ekskulWajib) {
					NilaiEkstrakulikuler::create([
						'nilai'=>0,
						'predikat_id'=>$this->getNilaiPredikat(0),
						'semester_siswa_id'=>$semesterSiswaId,
						'ekstrakulikuler_id'=>$ekskulWajib->id,
					]);
				}
            }
            return redirect(action('AdminAturKelasController@show',['id' => $request['kelas_buka_id']]))->with('error','Siswa sudah terdaftar');
        }
        return redirect(action('AdminAturKelasController@show',['id' => $request['kelas_buka_id']]))->with('status','Siswa berhasil ditambahkan');
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
        $tahunAjar = TahunAjar::findOrFail($kelasBuka->tahun_ajar_id);
        $kelasBukaTahunIni = KelasBuka::where('tahun_ajar_id', $tahunAjar->id)->pluck('id');
        $siswaException = DaftarKelas::whereIn('kelas_buka_id',$kelasBukaTahunIni)->pluck('siswa_id');
        $siswas = Siswa::whereNotIn('id',$siswaException)->get();
        return view('admin.aturkelas.show',['siswas'=>$siswas, 'kelasBuka' => $kelasBuka]);
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
    public function destroy(Request $request, $id)
    {
        $daftarKelas=DaftarKelas::findOrFail($id);
        $kelasBukaId=$daftarKelas->kelas_buka_id;
        $siswaId=$daftarKelas->siswa_id;
        $semesterSiswas = SemesterSiswa::where('siswa_id',$siswaId)->where('kelas_buka_id',$kelasBukaId)->get();
        foreach ($semesterSiswas as $key => $semesterSiswa) {
            $semesterSiswa->delete();
			$semesterSiswa->nilaiRapor()->delete();
            $semesterSiswa->nilaiSikap()->delete();
			$semesterSiswa->nilaiEkstrakulikuler()->delete();
        }
        $daftarKelas->delete();
        return redirect(action('AdminAturKelasController@show',['id' => $kelasBukaId]))->with('status','Siswa berhasil dihapus');
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
