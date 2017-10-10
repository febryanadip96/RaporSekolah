<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NilaiSikap;
use App\Predikat;

class GuruNilaiSikapController extends Controller
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nilaiSikap = NilaiSikap::findOrFail($id);
        return view('guru.walikelas.nilaisikap',['nilaiSikap'=>$nilaiSikap]);
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
            'nilai_spiritual'=>'required|numeric',
            'nilai_sosial'=>'required|numeric',
            'deskripsi_spiritual'=>'required|string',
            'deskripsi_sosial'=>'required|string'
        ]);
        $nilaiSikap = NilaiSikap::findOrFail($id);
        $nilaiSikap->nilai_spiritual=$request['nilai_spiritual'];
        $nilaiSikap->predikat_spiritual_id=$this->getNilaiPredikat($request['nilai_spiritual']);
        $nilaiSikap->deskripsi_spiritual=$request['deskripsi_spiritual'];
        $nilaiSikap->nilai_sosial=$request['nilai_sosial'];
        $nilaiSikap->predikat_sosial_id=$this->getNilaiPredikat($request['nilai_sosial']);
        $nilaiSikap->deskripsi_sosial=$request['deskripsi_sosial'];
        $nilaiSikap->save();
        return redirect(action('GuruNilaiSikapController@edit',['id'=>$id]))->with('status', 'Nilai Sikap telah diperbarui');
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
