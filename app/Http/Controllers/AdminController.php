<?php

namespace App\Http\Controllers;

use App\Communities;
use App\Helper\Helper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use View;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user_all(){
        $pageVars = [
            'icon'=>'users',
            'title'=> 'User',
            'subtitle' => 'List Of Users',
            'form_name' => 'Table of Users'
        ];
        return View::make('admin.user.index')->with($pageVars);
    }

    public function user_rejected(){
        $pageVars = [
            'icon'=>'users',
            'title'=> 'Rejected User',
            'subtitle' => 'List Of Rejected Users',
            'form_name' => 'Table of Rejected Users'
        ];
        return View::make('admin.user.rejected')->with($pageVars);
    }

    public function user_pending(){
        $pageVars = [
            'icon'=>'users',
            'title'=> 'User Request',
            'subtitle' => 'List Of Users Request',
            'form_name' => 'Table of Users Request'
        ];
        return View::make('admin.user.pending')->with($pageVars);
    }

    public function user_new(){
        $pageVars = [
            'icon'=>'users',
            'title'=> 'User Administrator',
            'subtitle' => 'New User',
            'form_name' => 'New Users Form'
        ];
        return View::make('admin.user.new')->with($pageVars);
    }

    public function user_update_status(Request $request){
        $data = User::where('email','=',$request->email)->first();
        if($data->status == 'inactive'){
            $data->approved_by = Auth::user()->name;
            $data->approved_date = date('yy-m-d h:m:s');
        }
        $data->status = $request->status;
        $data->updated_by = Auth::user()->name;
        $data->updated_at = date('yy-m-d h:m:s');

        if($data->save()){
            Helper::set_user_pending_count();
            return json_encode(['status'=> 'true', 'message'=> ""]);
        }
    }

    public function user_update_account(Request $request){
        $data = $request->all();
        $user = User::where('id','=',Auth::user()->id)->first();

        $validation = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        if($data['email'] != $user->email){
            $validation = Validator::make($request->all(), [
                'email' => 'required|unique:users'
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }
        }
        $user->name =$data['name'];
        $user->email =$data['email'];

        if($user->save()){
            return json_encode(['status'=> 'true', 'message'=> ""]);
        }
    }

    public function user_submit(Request $request){
        $data = $request->all();

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        if($data['password'] != $data['password_confirmation']){
            return json_encode(['status'=> 'false', 'message'=> array(["Password does not match"])]);
        }

        $data_insert = array(
            'name' => $data['name'],
            'role'=> "administrator",
            'email' => $data['email'],
            'status'=>'active',
            'password' => Hash::make($data['password_confirmation']),
            'created_at' => date('yy-m-d h:m:s')
        );

        if(User::firstOrCreate($data_insert)){
            return json_encode(['status'=> 'true', 'message'=> ""]);
        }
    }

    public function user_all_paging(Request $request){
        return DataTables::of(User::get())->addIndexColumn()->make(true);
    }

    public function user_rejected_paging(Request $request){
        return DataTables::of(User::where('status','=','rejected')->get())->addIndexColumn()->make(true);
    }

    public function user_pending_paging(Request $request){
        return DataTables::of(User::where('status','=','inactive')->get())->addIndexColumn()->make(true);
    }

    public function user_change_password(Request $request){
        $input = $request->all();
        $data = DB::table('users')->where('email' , '=',$input['email'])->first();
        if($data){
            if(!$input['new_password'] || $input['new_password'] == ''){
                return json_encode(["status"=> 'false', "message"=> "New Password is mandatory"]);
            }else if (!$input['confirmation_password'] || $input['confirmation_password'] ==''){
                return json_encode(["status"=> 'false', "message"=> "Password Confirmation is mandatory"]);
            }

            if($input['new_password'] != $input['confirmation_password']){
                return json_encode(["status"=> 'false', "message"=> "Password doesn't match"]);
            }

            $newdata = array('password' => Hash::make($input['confirmation_password']));
            if(DB::table('users')->where('id' , '=',Auth::user()->id)->update($newdata)){
                return json_encode(["status"=> 'true', "message"=> "Password has been Updated"]);
            }else{
                return json_encode(["status"=> 'false', "message"=> "Something went wrong"]);
            }
        }else{
            return json_encode(["status"=> 'false', "message"=> "Data not found"]);
        }
    }

    public function approve(Request $request){
        $data = $request->all();
        $communities = Communities::where('id','=', $data['id'])->first();

        if(!$communities){
            return json_encode(['status'=> 'true', 'message'=>"Data not found"]);
        }

        $communities->row_status="active";
        $communities->approved_by = Auth::user()->name;
        $communities->approved_at = date('yy-m-d h:m:s');

        if(!$communities->save()){
            return json_encode(['status'=> 'false', 'message'=>""]);
        }

        if($communities->type == "article"){
            Helper::set_article_pending_count();
        }elseif($communities->type == "paper"){
            Helper::set_paper_pending_count();
        }
        Helper::set_top_category();
        return json_encode(['status'=> 'true', 'message'=>""]);
    }

    public function reject(Request $request){
        $data = $request->all();
        $communities = Communities::where('id','=', $data['id'])->first();

        if(!$communities){
            return json_encode(['status'=> 'true', 'message'=>"Data not found"]);
        }

        $communities->row_status="active";
        $communities->approved_by = Auth::user()->name;
        $communities->approved_at = date('yy-m-d h:m:s');

        if(!$communities->save()){
            return json_encode(['status'=> 'false', 'message'=>""]);
        }

        if($communities->type == "rejected"){
            Helper::set_article_pending_count();
        }elseif($communities->type == "paper"){
            Helper::set_paper_pending_count();
        }

        return json_encode(['status'=> 'true', 'message'=>""]);
    }

    public function delete(Request $request){
        $data = $request->all();
        $communities = Communities::where('id','=', $data['id'])->first();

        if(!$communities){
            return json_encode(['status'=> 'true', 'message'=>"Data not found"]);
        }

        $communities->row_status="active";
        $communities->updated_by = Auth::user()->name;
        $communities->updated_at = date('yy-m-d h:m:s');

        if(!$communities->save()){
            return json_encode(['status'=> 'false', 'message'=>""]);
        }

        if($communities->type == "deleted"){
            Helper::set_article_pending_count();
        }elseif($communities->type == "paper"){
            Helper::set_paper_pending_count();
        }
        Helper::set_top_category();

        return json_encode(['status'=> 'true', 'message'=>""]);
    }
}