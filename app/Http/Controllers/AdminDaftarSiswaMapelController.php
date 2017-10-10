<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NilaiRapor;
use App\MapelBuka;
use App\SemesterSiswa;
use App\Siswa;
use App\DaftarKelas;
use App\Predikat;

class AdminDaftarSiswaMapelController extends Controller
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
            'mapel_buka_id'=>'required',
		],[
			'siswa_id.required'=>'Data siswa tidak valid',
			'mapel_buka_id.required'=>'Data mata pelajaran tidak valid',
		]);
        $semesterSiswas=SemesterSiswa::where('siswa_id',$request['siswa_id'])->get();
        foreach ($semesterSiswas as $key => $semesterSiswa) {
            NilaiRapor::create([
                'semester_siswa_id'=>$semesterSiswa->id,
                'mapel_buka_id'=>$request['mapel_buka_id'],
                'nilai_pengetahuan'=>0,
                'nilai_ketrampilan'=>0,
                'predikat_pengetahuan_id'=>$this->getNilaiPredikat(0),
                'predikat_ketrampilan_id'=>$this->getNilaiPredikat(0),
                ]);
        }
        return redirect(action('AdminDaftarSiswaMapelController@show',['id'=>$request['mapel_buka_id']]))->with('status','Siswa berhasil didaftarkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //terdaftar
        $mapelBuka=MapelBuka::findOrFail($id);
        $daftarSiswa=NilaiRapor::where('mapel_buka_id',$id)->pluck('semester_siswa_id');
        $semesterSiswa=SemesterSiswa::whereIn('id',$daftarSiswa)->pluck('siswa_id');
        $siswasTerdaftar=Siswa::whereIn('id',$semesterSiswa)->withTrashed()->get();

        //pilihan
        $siswaPil=DaftarKelas::where('kelas_buka_id',$mapelBuka->kelas_buka_id)->pluck('siswa_id');
        //exception
        $siswaEx=Siswa::whereIn('id',$semesterSiswa)->pluck('id');

        //semua siswa pilihan
        $siswasPilihan=Siswa::whereIn('id',$siswaPil)->whereNotIn('id',$siswaEx)->get();
        return view('admin.daftarsiswamapel.show',['mapelBuka'=>$mapelBuka,'siswasTerdaftar'=>$siswasTerdaftar,'siswasPilihan'=>$siswasPilihan]);
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
        $semesterSiswas=SemesterSiswa::where('siswa_id',$id)->where('kelas_buka_id',$request['kelas_buka_id'])->get();
        foreach ($semesterSiswas as $key => $semesterSiswa) {
            $nilaiRapors = NilaiRapor::where('semester_siswa_id',$semesterSiswa->id)->where('mapel_buka_id',$request['mapel_buka_id'])->get();
            foreach ($nilaiRapors as $key => $nilaiRapor) {
                $nilaiRapor->delete();
            }
        }
        return redirect(action('AdminDaftarSiswaMapelController@show',['id'=>$request['mapel_buka_id']]))->with('status','Siswa berhasil dihapus');
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
