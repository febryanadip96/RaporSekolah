<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SemesterSiswa;
use App\Peringkat;
use App\Prestasi;

class GuruPrestasiController extends Controller
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
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
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
            'peringkat_id'=>'required',
            'nama_lomba'=>'required|string',
            'tingkat'=>'required',
            'semester_siswa_id'=>'required',
        ]);
        Prestasi::create([
            'peringkat_id'=>$request['peringkat_id'],
            'nama_lomba'=>$request['nama_lomba'],
            'tingkat'=>$request['tingkat'],
            'semester_siswa_id'=>$request['semester_siswa_id'],
        ]);
        return redirect(action('GuruPrestasiController@show',['id'=>$request['semester_siswa_id']]))->with('status', 'Prestasi baru telah ditambahkan');
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
        $peringkats = Peringkat::all();
        return view('guru.walikelas.prestasi.show',['semesterSiswa'=>$semesterSiswa,'peringkats'=>$peringkats]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $peringkats = Peringkat::all();
        return view('guru.walikelas.prestasi.edit',['prestasi'=>$prestasi,'peringkats'=>$peringkats]);
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
            'peringkat_id'=>'required',
            'nama_lomba'=>'required|string',
            'tingkat'=>'required',
        ]);
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->peringkat_id=$request['peringkat_id'];
        $prestasi->nama_lomba=$request['nama_lomba'];
        $prestasi->tingkat=$request['tingkat'];
        $prestasi->save();
        return redirect(action('GuruPrestasiController@edit',['id'=>$id]))->with('status','Data Prestasi telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prestasi=Prestasi::findOrFail($id);
        $prestasi->delete();
        return redirect(action('GuruPrestasiController@show',['id'=>$prestasi->semesterSiswa->id]))->with('status','Data Prestasi telah dihapus');
    }
}
