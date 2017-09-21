<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SemesterSiswa;

class GuruCatatanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guru');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $semesterSiswa=SemesterSiswa::findOrFail($id);
        return view('guru.walikelas.catatan',['semesterSiswa'=>$semesterSiswa]);
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
            'catatan_walikelas'=>'required|string',
        ]);
        $semesterSiswa=SemesterSiswa::findOrFail($id);
        $semesterSiswa->catatan_walikelas=$request['catatan_walikelas'];
        $semesterSiswa->save();
        return redirect(action('GuruCatatanController@edit',['id'=>$id]))->with('status', 'Catatan wali kelas telah diperbarui');
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
