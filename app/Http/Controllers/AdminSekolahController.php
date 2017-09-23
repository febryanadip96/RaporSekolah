<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;

class AdminSekolahController extends Controller
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
        $sekolahs=Sekolah::all();
        return view('admin.sekolah.index',['sekolahs'=>$sekolahs]);
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
            'nama'=>'required|string',
            'negeri_swasta'=>'required',
            'alamat'=>'required|string',
		],[
			'negeri_swasta.required'=>'Pilihan negeri atau swasta harus diisi',
		]);
        Sekolah::create([
            'nama'=>$request['nama'],
            'negeri_swasta'=>$request['negeri_swasta'],
            'alamat'=>$request['alamat'],
            ]);
        return redirect(action('AdminSekolahController@index'))->with('status', 'Sekolah Baru telah ditambahkan');
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
        $sekolah = Sekolah::findOrFail($id);
        return view('admin.sekolah.edit',['sekolah'=>$sekolah]);
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
            'negeri_swasta'=>'required',
            'alamat'=>'required|string',
            ]);
        $sekolah = Sekolah::findOrFail($id);
        $sekolah->nama=$request['nama'];
        $sekolah->negeri_swasta=$request['negeri_swasta'];
        $sekolah->alamat=$request['alamat'];
        $sekolah->save();
        return redirect(action('AdminSekolahController@edit',['id'=>$id]))->with('status', 'Data sekolah telah diperbarui');
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
