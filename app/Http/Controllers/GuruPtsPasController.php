<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MapelBuka;
use App\Semester;
use App\SemesterSiswa;
use App\NilaiRapor;
use App\Predikat;

class GuruPtsPasController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $semesterAktif = Semester::where('status',1)->first();
        $mapelBuka = MapelBuka::findOrFail($id);
        $idSemesterSiswaAktifs=$semesterAktif->semesterSiswa->pluck('id');
        $nilaiRapors =NilaiRapor::whereIn('semester_siswa_id',$idSemesterSiswaAktifs)->where('mapel_buka_id',$id)->get();
        return view('guru.matapelajaran.ptspas.index',['nilaiRapors'=>$nilaiRapors,'mapelBuka'=>$mapelBuka]);
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
    public function store(Request $request, $mapelBukaId)
    {
        $nilaisPts = $request['pts'];
        $nilaisPas = $request['pas'];
        foreach ($nilaisPts as $key => $nilaiPts) {
            $nilaiRapor = NilaiRapor::findOrFail($key);
            $nilaiRapor->nilai_pts=$nilaiPts;
            $nilaiRapor->save();
        }
        foreach ($nilaisPas as $key => $nilaiPas) {
            $nilaiRapor = NilaiRapor::findOrFail($key);
            $nilaiRapor->nilai_pas=$nilaiPas;
            $nilaiRapor->nilai_pengetahuan=
            (($nilaiRapor->tugas->where('nilai','!=',null)->pluck('nilai'))->avg()+($nilaiRapor->ulanganHarian->where('nilai_akhir','!=',null)->pluck('nilai_akhir'))->avg()+$nilaiRapor->nilai_pts+$nilaiRapor->nilai_pas)/4;
            $nilaiRapor->predikat_pengetahuan_id=$this->getNilaiPredikat($nilaiRapor->nilai_pengetahuan);
            $nilaiRapor->save();
        }
        return redirect(action('GuruPtsPasController@index',['id'=>$mapelBukaId]))->with('status','Nilai PTS & PAS telah disimpan');
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
