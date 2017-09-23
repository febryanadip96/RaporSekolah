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
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahunAjars = TahunAjar::all();
        return view('admin.tahunajar.index',['tahunAjars'=>$tahunAjars]);
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
			'nama'=>'required',
			'total_hari_efektif'=>'required|numeric',
		],[
			'total_hari_efektif'=>'Total hari efektif harus berisi angka',
		]);
        $idTahunAjar = TahunAjar::create($request->all())->id;
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
        $tahunAjar = TahunAjar:findOrFail($id);
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
		],[
			'total_hari_efektif'=>'Total hari efektif harus berisi angka',
		]);
        $tahunAjar=TahunAjar::findOrFail($id);
        $tahunAjar->update($request->all());
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
        //
    }
}
