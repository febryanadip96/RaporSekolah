<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\KeluarPindah;

class AdminSiswaKeluarPindahController extends Controller
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
        $keluarPindahs = KeluarPindah::orderBy('created_at','DESC')->get();
        return view('admin.siswakeluarpindah.index',['keluarPindahs'=>$keluarPindahs]);
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
            'siswa_id'=> 'required',
            'tanggal'=>'required',
            'status'=>'required',
            'keterangan'=>'required|string',
            ]);
        KeluarPindah::create([
            'siswa_id'=>$request['siswa_id'],
            'tanggal'=>date("Y-m-d",strtotime($request['tanggal'])),
            'status'=>$request['status'],
            'keterangan'=>$request['keterangan'],
            ]);
        $siswa=Siswa::findOrFail($request['siswa_id']);
        $siswa->delete();
        return redirect('admin/siswa')->with('status', 'Siswa telah dikeluarkan/pindah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keluarPidah = KeluarPindah::findOrFail($id);
        return view('admin.siswakeluarpindah.show',['keluarPindah'=>$keluarPidah]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keluarPindah = KeluarPindah::findOrFail($id);
        return view('admin.siswakeluarpindah.edit',['keluarPindah'=>$keluarPindah]);
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
            'status'=>'required',
            'tanggal'=>'required',
            'keterangan'=>'required',
        ]);
        $keluarPindah = KeluarPindah::findOrFail($id);//id keluar pindah
        $keluarPindah->status = $request['status'];
        $keluarPindah->tanggal = date("Y-m-d",strtotime($request['tanggal']));
        $keluarPindah->alasan = $request['keterangan'];
        $keluarPindah->save();
        return redirect(action('AdminSiswaKeluarPindahController@edit',['id'=>$id]))->with('status', 'Data siswa keluar/pindah telah diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keluarPindah = KeluarPindah::findOrFail($id);
        $keluarPindah->siswa->restore();
        $keluarPindah->delete();
        return redirect(action('AdminSiswaKeluarPindahController@index'))->with('status','Siswa telah direstore');
    }
}
