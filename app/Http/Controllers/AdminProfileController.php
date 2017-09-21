<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\TahunAjar;

class AdminProfileController extends Controller
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
        //
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
        return view('admin.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tahunAjar = TahunAjar::whereId($id)->firstOrFail();
        return view('admin.tahunajar.edit',['tahunAjar'=>$tahunAjar]);
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
        $admin=User::whereId($id)->firstOrFail();
        if($request['password']!=null && $request['password_confirmation']!=null)
        {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]);
            $admin->name=$request['name'];
            $admin->password=bcrypt($request['password']);
        }
        else{
            $this->validate($request, [
                'name' => 'required|string|max:255',
            ]);
            $admin->name=$request['name'];
        }
        $admin->save();
        return redirect(action('AdminProfileController@show',['id'=>$id]))->with('status','Data telah diperbaharui');
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
