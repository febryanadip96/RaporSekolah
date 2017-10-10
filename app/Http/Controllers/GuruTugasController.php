<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;
use App\MapelBuka;
use App\Tugas;
use App\KompetensiDasar;
use App\NilaiRapor;
use App\Predikat;

class GuruTugasController extends Controller
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
        $kompetensiDasars = $mapelBuka->mataPelajaran->kompetensiDasar->where('gasal_genap', $semesterAktif->gasal_genap);
        return view('guru.matapelajaran.tugas.index',['kompetensiDasars'=>$kompetensiDasars,'mapelBuka'=>$mapelBuka]);
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
    public function store(Request $request,$mapelBukaId,$id)
    {
        $nilais = $request['nilai'];
        foreach ($nilais as $key => $nilai) {
            $tugas = Tugas::findOrFail($key);
            $tugas->nilai=$nilai;
            $tugas->save();
            $nilaiRapor=NilaiRapor::findOrFail($tugas->nilai_rapor_id);
            $nilaiRapor->nilai_pengetahuan=
            (($nilaiRapor->tugas->where('nilai','!=',null)->pluck('nilai'))->avg()+($nilaiRapor->ulanganHarian->where('nilai_akhir','!=',null)->pluck('nilai_akhir'))->avg()+$nilaiRapor->nilai_pts+$nilaiRapor->nilai_pas)/4;
            $nilaiRapor->predikat_pengetahuan_id=$this->getNilaiPredikat($nilaiRapor->nilai_pengetahuan);
            $nilaiRapor->save();
        }
        return redirect(action('GuruTugasController@show',['mapelBukaId'=>$mapelBukaId,'id'=>$id]))->with('status','Nilai Tugas telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mapelBukaId, $id)
    {
        $mapelBuka = MapelBuka::findOrFail($mapelBukaId);
        $kd=KompetensiDasar::findOrFail($id);
        $semesterAktif = Semester::where('status',1)->first();
        $idSemesterSiswaAktifs=$semesterAktif->semesterSiswa->pluck('id');
        $nilaiRapors =NilaiRapor::whereIn('semester_siswa_id',$idSemesterSiswaAktifs)->where('mapel_buka_id',$mapelBukaId)->get();
        foreach ($nilaiRapors as $key => $nilaiRapor) {
            $tugas=Tugas::where('nilai_rapor_id',$nilaiRapor->id)->where('kompetensi_dasar_id',$kd->id)->first();
            if(empty($tugas))
            {
                Tugas::create([
                    'nilai_rapor_id'=>$nilaiRapor->id,
                    'kompetensi_dasar_id'=>$kd->id,
                ]);
            }
        }
        $tugass = Tugas::whereIn('nilai_rapor_id',$nilaiRapors->pluck('id'))->where('kompetensi_dasar_id',$id)->get();
        return view('guru.matapelajaran.tugas.show',['tugass'=>$tugass,'mapelBuka'=>$mapelBuka,'kd'=>$kd]);
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
