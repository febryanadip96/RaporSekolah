<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peringkat;

class AdminPeringkatController extends Controller
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
        $peringkats = Peringkat::all();
        return view('admin.peringkat.index',['peringkats'=>$peringkats]);
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
            'juara'=>'required|string',
            ]);
        Peringkat::create([
            'juara'=>$request['juara'],
            ]);
        return redirect(action('AdminPeringkatController@index'))->with('status','Data peringkat baru telah ditambahkan');
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
        $peringkat=Peringkat::findOrFail($id);
        return view('admin.peringkat.edit',['peringkat'=>$peringkat]);
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
            'juara'=>'required|string',
            ]);
        $peringkat=Peringkat::findOrFail($id);
        $peringkat->juara=$request['juara'];
        $peringkat->save();
        return redirect(action('AdminPeringkatController@edit',['id'=>$id]))->with('status','Data Peringkat telah diperbarui');
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
