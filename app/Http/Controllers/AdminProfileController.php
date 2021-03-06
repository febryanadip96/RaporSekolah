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
        $this->middleware('kepalasekolah');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
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
        abort(404);
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
        return view('admin.profile');
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
        abort(404);
    }
}
