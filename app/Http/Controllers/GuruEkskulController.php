<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SemesterSiswa;
use App\Ekstrakulikuler;
use App\NilaiEkstrakulikuler;
use App\Predikat;

class GuruEkskulController extends Controller
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
            'ekstrakulikuler_id'=>'required',
            'nilai'=>'required',
            'semester_siswa_id'=>'required',
        ]);
        NilaiEkstrakulikuler::create([
            'ekstrakulikuler_id'=>$request['ekstrakulikuler_id'],
            'nilai'=>$request['nilai'],
            'semester_siswa_id'=>$request['semester_siswa_id'],
            'predikat_id'=>$this->getNilaiPredikat($request['nilai']),
        ]);
        return redirect(action('GuruEkskulController@show',['id'=>$request['semester_siswa_id']]))->with('status', 'Nilai Ekstrakulikuler baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $semesterSiswa = SemesterSiswa::findOrFail($id);

        //ekskul except
        $ekskulExcept = $semesterSiswa->nilaiEkstrakulikuler->pluck('ekstrakulikuler_id');

        //pilihan ekstrakulikuler
        $ekskulPilihans =Ekstrakulikuler::whereNotIn('id',$ekskulExcept)->get();

        return view('guru.walikelas.ekskul.show',['semesterSiswa'=>$semesterSiswa,'ekskulPilihans'=>$ekskulPilihans]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nilaiEkstrakulikuler= NilaiEkstrakulikuler::findOrFail($id);
        //ekskul except
        $ekskulExcept = $nilaiEkstrakulikuler->semesterSiswa->nilaiEkstrakulikuler->whereNotIn('id',[$id])->pluck('id');
        //pilihan ekstrakulikuler
        $ekskulPilihans =Ekstrakulikuler::whereNotIn('id',$ekskulExcept)->get();
        return view('guru.walikelas.ekskul.edit',['nilaiEkstrakulikuler'=>$nilaiEkstrakulikuler,'ekskulPilihans'=>$ekskulPilihans]);
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
            'ekstrakulikuler_id'=>'required',
            'nilai'=>'required',
        ]);
        $nilaiEkstrakulikuler = NilaiEkstrakulikuler::findOrFail($id);
        $nilaiEkstrakulikuler->nilai=$request['nilai'];
        $nilaiEkstrakulikuler->predikat_id=$this->getNilaiPredikat($request['nilai']);
        $nilaiEkstrakulikuler->ekstrakulikuler_id=$request['ekstrakulikuler_id'];
        $nilaiEkstrakulikuler->save();
        return redirect(action('GuruEkskulController@edit',['id'=>$id]))->with('status','Data Nilai Ekstrakulikuler telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilaiEkstrakulikuler=NilaiEkstrakulikuler::findOrFail($id);
        $nilaiEkstrakulikuler->delete();
        return redirect(action('GuruEkskulController@show',['id'=>$nilaiEkstrakulikuler->semesterSiswa->id]))->with('status','Data Nilai Ekstrakulikuler telah dihapus');
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
