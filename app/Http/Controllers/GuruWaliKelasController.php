<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Semester;
use App\KelasBuka;
use App\SemesterSiswa;

class GuruWaliKelasController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //KI1 dan KI2
        $karyawanId = Auth::user()->karyawan->id;
        //cari semester aktif
        $semesterAktif =Semester::where('status', 1)->first();
        if(empty($semesterAktif))
        {
            return redirect('guru/home')->with('status','Tidak ada semester yang aktif saat ini');
        }
        //cari kelas yang diwalikelas tahun ajar ini
        $kelasWaliKelas= KelasBuka::where('tahun_ajar_id',$semesterAktif->tahunAjar->id)->where('wali_kelas_id',$karyawanId)->first();
        if(empty($kelasWaliKelas))
        {
            return redirect('guru/home')->with('status','Tidak dapat masuk ke Halaman Wali Kelas');
        }
        //cari semester siswa;
        $semesterSiswas = SemesterSiswa::where('kelas_buka_id',$kelasWaliKelas->id)->where('semester_id',$semesterAktif->id)->get();

        return view('guru.walikelas.index',['semesterSiswas'=>$semesterSiswas,'kelasWaliKelas'=>$kelasWaliKelas]);
    }
}
