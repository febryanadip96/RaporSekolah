<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Siswa;
use App\Kota;
use App\Pekerjaan;
use App\Sekolah;
use App\TahunAjar;
use App\Kelas;
use App\SemesterSiswa;
use App\DaftarKelas;
use App\Kelompok;
use App\IdentitasSekolah;

class AdminSiswaController extends Controller
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
        $siswas = Siswa::orderBy('status', 'ASC')->get();
        return view('admin.siswa.index',['siswas'=>$siswas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kotas = Kota::all();
        $pekerjaans = Pekerjaan::all();
        $sekolahs=Sekolah::all();
        $tahunAjars = TahunAjar::all();
        $kelas = Kelas::all();
        return view('admin.siswa.create',['kotas'=>$kotas, 'pekerjaans'=>$pekerjaans,'sekolahs'=>$sekolahs,'tahunAjars'=>$tahunAjars,'kelas'=>$kelas]);
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
            'name' => 'required|string|max:255',
            'username' =>'required|string|max:255|unique:users',
            'password'=>'required|string|min:6',
            'nis'=>'required|string',
            'nisn'=>'required|string',
            'jenis_kelamin'=>'required',
            'tanggal_lahir'=>'required',
            'tempat_lahir_id'=>'required',
            'alamat'=>'required',
            'agama'=>'required',
            'tanggal_masuk'=>'required',
            'tahun_ajar_id'=>'required',
            'sekolah_asal_id'=>'required',
            'kelas_awal_id'=>'required',
            'anak_ke'=>'required|numeric',
            'ayah'=>'required',
            'ibu'=>'required',
            'pekerjaan_ayah_id'=>'required',
            'pekerjaan_ibu_id'=>'required',
            'pekerjaan_wali_id'=>'required',
            ]);
        $userId = User::create([
            'name' => $request['name'],
            'username' =>$request['username'],
            'password' =>bcrypt($request['password']),
            'role' =>3,
            ])->id;
        Siswa::create([
            'user_id' =>$userId,
            'nis' =>$request['nis'],
            'nisn'=>$request['nisn'],
            'jenis_kelamin'=>$request['jenis_kelamin'],
            'tanggal_lahir'=>date("Y-m-d",strtotime($request['tanggal_lahir'])),
            'tempat_lahir_id'=>$request['tempat_lahir_id'],
            'alamat' =>$request['alamat'],
            'agama' =>$request['agama'],
            'tanggal_masuk' =>date("Y-m-d",strtotime($request['tanggal_masuk'])),
            'tahun_ajar_id' =>$request['tahun_ajar_id'],
            'telpon_rumah' =>$request['telpon_rumah'],
            'sekolah_asal_id' =>$request['sekolah_asal_id'],
            'kelas_awal_id' =>$request['kelas_awal_id'],
			'status'=>$request['kelas_awal_id'],
            'anak_ke' =>$request['anak_ke'],
            'ayah' =>$request['ayah'],
            'ibu' =>$request['ibu'],
            'wali' =>$request['wali'],
            'pekerjaan_ayah_id' =>$request['pekerjaan_ayah_id'],
            'pekerjaan_ibu_id' =>$request['pekerjaan_ibu_id'],
            'pekerjaan_wali_id' =>$request['pekerjaan_wali_id'],
            'alamat_ortu'=>$request['alamat_ortu'],
            'alamat_wali' =>$request['alamat_wali'],
            'telpon_rumah_ortu' =>$request['telpon_rumah_ortu'],
            'telpon_rumah_wali' =>$request['telpon_rumah_wali'],
            ]);
        return redirect(action('AdminSiswaController@index'))->with('status','Data siswa baru telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa=Siswa::whereId($id)->firstOrFail();
        return view('admin.siswa.show',['siswa'=>$siswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa=Siswa::whereId($id)->firstOrFail();
        $kotas = Kota::all();
        $pekerjaans = Pekerjaan::all();
        $sekolahs=Sekolah::all();
        $tahunAjars = TahunAjar::all();
        $kelas = Kelas::all();
        return view('admin.siswa.edit',['siswa'=>$siswa,'kotas'=>$kotas, 'pekerjaans'=>$pekerjaans,'sekolahs'=>$sekolahs,'tahunAjars'=>$tahunAjars,'kelas'=>$kelas]);
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
        if($request['password']!=null)
        {
            $this->validate($request,[
            'name' => 'required|string|max:255',
            'password'=>'required|string|min:6',
            'nis'=>'required|string',
            'nisn'=>'required|string',
            'jenis_kelamin'=>'required',
            'tanggal_lahir'=>'required',
            'tempat_lahir_id'=>'required',
            'alamat'=>'required',
            'agama'=>'required',
            'tanggal_masuk'=>'required',
            'tahun_ajar_id'=>'required',
            'sekolah_asal_id'=>'required',
            'kelas_awal_id'=>'required',
            'anak_ke'=>'required|numeric',
            'ayah'=>'required',
            'ibu'=>'required',
            'pekerjaan_ayah_id'=>'required',
            'pekerjaan_ibu_id'=>'required',
            'pekerjaan_wali_id'=>'required',
            ]);
        }
        else{
            $this->validate($request,[
            'name' => 'required|string|max:255',
            'nis'=>'required|string',
            'nisn'=>'required|string',
            'jenis_kelamin'=>'required',
            'tanggal_lahir'=>'required',
            'tempat_lahir_id'=>'required',
            'alamat'=>'required',
            'agama'=>'required',
            'tanggal_masuk'=>'required',
            'tahun_ajar_id'=>'required',
            'sekolah_asal_id'=>'required',
            'kelas_awal_id'=>'required',
            'anak_ke'=>'required|numeric',
            'ayah'=>'required',
            'ibu'=>'required',
            'pekerjaan_ayah_id'=>'required',
            'pekerjaan_ibu_id'=>'required',
            'pekerjaan_wali_id'=>'required',
            ]);
        }
        $siswa=Siswa::findOrfail($id);
        $siswa->nis =$request['nis'];
        $siswa->nisn=$request['nisn'];
        $siswa->jenis_kelamin=$request['jenis_kelamin'];
        $siswa->tanggal_lahir=date("Y-m-d",strtotime($request['tanggal_lahir']));
        $siswa->tempat_lahir_id=$request['tempat_lahir_id'];
        $siswa->alamat =$request['alamat'];
        $siswa->agama =$request['agama'];
        $siswa->tanggal_masuk =date("Y-m-d",strtotime($request['tanggal_masuk']));
        $siswa->tahun_ajar_id =$request['tahun_ajar_id'];
        $siswa->telpon_rumah =$request['telpon_rumah'];
        $siswa->sekolah_asal_id =$request['sekolah_asal_id'];
        $siswa->kelas_awal_id =$request['kelas_awal_id'];
		$siswa->status = $request['kelas_awal_id'];
        $siswa->anak_ke = $request['anak_ke'];
        $siswa->ayah =$request['ayah'];
        $siswa->ibu=$request['ibu'];
        $siswa->wali =$request['wali'];
        $siswa->pekerjaan_ayah_id =$request['pekerjaan_ayah_id'];
        $siswa->pekerjaan_ibu_id =$request['pekerjaan_ibu_id'];
        $siswa->pekerjaan_wali_id =$request['pekerjaan_wali_id'];
        $siswa->alamat_ortu=$request['alamat_ortu'];
        $siswa->alamat_wali =$request['alamat_wali'];
        $siswa->telpon_rumah_ortu =$request['telpon_rumah_ortu'];
        $siswa->telpon_rumah_wali =$request['telpon_rumah_wali'];
        $user=User::findOrFail($siswa->user->id);
        $user->name = $request['name'];
        if($request['password']!=null)
        {
            $this->validate($request,[
            'password'=>'required|string|min:6',
            ]);
            $user->password=bcrypt($request['password']);
        }
        $siswa->save();
        $user->save();
        return redirect(action('AdminSiswaController@edit',['id'=>$id]))->with('status','Data siswa telah disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
		$siswa->forceDelete();
		$siswa->user->forceDelete();
		return redirect(action('AdminSiswaController@index'))->with('status','Data siswa telah dihapus');
    }

	public function keluarPindah($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('admin.siswakeluarpindah.create', ['siswa'=>$siswa]);
    }

	public function semester($id){
		$siswa = Siswa::findOrFail($id);
        return view('admin.siswa.semester', ['siswa'=>$siswa]);
	}

	public function rapor($id){
		$semesterSiswa=SemesterSiswa::findOrFail($id);
		$statusKelulusan="";
		$sekolah = IdentitasSekolah::findOrFail(1);
		if($semesterSiswa->semester->gasal_genap==2){
			//dapatkan status lulus
			$daftarKelas=DaftarKelas::where('siswa_id',$semesterSiswa->siswa->id)->where('kelas_buka_id',$semesterSiswa->kelasBuka->id)->first();
			if($daftarKelas->status_lulus){
				if($daftarKelas->kelasBuka->kelas->tingkat==7 || $daftarKelas->kelasBuka->kelas->tingkat==8){
 					$statusKelulusan.="Berdasar hasil perolehan nilai semester 1 dan semester 2, siswa dinyatakan NAIK KE KELAS ".($daftarKelas->kelasBuka->kelas->tingkat+1);
 				}
 				else{
 					$statusKelulusan.="Berdasar hasil perolehan nilai semester 1 dan semester 2, siswa dinyatakan LULUS";
				}
			}
			else{
				$statusKelulusan.="Berdasar hasil perolehan nilai semester 1 dan semester 2, siswa dinyatakan TINGGAL DI KELAS ".($daftarKelas->kelasBuka->kelas->tingkat);
			}
		}
		$kelompoks = Kelompok::all();
		return view('admin.siswa.rapor',['sekolah'=>$sekolah,'semesterSiswa'=>$semesterSiswa,'kelompoks'=>$kelompoks,'statusKelulusan'=>$statusKelulusan]);
	}
}
