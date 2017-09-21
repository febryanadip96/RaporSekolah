<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MapelBuka;
use App\Semester;
use App\KelasBuka;
use Auth;
use Carbon\Carbon;
use App\NilaiRapor;
use App\SemesterSiswa;
use App\Siswa;

class GuruMataPelajaranController extends Controller
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
        $karyawanId = Auth::user()->karyawan->id;
        //cari semester aktif
        $semesterAktif =Semester::where('status', 1)->first();
        //tidak ada semester aktif
        if(empty($semesterAktif))
        {
            return redirect('guru/home')->with('status','Tidak ada semester yang aktif saat ini');
        }
        if(Auth::user()->karyawan->super==0){
            //cek waktu tutup semester
            //waktu sekarang GMT+7
            $sekarang =strtotime(Carbon::now()->addHours(7));
            //waktu tutup tengah semester
            $awal_tutup_tengah_semester=strtotime($semesterAktif->awal_tutup_tengah_semester);
            $akhir_tutup_tengah_semester=strtotime($semesterAktif->akhir_tutup_tengah_semester);
            //waktu tutup akhir semester
            $awal_tutup_akhir_semester=strtotime($semesterAktif->awal_tutup_akhir_semester);
            $akhir_tutup_akhir_semester=strtotime($semesterAktif->akhir_tutup_akhir_semester);
            //cek tutup tengah semester
            if($awal_tutup_tengah_semester<=$sekarang && $sekarang<=$akhir_tutup_tengah_semester)
            {
                return redirect('guru/home')->with('status','Tidak dapat masuk ke Halaman Mata Pelajaran untuk saat ini karena tutup tengah semester');
            }
            //cek tutup akhir semester
            if($awal_tutup_akhir_semester<=$sekarang && $sekarang<=$akhir_tutup_akhir_semester)
            {
                return redirect('guru/home')->with('status','Tidak dapat masuk ke Halaman Mata Pelajaran untuk saat ini karena tutup akhir semester');
            }
        }
        $kelasBukasId= KelasBuka::where('tahun_ajar_id',$semesterAktif->tahunAjar->id)->pluck('id');
        $mapelBukas = MapelBuka::where('pengajar_id', $karyawanId)->whereIn('kelas_buka_id',$kelasBukasId)->get();
        return view('guru.matapelajaran.index',['mapelBukas'=>$mapelBukas]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //cari semester aktif
        $semesterAktif =Semester::where('status', 1)->first();
        //mapel buka yang diajar
        $mapelBuka = MapelBuka::findOrFail($id);
        //siswa terdaftar
        $daftarSiswa=NilaiRapor::where('mapel_buka_id',$mapelBuka->id)->pluck('semester_siswa_id');
        $semesterSiswas=SemesterSiswa::whereIn('id',$daftarSiswa)->where('semester_id',$semesterAktif->id)->get();
        return view('guru.matapelajaran.show',['mapelBuka'=>$mapelBuka, 'semesterSiswas'=>$semesterSiswas]);
    }
}
