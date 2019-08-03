<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Response;
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
    public function index(Request $request)
    {
		/*$data = DB::select('select id,name,email,role from users');
		
        return view('home',['user'=>$data]);*/
		if($request->ajax())
		{
			$data = DB::select('select id,name,email,role from users');
			return Datatables::of($data)->addColumn('action',function($row){
				$btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a>';
				
				$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>';
				
				return $btn;
			})->rawColumns(['action'])->make(true);
		}
		 return view('home');
		
    }
	public function update($id)
	{
		
		$data = DB::select('select id,name,email,role from users where id=?',[$id]);
			
		return Response()->json($data);	
			
		//return view('updateView',['user'=>$data[0]]);
	}
	public function userUpdate(Request $request)
	{
		$name = $request->txtname;
		$id = $request->txtid;
		$role= $request->txtrole;
		$email = $request->txtemail;
		
		DB::update('update users set name=?,role=?,email=? where id=?',[$name,$role,$email,$id]);
		
		return Response()->json(['success'=>'User Updated']);	
		//return redirect()->route('home');
	}
	public function delete($id)
	{
		DB::delete('delete from users where id=?',[$id]);
			
		return Response()->json(['success'=>'User deleted']);	
		//return redirect()->route('home');
	}
}
