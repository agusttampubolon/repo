<?php

namespace App\Http\Controllers;

use App\Communities;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use View;
use Yajra\DataTables\Facades\DataTables;

class OthersController extends Controller
{
    public function index(Request $request){
        $submitted = $request->submitted ? $request->submitted : date('yy');
        $issued_date = $request->issued_date ? $request->issued_date : date('yy');

        $query = "type='others' and row_status='active' and publish_status='publish' and issued_date={$issued_date} and submitted_date={$submitted}";
        if($request->char){
            $filter = $request->char;
            $query = "{$query} and title like '{$filter}%' or author_1 like '{$filter}%'";
        }

        if($request->keyword){
            $filter = $request->keyword;
            $query = "{$query} and title like '%{$filter}%'";
        }

        $data = Communities::whereRaw($query)
            ->orderBy('id','desc')
            ->paginate(Helper::page());

        $pageVars = [
            'data' => $data,
            'keyword' => $request->keyword,
            'submitted' =>$submitted,
            'issued_date'=>$issued_date,
            'char' =>$request->char,
        ];

        return View::make('others.index')->with($pageVars);
    }

    public function admin_index(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Others',
            'subtitle' => 'List Of Others',
            'form_name' => 'Table of Others'
        ];

        return View::make('admin.others.index')->with($pageVars);
    }

    public function admin_publish(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Others - Publish',
            'subtitle' => 'List Of Others',
            'form_name' => 'Table of Others'
        ];

        return View::make('admin.others.publish')->with($pageVars);
    }

    public function admin_unpublish(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Others - Unpublish',
            'subtitle' => 'List Of Others',
            'form_name' => 'Table of Others'
        ];

        return View::make('admin.others.unpublish')->with($pageVars);
    }

    public function admin_add(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Others - New',
            'subtitle' => 'List Of Others',
            'form_name' => 'Others Form',
            'years'=>Helper::get_year()
        ];

        return View::make('admin.others.new')->with($pageVars);
    }

    public function admin_edit($id){
        $data = Communities::where('id','=',$id)->first();
        $pageVars = [
            'data'=>$data,
            'icon'=>'layout',
            'title'=> 'Others',
            'subtitle' => 'Edit Others',
            'form_name' => 'Others Form',
            'years'=>Helper::get_year()
        ];

        return View::make('admin.others.edit')->with($pageVars);
    }

    public function submit(Request $request){
        $data = $request->all();
        $code = uniqid("ot");

        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'author_1' => 'required',
            'publisher' => 'required',
            'publication_place' => 'required',
            'issued_date' => 'required',
            'upload_file' => 'required|mimes:pdf|max:2048'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        $data['upload_file'] = $code.'_others.'.$request->upload_file->getClientOriginalExtension();

        $data_insert = array(
            'row_status' => "active",
            'code'=>$code,
            'title' => $data['title'],
            'type'=> "others",
            'author_1' => $data['author_1'],
            'publish_status' => $data['publish_status'],
            'publisher' => $data['publisher'],
            'publication_place' => $data['publication_place'],
            'issued_date' => $data['issued_date'],
            'isbn_issn' => $data['isbn_issn'],
            'upload_file' => $data['upload_file'],
            'created_by' => Auth::user()->name,
            'created_at' => date('yy-m-d h:m:s'),
            'submitted_date' => date('yy')
        );

        if(Communities::firstOrCreate($data_insert)){
            $upload_file = $request->file('upload_file');
            $upload_file->move(public_path('assets/upload/others/'.$code), $data['upload_file']);

            Helper::set_top_category();
        }

        return json_encode(['status'=> 'true', "success"]);
    }

    public function update(Request $request){
        $data = $request->all();
        $others = Communities::where('id','=', $data['id'])->first();
        $new_code = uniqid("ar");

        if(!$others){
            return json_encode(['status'=> 'true', 'message'=>"Data not found"]);
        }

        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'publish_status' => 'required',
            'author_1' => 'required',
            'publisher' => 'required',
            'publication_place' => 'required',
            'issued_date' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        if(array_key_exists("upload_file", $data)){
            $validation = Validator::make($request->all(), [
                'upload_file' => 'mimes:pdf|max:2048'
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }
            $others->upload_file = $new_code.'_others.'.$request->upload_file->getClientOriginalExtension();

            $upload_file = $request->file('upload_file');
            $upload_file->move(public_path('assets/upload/others/'.$others->code),$others->upload_file);
        }

        $others->publish_status = $data['publish_status'];
        $others->title = $data['title'];
        $others->author_1 = $data['author_1'];
        $others->publisher = $data['publisher'];
        $others->publication_place = $data['publication_place'];
        $others->issued_date = $data['issued_date'];
        $others->isbn_issn = $data['isbn_issn'];
        $others->updated_by = Auth::user()->name;
        $others->updated_at = date('yy-m-d h:m:s');

        if($others->save()){
            return json_encode(['status'=> 'true', 'message'=>""]);
        }
        return json_encode(['status'=> 'false', 'message'=>""]);
    }

    public function add(){
        $years = [];
        for($i=0;$i<=20;$i++){
            $years[$i] = date('yy')-$i;
        }
        $pageVars = [
            'years'=>$years
        ];
        return View::make('others.add')->with($pageVars);
    }

    public function paging_all(Request $request){
        return DataTables::of(Communities::where('type','=','others')->get())->addIndexColumn()->make(true);
    }

    public function paging_publish(Request $request){
        return DataTables::of(Communities::where('type','=','others')->where('publish_status','=','publish')->get())->addIndexColumn()->make(true);
    }

    public function paging_unpublish(Request $request){
        return DataTables::of(Communities::where('type','=','others')->where('publish_status','=','unpublish')->get())->addIndexColumn()->make(true);
    }
}
