<?php

namespace App\Http\Controllers;

use App\Communities;
use App\Helper\Helper;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Communities::where('row_status','=','active')
            ->where('publish_status','=','publish')
            ->where('type','=','article')
            ->orWhere('type','=','paper')
            ->paginate(Helper::page());

        $pageVars = [
            'data' => $data,
            'icon'=>'layout',
            'title'=> 'Article',
            'subtitle' => 'List Of Article',
            'form_name' => 'Table of Article'
        ];

        return View::make('home')->with($pageVars);
    }

    public function admin()
    {
        if(Auth::user()->role == 'administrator'){
            return view('admin.index');
        }
        return view('home');
    }

    public function new_user(Request $request){
        $validation = Validator::make($request->all(), [
            'identity_number' => 'required',
            'password_confirmation' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => 'required'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        $profession = $request->profession;
        if($request->role == "dosen"){
            $profession = "Dosen";
        }elseif($request->role == "mahasiswa"){
            $profession = "Mahasiswa";
        }

        $data_insert = array(
            'identity_number' => $request->identity_number,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'profession' => $profession,
        );

        if(User::create($data_insert)){
            Helper::set_user_pending_count();
            return json_encode(['status'=> 'true', 'message'=> 'success']);
        }

        return json_encode(['status'=> 'true', 'message'=> 'success']);
    }
}
