<?php

namespace App\Http\Controllers;

use App\Communities;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use View;

class UsersController extends Controller
{
    public function change_password(Request $request){
        $validation = Validator::make($request->all(), [
            'old_password' => 'required',
            'password_confirmation' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        $user = User::where('id','=',Auth::user()->id)->first();
        if(Hash::make($request->old_password) != $user->password){
            return json_encode(['status'=> 'false', 'message'=> array(["Old Password does not match"])]);
        }

        $user->password = Hash::make($request->password_confirmation);
        $user->updated_at = date('yy-m-d h:m:s');
        $user->updated_by = Auth::user()->name;

        if($user->save()){
            return json_encode(['status'=> 'true', 'message'=> 'success']);
        }
    }

    public function change_profile(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        $user = User::where('id','=',Auth::user()->id)->first();
        if($user->email != $request->email){
            $validation = Validator::make($request->all(), [
                'email' => 'unique:users',
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $user->email = $request->email;
        }

        $user->name = $request->name;
        $user->updated_at = date('yy-m-d h:m:s');
        $user->updated_by = Auth::user()->name;

        if($user->save()){
            return json_encode(['status'=> 'true', 'message'=> 'success']);
        }
    }

    public function my_profile(){
        $data = Communities::where('user_id','=',Auth::user()->id)->get();

        $pageVars = [
            'data' => $data
        ];

        return View::make('user.my_profile')->with($pageVars);
    }
}
