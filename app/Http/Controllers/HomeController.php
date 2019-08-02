<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$data = DB::select('select id,name,email,role from users');
		
        return view('home',['user'=>$data]);
    }
	public function update($id)
	{
		
		$data = DB::select('select id,name,email,role from users where id=?',[$id]);

		return view('updateView',['user'=>$data[0]]);
	}
	public function userUpdate(Request $request)
	{
		$name = $request->txtname;
		$id = $request->txtid;
		$role= $request->txtrole;
		$email = $request->txtemail;
		
		DB::update('update users set name=?,role=?,email=? where id=?',[$name,$role,$email,$id]);
	
		return redirect()->route('home');
	}
	public function delete($id)
	{
		DB::delete('delete from users where id=?',[$id]);
	
		return redirect()->route('home');
	}
}
