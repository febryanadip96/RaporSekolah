<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MataPelajaran;
use App\KompetensiDasar;

class AdminKdController extends Controller
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
        $mapels = MataPelajaran::all();
        return view('admin.kd.index',['mapels'=>$mapels]);
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
            'nomor'=>'required|numeric',
            'deskripsi'=>'required|string',
            'gasal_genap'=>'required',
            'mata_pelajaran_id'=>'required',
		],[
			'nomor.numeric'=>'Nomor KD harus berupa angka',
			'mata_pelajaran_id.required'=>'Mata pelajaran tidak valid',
			'gasal_genap'=>'Pilih KD untuk gasal atau genap'
		]);
        KompetensiDasar::create([
            'nomor'=>$request['nomor'],
            'deskripsi'=>$request['deskripsi'],
            'gasal_genap'=>$request['gasal_genap'],
            'mata_pelajaran_id'=>$request['mata_pelajaran_id'],
            ]);
        return redirect(action('AdminKdController@show',['id'=>$request['mata_pelajaran_id']]))->with('status','Komptensi dasar baru berhasil disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mapel=MataPelajaran::findOrFail($id);
        $kds=KompetensiDasar::where('mata_pelajaran_id',$mapel->id)->get();
        return view('admin.kd.show',['mapel'=>$mapel,'kds'=>$kds]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
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
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kd = KompetensiDasar::findOrFail($id);
        $kd->delete();
        return redirect(action('AdminKdController@show',['id'=>$kd->mata_pelajaran_id]))->with('status','Kompetensi dasar '.$kd->nomor.' telah dihapus');
    }
}
