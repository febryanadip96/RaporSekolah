<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ijazah;

class AdminIjazahController extends Controller
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
        $ijazahs = Ijazah::all();
        return view('admin.ijazah.index',['ijazahs'=>$ijazahs]);
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
            'nama'=>'required|string',
            ]);
        Ijazah::create([
            'nama'=>$request['nama'],
            ]);
        return redirect(action('AdminIjazahController@index'))->with('status', 'Ijazah Baru telah ditambahkan');
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
        $ijazah = Ijazah::findOrFail($id);
        return view('admin.ijazah.edit',['ijazah'=>$ijazah]);
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
            ]);
        $ijazah = Ijazah::findOrFail($id);
        $ijazah->nama=$request['nama'];
        $ijazah->save();
        return redirect(action('AdminIjazahController@edit',['id'=>$id]))->with('status', 'Data ijazah telah diperbarui');
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
