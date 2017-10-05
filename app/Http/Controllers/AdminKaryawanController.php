<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Karyawan;
use App\Kota;
use App\Ijazah;
use Auth;

class AdminKaryawanController extends Controller
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
        $karyawans = Karyawan::all();
        return view('admin.karyawan.index',['karyawans'=>$karyawans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kotas = Kota::all();
        $ijazahs = Ijazah::all();
        return view('admin.karyawan.create',['kotas'=>$kotas, 'ijazahs' =>$ijazahs]);
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
            'nik'=>'required',
            'password'=>'required|string|min:6',
            'jenis_kelamin'=>'required',
            'tanggal_lahir'=>'required',
            'tempat_lahir_id'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
            'ijazah_id'=>'required',
            'agama'=>'required',
		],[
			'username.unique'=>'Username harus unik',
            'nik.required'=>'NIK harus diisi',
			'password.min'=>'Password minimal 6 karakter',
			'jenis_kelamin.required'=>'Jenis kelamin harus diisi',
            'tanggal_lahir.required'=>'Tanggal lahir harus diisi',
            'tempat_lahir_id.required'=>'Tempat lahir tidak valid',
            'ijazah_id.required'=>'Ijazah tidak valid'
		]);
        $idUser = User::create([
            'name' => $request['name'],
            'username' =>$request['username'],
            'password' => bcrypt($request['password']),
            'role' => 2,
            ])->id;
        Karyawan::create([
            'user_id' => $idUser,
            'nik'=>$request['nik'],
            'super'=>0,
            'jenis_kelamin' =>$request['jenis_kelamin'],
            'tanggal_lahir' =>date("Y-m-d",strtotime($request['tanggal_lahir'])),
            'tempat_lahir_id' =>$request['tempat_lahir_id'],
            'alamat' =>$request['alamat'],
            'no_telp' =>$request['no_telp'],
            'ijazah_id' =>$request['ijazah_id'],
            'agama' =>$request['agama'],
            ]);
        return redirect(action('AdminKaryawanController@index'))->with('status','Data karyawan baru telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karyawan = Karyawan::whereId($id)->firstOrFail();
        $kotas = Kota::all();
        $ijazahs = Ijazah::all();
        return view('admin.karyawan.show',['karyawan'=>$karyawan, 'kotas'=>$kotas, 'ijazahs' =>$ijazahs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = Karyawan::whereId($id)->firstOrFail();
        $kotas = Kota::all();
        $ijazahs = Ijazah::all();
        return view('admin.karyawan.edit',['karyawan'=>$karyawan, 'kotas'=>$kotas, 'ijazahs' =>$ijazahs]);
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
            'name' => 'required|string|max:255',
            'nik'=>'required',
            'jenis_kelamin'=>'required',
            'tanggal_lahir'=>'required',
            'tempat_lahir_id'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
            'ijazah_id'=>'required',
            'agama'=>'required',
		],[
            'nik.required'=>'NIK harus diisi',
			'jenis_kelamin.required'=>'Jenis kelamin harus diisi',
            'tanggal_lahir.required'=>'Tanggal lahir harus diisi',
            'tempat_lahir_id.required'=>'Tempat lahir tidak valid',
            'ijazah_id.required'=>'Ijazah tidak valid',
		]);
        $karyawan = Karyawan::whereId($id)->firstOrFail();
        if($request['super']){
            $karyawan->super=$request['super'];
        }
        else{
            $karyawan->super=0;
        }
        $karyawan->nik =$request['nik'];
        $karyawan->jenis_kelamin =$request['jenis_kelamin'];
        $karyawan->tanggal_lahir =date("Y-m-d",strtotime($request['tanggal_lahir']));
        $karyawan->tempat_lahir_id =$request['tempat_lahir_id'];
        $karyawan->alamat =$request['alamat'];
        $karyawan->no_telp =$request['no_telp'];
        $karyawan->ijazah_id =$request['ijazah_id'];
        $karyawan->agama =$request['agama'];
        $user=User::whereId($karyawan->user->id)->firstOrFail();
        $user->name = $request['name'];
        if($request['password']!=null)
        {
            $this->validate($request,[
            'password'=>'required|string|min:6',
            ],[
				'password.min'=>'Password minimal 6 karakter',
			]);
            $user->password=bcrypt($request['password']);
        }
        $karyawan->save();
        $user->save();
        return redirect(action('AdminKaryawanController@edit',['id' => $id]))->with('status','Data karyawan telah diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      	$karyawan = Karyawan::findOrFail($id);
      	$karyawan->forceDelete();
      	$karyawan->user->forceDelete();
      	return redirect(action('AdminKaryawanController@index'))->with('status','Guru telah dihapus');
    }

	public function keluar($id)
	{
		$karyawan = Karyawan::findOrFail($id);
      	$karyawan->delete();
      	$karyawan->user->delete();
      	return redirect(action('AdminKaryawanController@index'))->with('status','Guru telah dikeluarkan');
	}
}
