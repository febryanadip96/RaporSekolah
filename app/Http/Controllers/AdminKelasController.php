<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;

class AdminKelasController extends Controller
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
        $kelas = Kelas::all();
        return view('admin.kelas.index',['kelas'=>$kelas]);
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
            'tingkat' => 'required|numeric',
		],[
			'tingkat.numeric'=>'Tingkat harus diisi angka',
		]);
        Kelas::create([
            'tingkat'=>$request['tingkat'],
            ]);
        return redirect(action('AdminKelasController@index'))->with('status','Data kelas baru telah disimpan');
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
        $kelas = Kelas::whereId($id)->firstOrFail();
        return view('admin.kelas.edit',['kelas'=>$kelas]);
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
            'tingkat' => 'required|numeric',
            ]);
        $kelas = Kelas::whereId($id)->firstOrFail();
        $kelas->update($request->all());
        return redirect(action('AdminKelasController@edit',['id' => $id]))->with('status','Data kelas telah diperbaharui');
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
