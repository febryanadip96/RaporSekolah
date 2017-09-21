<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MataPelajaran;
use App\Semester;
use App\Kelas;
use App\Kelompok;

class AdminMapelController extends Controller
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
        $mapels = MataPelajaran::all();
        //echo $mapels;
        return view('admin.mapel.index',['mapels'=>$mapels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas=Kelas::all();
        $kelompoks=Kelompok::all();
        return view('admin.mapel.create',['kelas'=>$kelas,'kelompoks'=>$kelompoks]);
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
            'nama'=>'required|string',
            'keterangan'=>'nullable',
            'kelas_id'=>'required',
            'jenis'=>'required',
            'kelompok_id'=>'required',
            'urutan'=>'required',
            ]);
        MataPelajaran::create([
            'nama'=>$request['nama'],
            'keterangan'=>$request['keterangan'],
            'kelas_id'=>$request['kelas_id'],
            'jenis'=>$request['jenis'],
            'kelompok_id'=>$request['kelompok_id'],
            'urutan'=>$request['urutan'],
            ]);
        return redirect(action('AdminMapelController@index'))->with('status','Mata pelajaran baru berhasil disimpan');
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
        $mapel=MataPelajaran::findOrFail($id);
        $kelas=Kelas::all();
        $kelompoks=Kelompok::all();
        return view('admin.mapel.edit',['mapel'=>$mapel,'kelas'=>$kelas,'kelompoks'=>$kelompoks]);
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
            'nama'=>'required|string',
            'keterangan'=>'nullable',
            'kelas_id'=>'required',
            'jenis'=>'required',
            'kelompok_id'=>'required',
            'urutan'=>'required',
            ]);
        $mapel=MataPelajaran::findOrFail($id);
        $mapel->nama=$request['nama'];
        $mapel->keterangan=$request['keterangan'];
        $mapel->kelas_id=$request['kelas_id'];
        $mapel->jenis=$request['jenis'];
        $mapel->kelompok_id=$request['kelompok_id'];
        $mapel->urutan=$request['urutan'];
        $mapel->save();
        return redirect(action('AdminMapelController@edit',['id'=>$id]))->with('status','Mata pelajaran telah diperbaharui');
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
}
