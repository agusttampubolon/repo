<?php

namespace App\Http\Controllers;

use App\Communities;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use View;
use Yajra\DataTables\Facades\DataTables;

class ArchiveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request){
        $submitted = $request->submitted ? $request->submitted : date('yy');
        $issued_date = $request->issued_date ? $request->issued_date : date('yy');

        $query = "type='archive' and row_status='active' and publish_status='publish' and issued_date={$issued_date} and submitted_date={$submitted}";
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

        return View::make('archive.index')->with($pageVars);
    }

    public function admin_index(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Archive',
            'subtitle' => 'List Of Archive',
            'form_name' => 'Table of Archive'
        ];

        return View::make('admin.archive.index')->with($pageVars);
    }

    public function admin_publish(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Archive - Publish',
            'subtitle' => 'List Of Archive',
            'form_name' => 'Table of Archive'
        ];

        return View::make('admin.archive.publish')->with($pageVars);
    }

    public function admin_unpublish(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Archive - Unpublish',
            'subtitle' => 'List Of Archive',
            'form_name' => 'Table of Archive'
        ];

        return View::make('admin.archive.unpublish')->with($pageVars);
    }

    public function admin_add(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Archive - New',
            'subtitle' => 'List Of Archive',
            'form_name' => 'Table of Archive',
            'years'=>Helper::get_year()
        ];

        return View::make('admin.archive.new')->with($pageVars);
    }

    public function admin_edit($id){
        $data = Communities::where('id','=',$id)->first();
        $pageVars = [
            'data'=>$data,
            'icon'=>'layout',
            'title'=> 'Archive',
            'subtitle' => 'Edit Archive',
            'form_name' => 'Archive Form',
            'years'=>Helper::get_year()
        ];

        return View::make('admin.archive.edit')->with($pageVars);
    }

    public function submit(Request $request){
        $data = $request->all();
        $code = uniqid("ar");

        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'author_1' => 'required',
            'publish_status' => 'required',
            'publisher' => 'required',
            'publication_place' => 'required',
            'issued_date' => 'required',
            'upload_file' => 'required|mimes:pdf|max:2048'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        $data['upload_file'] = $code.'_archive.'.$request->upload_file->getClientOriginalExtension();

        $data_insert = array(
            'row_status' => "active",
            'code'=>$code,
            'title' => $data['title'],
            'type'=> "archive",
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
            $upload_file->move(public_path('assets/upload/archive/'.$code), $data['upload_file']);
        }
        Helper::set_top_category();
        return json_encode(['status'=> 'true', "success"]);
    }

    public function update(Request $request){
        $data = $request->all();
        $archive = Communities::where('id','=', $data['id'])->first();
        $new_code = uniqid("ar");

        if(!$archive){
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
            $archive->upload_file = $new_code.'_archive.'.$request->upload_file->getClientOriginalExtension();

            $upload_file = $request->file('upload_file');
            $upload_file->move(public_path('assets/upload/archive/'.$archive->code),$archive->upload_file);
        }

        $archive->publish_status = $data['publish_status'];
        $archive->title = $data['title'];
        $archive->author_1 = $data['author_1'];
        $archive->publisher = $data['publisher'];
        $archive->publication_place = $data['publication_place'];
        $archive->issued_date = $data['issued_date'];
        $archive->isbn_issn = $data['isbn_issn'];
        $archive->updated_by = Auth::user()->name;
        $archive->updated_at = date('yy-m-d h:m:s');

        if($archive->save()){
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
        return View::make('archive.add')->with($pageVars);
    }

    public function paging_all(Request $request){
        return DataTables::of(Communities::where('type','=','archive')->get())->addIndexColumn()->make(true);
    }

    public function paging_publish(Request $request){
        return DataTables::of(Communities::where('type','=','archive')->where('publish_status','=','publish')->get())->addIndexColumn()->make(true);
    }

    public function paging_unpublish(Request $request){
        return DataTables::of(Communities::where('type','=','archive')->where('publish_status','=','unpublish')->get())->addIndexColumn()->make(true);
    }
}
