<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ekstrakulikuler;
use App\SemesterSiswa;

class AdminEkskulController extends Controller
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
        $ekskuls = Ekstrakulikuler::all();
        return view('admin.ekskul.index',['ekskuls'=>$ekskuls]);
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
            'jenis'=>'required',
            ]);
        $idEkskul=Ekstrakulikuler::create([
            'nama'=>$request['nama'],
						'jenis'=>$request['jenis'],
            ])->id;
        return redirect(action('AdminEkskulController@index'))->with('status','Data ekstrakulikuler baru telah ditambahkan');
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
        $ekskul=Ekstrakulikuler::findOrFail($id);
        return view('admin.ekskul.edit',['ekskul'=>$ekskul]);
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
            'jenis'=>'required',
            ]);
        $ekskul=Ekstrakulikuler::findOrFail($id);
        $ekskul->nama=$request['nama'];
				$ekskul->jenis=$request['jenis'];
        $ekskul->save();
        return redirect(action('AdminEkskulController@edit',['id'=>$id]))->with('status','Data ekstrakulikuler telah diperbarui');
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
