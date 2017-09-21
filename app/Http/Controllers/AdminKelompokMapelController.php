<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelompok;

class AdminKelompokMapelController extends Controller
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
        $kelompoks= Kelompok::all();
        return view('admin.kelompokmapel.index',['kelompoks'=>$kelompoks]);
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
            ]);
        Kelompok::create([
            'nama'=>$request['nama'],
            ]);
        return redirect(action('AdminKelompokMapelController@index'))->with('status','Data kelompok baru telah disimpan');
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
        $kelompok = Kelompok::findOrFail($id);
        return view('admin.kelompokmapel.edit',['kelompok'=>$kelompok]);
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
            ]);
        $kelompok=Kelompok::findOrFail($id);
        $kelompok->nama=$request['nama'];
        $kelompok->save();
        return redirect(action('AdminKelompokMapelController@index'))->with('status','Data kelompok baru telah disimpan');
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
