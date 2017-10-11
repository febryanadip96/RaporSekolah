<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\TahunAjar;
use App\KelasBuka;
use App\Karyawan;
use App\Semester;

class AdminKelasBukaController extends Controller
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
        $kelas = Kelas::all();
        $semester=Semester::where('status',1)->firstOrFail();
        $tahunAjarAktif = $semester->tahunAjar;
        $karyawanException = KelasBuka::where('tahun_ajar_id',$tahunAjarAktif->id)->pluck('wali_kelas_id');
        $karyawans = Karyawan::whereNotIn('id',$karyawanException)->get();
        $kelasBukas = KelasBuka::orderBy('id', 'DESC')->where('tahun_ajar_id',$tahunAjarAktif->id)->get();
        return view('admin.kelasbuka.index',['kelasBukas'=>$kelasBukas, 'kelas'=>$kelas, 'tahunAjarAktif' =>$tahunAjarAktif, 'karyawans' =>$karyawans]);
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
            'nama' => 'required|string',
            'kelas_id' => 'required',
            'tahun_ajar_id' => 'required',
            'wali_kelas_id' =>'required'
		],[
			'kelas_id.required' => 'Kelas tidak valid',
			'tahun_ajar_id.required'=>'Tahun ajar tidak valid',
			'wali_kelas_id.required' =>'Guru wali kelas tidak valid',
		]);
        KelasBuka::create([
            'nama' => $request['nama'],
            'kelas_id' => $request['kelas_id'],
            'wali_kelas_id' => $request['wali_kelas_id'],
            'tahun_ajar_id' => $request['tahun_ajar_id'],
            ]);
        return redirect(action('AdminKelasBukaController@index'))->with('status','Data kelas buka baru telah disimpan');
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
        $kelasBuka = KelasBuka::findOrFail($id);
		if(!$kelasBuka->daftarKelas->isEmpty()){
			return back()->with('status', 'Tidak dapat mengedit karena sudah ada siswa yang terdaftar dalam kelas ini');
		}
        $kelas = Kelas::all();
        $karyawanException = KelasBuka::where('tahun_ajar_id',$kelasBuka->tahun_ajar_id)->pluck('wali_kelas_id');
        $karyawans = Karyawan::whereNotIn('id',$karyawanException)->get();
        $karyawans=$karyawans->union(Karyawan::where('id',$kelasBuka->wali_kelas_id)->get());
        return view('admin.kelasbuka.edit',['kelasBuka'=>$kelasBuka, 'kelas'=>$kelas, 'karyawans' =>$karyawans]);
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
            'nama' => 'required|string',
            'kelas_id' => 'required',
            'tahun_ajar_id' => 'required',
            'wali_kelas_id' =>'required'
        ],[
			'kelas_id.required' => 'Kelas tidak valid',
			'tahun_ajar_id.required'=>'Tahun ajar tidak valid',
			'wali_kelas_id.required' =>'Guru wali kelas tidak valid',
		]);
        $kelasBuka = KelasBuka::whereId($id)->firstOrFail();
        $kelasBuka->update($request->all());
        return redirect(action('AdminKelasBukaController@edit',['id' => $id]))->with('status','Data kelas buka telah diperbaharui');
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
