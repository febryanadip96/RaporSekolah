<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Predikat;

class AdminPredikatController extends Controller
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
        $predikats = Predikat::all();
        return view('admin.predikat.index', ['predikats'=>$predikats]);
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
            'nilai_awal'=>'required|numeric|min:0|max:99',
            'nilai_akhir'=>'required|numeric|min:1|max:100',
            'predikat_ki1_ki2'=>'required|string',
            'predikat_ki3_ki4'=>'required|string',
            'lulus_ki1_ki2'=>'required',
		],[
			'nilai_awal.numeric'=>'Nilai awal harus berupa angka',
			'nilai_awal.min'=>'Nilai awal minimal 0',
			'nilai_awal.max'=>'Nilai awal maksimal 99',
            'nilai_akhir.numeric'=>'Nilai akhir harus berupa angka',
            'nilai_akhir.min'=>'Nilai akhir minimal 1',
            'nilai_akhir.max'=>'Nilai akhir maksimal 100',
            'lulus_ki1_ki2.required'=>'Lulus atau tidak harus dipilih',
		]);

        Predikat::create([
            'nilai_awal'=>$request['nilai_awal'],
            'nilai_akhir'=>$request['nilai_akhir'],
            'predikat_ki1_ki2'=>$request['predikat_ki1_ki2'],
            'predikat_ki3_ki4'=>$request['predikat_ki3_ki4'],
            'lulus_ki1_ki2'=>$request['lulus_ki1_ki2'],
            ]);
        return redirect(action('AdminPredikatController@index'))->with('status','Predikat baru telah disimpan');
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
        $predikat=Predikat::findOrFail($id);
        return view('admin.predikat.edit',['predikat'=>$predikat]);
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
            'nilai_awal'=>'required|numeric|min:0|max:99',
            'nilai_akhir'=>'required|numeric|min:1|max:100',
            'predikat_ki1_ki2'=>'required|string',
            'predikat_ki3_ki4'=>'required|string',
            'lulus_ki1_ki2'=>'required',
        ],[
			'nilai_awal.numeric'=>'Nilai awal harus berupa angka',
			'nilai_awal.min'=>'Nilai awal minimal 0',
			'nilai_awal.max'=>'Nilai awal maksimal 99',
            'nilai_akhir.numeric'=>'Nilai akhir harus berupa angka',
            'nilai_akhir.min'=>'Nilai akhir minimal 1',
            'nilai_akhir.max'=>'Nilai akhir maksimal 100',
            'lulus_ki1_ki2.required'=>'Lulus atau tidak harus dipilih',
		]);
        $predikat=Predikat::findOrFail($id);
        $predikat->nilai_awal=$request['nilai_awal'];
        $predikat->nilai_akhir=$request['nilai_akhir'];
        $predikat->predikat_ki1_ki2=$request['predikat_ki1_ki2'];
        $predikat->predikat_ki3_ki4=$request['predikat_ki3_ki4'];
        $predikat->lulus_ki1_ki2=$request['lulus_ki1_ki2'];
        $predikat->save();
        return redirect(action('AdminPredikatController@edit',['id'=>$id]))->with('status','Data Predikat telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $predikat=Predikat::findOrFail($id);
        $predikat->delete();
        return redirect(action('AdminPredikatController@index'))->with('status','Predikat telah dihapus');
    }
}
