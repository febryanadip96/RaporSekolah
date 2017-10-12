<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ketidakhadiran;
use App\SemesterSiswa;

class GuruAbsenController extends Controller
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
            'tanggal'=>'required',
            'status'=>'required',
            'semester_siswa_id'=>'required',
        ]);

        Ketidakhadiran::create([
            'tanggal'=>date("Y-m-d",strtotime($request['tanggal'])),
            'status'=>$request['status'],
            'semester_siswa_id'=>$request['semester_siswa_id'],
        ]);
        return redirect(action('GuruAbsenController@show',['id'=>$request['semester_siswa_id']]))->with('status', 'Data Ketidakhadiran telah ditambahkan');
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
        return view('guru.walikelas.absen.show',['semesterSiswa'=>$semesterSiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ketidakhadiran = Ketidakhadiran::findOrFail($id);
        return view('guru.walikelas.absen.edit',['ketidakhadiran'=>$ketidakhadiran]);
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
            'tanggal'=>'required',
            'status'=>'required',
        ]);

        $ketidakhadiran = Ketidakhadiran::findOrFail($id);
        $ketidakhadiran->tanggal = date("Y-m-d",strtotime($request['tanggal']));
        $ketidakhadiran->status = $request['status'];
        $ketidakhadiran->save();
        return redirect(action('GuruAbsenController@edit',['id'=>$id]))->with('status','Data Ketidakhadiran telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ketidakhadiran = Ketidakhadiran::findOrFail($id);
        $ketidakhadiran->delete();
        return redirect(action('GuruAbsenController@show',['id'=>$ketidakhadiran->semesterSiswa->id]))->with('status','Data Ketidakhadiran telah dihapus');
    }
}
