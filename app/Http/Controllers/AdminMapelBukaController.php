<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MapelBuka;
use App\MataPelajaran;
use App\KelasBuka;
use App\Semester;
use App\Karyawan;
use App\SemesterSiswa;
use App\NilaiRapor;

class AdminMapelBukaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapelbukas = MapelBuka::orderBy('id', 'DESC')->get();
        return view('admin.mapelbuka.index',['mapelbukas'=>$mapelbukas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mapels = MataPelajaran::all();
        $semesterAktif = Semester::where('status',1)->first();
        $kelasBukas = KelasBuka::where('tahun_ajar_id',$semesterAktif->tahun_ajar_id)->get();
        $karyawans=Karyawan::all();
        return view('admin.mapelbuka.create',['mapels'=>$mapels,'kelasBukas'=>$kelasBukas,'karyawans'=>$karyawans]);
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
            'mata_pelajaran_id'=>'required',
            'pengajar_id'=>'required',
            'kelas_buka_id'=>'required',
            'kkm'=>'required|numeric',
		],[
			'mata_pelajaran_id.required'=>'Mata pelajaran tidak valid',
			'pengajar_id.required'=>'Guru pengajar tidak valid',
			'kelas_buka_id.required'=>'Kelas buka tidak valid',
			'kkm.numeric'=>'KKM harus diisi angka',
		]);
        $idMapelBuka=MapelBuka::create([
            'mata_pelajaran_id'=>$request['mata_pelajaran_id'],
            'pengajar_id'=>$request['pengajar_id'],
            'kelas_buka_id'=>$request['kelas_buka_id'],
            'kkm'=>$request['kkm'],
            ])->id;
        $mapel=MataPelajaran::findOrFail($request['mata_pelajaran_id']);
        if($mapel->jenis==0)
        {
            $semesterSiswas=SemesterSiswa::where('kelas_buka_id',$request['kelas_buka_id'])->get();
            foreach ($semesterSiswas as $key => $semesterSiswa) {
                NilaiRapor::create([
                    'semester_siswa_id'=>$semesterSiswa->id,
                    'mapel_buka_id'=>$idMapelBuka,
		                'nilai_pengetahuan'=>0,
		                'nilai_ketrampilan'=>0,
		                'predikat_pengetahuan_id'=>$this->getNilaiPredikat(0),
		                'predikat_ketrampilan_id'=>$this->getNilaiPredikat(0),
                    ]);
            }
        }
        return redirect(action('AdminMapelBukaController@index'))->with('status','Mata pelajaran buka baru berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mapelBuka = MapelBuka::findOrFail($id);
        $karyawans=Karyawan::all();
        return view('admin.mapelbuka.edit',['mapelBuka'=>$mapelBuka,'karyawans'=>$karyawans]);
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
        $this->validate($request,[
            'pengajar_id'=>'required',
            'kkm'=>'required|numeric',
            ]);
        $mapelBuka=MapelBuka::findOrFail($id);
        $mapelBuka->pengajar_id=$request['pengajar_id'];
        $mapelBuka->kkm=$request['kkm'];
        $mapelBuka->save();
        return redirect(action('AdminMapelBukaController@edit',['id'=>$id]))->with('status','Mata pelajaran buka telah diperbaharui');
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
