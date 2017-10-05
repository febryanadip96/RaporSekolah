<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::check()){
            if(\Auth::user()->role==1){
                return redirect('admin/home');
            }
            else if(\Auth::user()->role==2){
                if(\Auth::user()->karyawan->deleted_at==null)
                {
                    return redirect('guru/home');
                }
                else
                {
                    \Auth::logout();
                }
            }
            else if(\Auth::user()->role==3){
				if(\Auth::user()->siswa->deleted_at==null)
                {
                    return redirect('siswa/home');
                }
                else
                {
                    \Auth::logout();
                }
            }
        }
        return redirect('login');
    }
}
