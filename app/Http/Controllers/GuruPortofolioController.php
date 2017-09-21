<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;
use App\MapelBuka;
use App\KompetensiDasar;
use App\Ketrampilan;
use App\NilaiRapor;
use App\Predikat;

class GuruPortofolioController extends Controller
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
        return view('guru.matapelajaran.portofolio.index',['kompetensiDasars'=>$kompetensiDasars,'mapelBuka'=>$mapelBuka]);
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
             $portofolio = Ketrampilan::findOrFail($key);
             $portofolio->nilai=$nilai;
             $portofolio->save();
             $nilaiRapor=NilaiRapor::findOrFail($portofolio->nilai_rapor_id);
             $nilaiRapor->nilai_ketrampilan=
             (($nilaiRapor->ketrampilan->where('kategori',1)->where('nilai','!=',null)->pluck('nilai'))->avg()+
             ($nilaiRapor->ketrampilan->where('kategori',2)->where('nilai','!=',null)->pluck('nilai'))->avg()+
             ($nilaiRapor->ketrampilan->where('kategori',3)->where('nilai','!=',null)->pluck('nilai'))->avg()+
             ($nilaiRapor->ketrampilan->where('kategori',4)->where('nilai','!=',null)->pluck('nilai'))->avg())/4;
             $nilaiRapor->predikat_ketrampilan_id=$this->getNilaiPredikat($nilaiRapor->nilai_ketrampilan);
             $nilaiRapor->save();
         }
         return redirect(action('GuruPortofolioController@show',['mapelBukaId'=>$mapelBukaId,'id'=>$id]))->with('status','Nilai Portofolio telah disimpan');
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
             $portofolio=Ketrampilan::where('nilai_rapor_id',$nilaiRapor->id)->where('kompetensi_dasar_id',$kd->id)->where('kategori',2)->first();
             if(empty($portofolio))
             {
                 Ketrampilan::create([
                     'nilai_rapor_id'=>$nilaiRapor->id,
                     'kompetensi_dasar_id'=>$kd->id,
                     'kategori'=>2,
                 ]);
             }
         }
         $portofolios = Ketrampilan::whereIn('nilai_rapor_id',$nilaiRapors->pluck('id'))->where('kompetensi_dasar_id',$id)->where('kategori',2)->get();
         return view('guru.matapelajaran.portofolio.show',['portofolios'=>$portofolios,'mapelBuka'=>$mapelBuka,'kd'=>$kd]);
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
            if($predikat->nilai_awal<=$nilai && $predikat->nilai_akhir>=$nilai){
                return $predikat->id;
            }
        }
    }
}
