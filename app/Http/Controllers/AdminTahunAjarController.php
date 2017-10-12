<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TahunAjar;
use App\Semester;

class AdminTahunAjarController extends Controller
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
        $tahunAjars = TahunAjar::orderBy('created_at', 'DESC')->get();
		$semesterAktif= Semester::where('status',1)->first();
        return view('admin.tahunajar.index',['tahunAjars'=>$tahunAjars, 'semesterAktif'=>$semesterAktif]);
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
			'nama'=>'required',
			'total_hari_efektif'=>'required|numeric',
			'tutup'=>'required',
		],[
			'total_hari_efektif.required'=>'Total hari efektif harus diisi',
			'total_hari_efektif.numeric'=>'Total hari efektif harus berisi angka',
			'tutup.required'=>'Tanggal tutup harus diisi',
		]);
        $idTahunAjar = TahunAjar::create([
			'nama'=>$request['nama'],
			'total_hari_efektif'=>$request['total_hari_efektif'],
			'tutup'=>date("Y-m-d",strtotime($request['tutup'])),
			])->id;
        Semester::where('status',1)->update(['status'=>0]);
        Semester::create([
            'tahun_ajar_id' => $idTahunAjar,
            'gasal_genap' => 1,
            'status' => 1,
            ]);
        Semester::create([
            'tahun_ajar_id' => $idTahunAjar,
            'gasal_genap' => 2,
            'status' => 0,
            ]);
        return redirect(action('AdminTahunAjarController@index'))->with('status','Tahun ajar baru telah dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$semesterAktif= Semester::where('status',1)->first();
		if(!$semesterAktif){
			return back()->with('status','Tahun Ajar tidak dapat diedit karena Semester Tahun Ajar tidak aktif');
		}
		if($semesterAktif->tahunAjar->id!=$id){
			return back()->with('status','Tahun Ajar tidak dapat diedit karena Semester Tahun Ajar tidak aktif');
		}
        $tahunAjar = TahunAjar::findOrFail($id);
        return view('admin.tahunajar.edit',['tahunAjar'=>$tahunAjar]);
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
			'nama'=>'required',
			'total_hari_efektif'=>'required|numeric',
			'tutup'=>'required',
		],[
			'total_hari_efektif.required'=>'Total hari efektif harus diisi',
			'total_hari_efektif.numeric'=>'Total hari efektif harus berisi angka',
			'tutup.required'=>'Tanggal tutup harus diisi',
		]);
        $tahunAjar=TahunAjar::findOrFail($id);
        $tahunAjar->nama=$request['nama'];
		$tahunAjar->total_hari_efektif=$request['total_hari_efektif'];
		$tahunAjar->tutup=date("Y-m-d",strtotime($request['tutup']));
		$tahunAjar->save();
        return redirect(action('AdminTahunAjarController@edit',['id' => $id]))->with('status','Tahun ajar telah diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
