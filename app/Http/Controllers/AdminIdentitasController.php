<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IdentitasSekolah;
use App\Kota;

class AdminIdentitasController extends Controller
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
        $identitas=IdentitasSekolah::whereId(1)->firstOrFail();
        $kotas=Kota::all();
        return view('admin.identitas',['identitas'=>$identitas,'kotas'=>$kotas]);
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
        abort(404);
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
		$this->validate($request,[
			'nama'=>'required',
			'nis'=>'required',
			'alamat'=>'required',
			'kelurahan'=>'required',
			'kecamatan'=>'required',
			'kota_id'=>'required',
			'provinsi'=>'required',
			'email'=>'required',
		],[
			'kota_id.required'=>'Data kota tidak valid',
		]);
        $identitas=IdentitasSekolah::whereId($id)->firstOrFail();
        $identitas->update($request->all());
        return redirect(action('AdminIdentitasController@index'))->with('status','Data sekolah telah diperbaharui');
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
