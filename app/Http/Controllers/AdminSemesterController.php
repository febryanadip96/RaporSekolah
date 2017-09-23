<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;

class AdminSemesterController extends Controller
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
        $semesters = Semester::all();
        return view('admin.semester.index',['semesters'=>$semesters]);
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
        //
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
        $semester = Semester::whereId($id)->firstOrFail();
        return view('admin.semester.edit',['semester'=>$semester]);
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
            'tutup_tengah_semester'=>'required',
            'tutup_akhir_semester'=>'required',
            'status'=>'required',
        ],[
			'tutup_tengah_semester.required'=>'Tanggal tutup tengah semester harus diisi',
			'tutup_akhir_semester.required'=>'Tanggal tutup akhri semester harus diisi',
			'status.required'=>'Status semester harus dipilih',
		]);
        if($request['status']==1)
        {
            Semester::where('status',1)->update(['status'=>0]);
        }
        $awal=explode(" - ",$request->tutup_tengah_semester);
        $akhir = explode(" - ",$request->tutup_akhir_semester);
        $semester = Semester::whereId($id)->firstOrFail();
        $semester->status=$request['status'];
        $semester->awal_tutup_tengah_semester=date("Y-m-d H:i:s",strtotime($awal[0]));
        $semester->akhir_tutup_tengah_semester=date("Y-m-d H:i:s",strtotime($awal[1]));
        $semester->awal_tutup_akhir_semester=date("Y-m-d H:i:s",strtotime($akhir[0]));
        $semester->akhir_tutup_akhir_semester=date("Y-m-d H:i:s",strtotime($akhir[1]));
        $semester->save();
        return redirect(action('AdminSemesterController@edit',['id' => $id]))->with('status','Semester telah diperbaharui');
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
