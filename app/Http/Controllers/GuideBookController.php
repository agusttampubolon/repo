<?php

namespace App\Http\Controllers;

use App\Communities;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use View;
use Yajra\DataTables\Facades\DataTables;

class GuideBookController extends Controller
{
    public function index(Request $request){
        $submitted = $request->submitted ? $request->submitted : date('yy');
        $issued_date = $request->issued_date ? $request->issued_date : date('yy');

        $query = "type='guide book' and row_status='active' and publish_status='publish' and issued_date={$issued_date} and submitted_date={$submitted}";
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

        return View::make('guide_book.index')->with($pageVars);
    }

    public function admin_index(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Guide Book',
            'subtitle' => 'List Of Guide Book',
            'form_name' => 'Table of Guide Book'
        ];

        return View::make('admin.guide_book.index')->with($pageVars);
    }

    public function admin_add(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Guide Book',
            'subtitle' => 'Add New Guide Book',
            'form_name' => 'Guide Book Form',
            'years'=> Helper::get_year()
        ];

        return View::make('admin.guide_book.new')->with($pageVars);
    }

    public function admin_edit($id){
        $data = Communities::where('id','=',$id)->first();
        $pageVars = [
            'data'=>$data,
            'icon'=>'layout',
            'title'=> 'Guide Book',
            'subtitle' => 'Edit Guide Book',
            'form_name' => 'Guide Book Form',
            'years'=>Helper::get_year()
        ];

        return View::make('admin.guide_book.edit')->with($pageVars);
    }

    public function add(){
        $years = [];
        for($i=0;$i<=20;$i++){
            $years[$i] = date('yy')-$i;
        }
        $pageVars = [
            'years'=>$years
        ];
        return View::make('guide_book.add')->with($pageVars);
    }

    public function submit(Request $request){
        $data = $request->all();
        $code = uniqid("gb");

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

        $data['upload_file'] = $code.'_gbook.'.$request->upload_file->getClientOriginalExtension();

        $data_insert = array(
            'row_status' => "active",
            'code'=>$code,
            'title' => $data['title'],
            'type'=> "guide book",
            'author_1' => $data['author_1'],
            'publish_status'=>'publish',
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
            $upload_file->move(public_path('assets/upload/guide-book/'.$code), $data['upload_file']);

            Helper::set_top_category();
        }

        return json_encode(['status'=> 'true', "success"]);
    }

    public function update(Request $request){
        $data = $request->all();
        $guide_book = Communities::where('id','=', $data['id'])->first();
        $new_code = uniqid("ar");

        if(!$guide_book){
            return json_encode(['status'=> 'true', 'message'=>"Data not found"]);
        }

        $validation = Validator::make($request->all(), [
            'title' => 'required',
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
            $guide_book->upload_file = $new_code.'_gbook.'.$request->upload_file->getClientOriginalExtension();

            $upload_file = $request->file('upload_file');
            $upload_file->move(public_path('assets/upload/guide-book/'.$guide_book->code),$guide_book->upload_file);
        }

        $guide_book->title = $data['title'];
        $guide_book->author_1 = $data['author_1'];
        $guide_book->publisher = $data['publisher'];
        $guide_book->publication_place = $data['publication_place'];
        $guide_book->issued_date = $data['issued_date'];
        $guide_book->isbn_issn = $data['isbn_issn'];
        $guide_book->updated_by = Auth::user()->name;
        $guide_book->updated_at = date('yy-m-d h:m:s');

        if($guide_book->save()){
            return json_encode(['status'=> 'true', 'message'=>""]);
        }
        return json_encode(['status'=> 'false', 'message'=>""]);
    }

    public function paging_all(Request $request){
        return DataTables::of(Communities::where('type','=','guide book')->get())->addIndexColumn()->make(true);
    }
}
