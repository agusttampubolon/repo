<?php

namespace App\Http\Controllers;

use App\Communities;
use App\Helper\Helper;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use View;
use Yajra\DataTables\DataTables;

class ArticleController extends Controller
{
    public function index(Request $request){
        $submitted = $request->submitted ? $request->submitted : date('yy');
        $issued_date = $request->issued_date ? $request->issued_date : date('yy');

        $query = "type='article' and row_status='active' and publish_status='publish' and issued_date={$issued_date} and submitted_date={$submitted}";
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

        return View::make('article.index')->with($pageVars);
    }

    public function admin_index(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Article',
            'subtitle' => 'List Of Article',
            'form_name' => 'Table of Article'
        ];

        return View::make('admin.article.index')->with($pageVars);
    }

    public function admin_publish(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Article - Publish',
            'subtitle' => 'List Of Article',
            'form_name' => 'Table of Article'
        ];

        return View::make('admin.article.publish')->with($pageVars);
    }

    public function admin_unpublish(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Article - Unpublish',
            'subtitle' => 'List Of Article',
            'form_name' => 'Table of Article'
        ];

        return View::make('admin.article.unpublish')->with($pageVars);
    }

    public function admin_rejected(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Article - Rejected',
            'subtitle' => 'List Of Article',
            'form_name' => 'Table of Article'
        ];

        return View::make('admin.article.rejected')->with($pageVars);
    }

    public function admin_pending(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Article - Pending',
            'subtitle' => 'List Of Article',
            'form_name' => 'Table of Article'
        ];

        return View::make('admin.article.pending')->with($pageVars);
    }

    public function admin_add(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Article',
            'subtitle' => 'Create New Article',
            'form_name' => 'Article Form',
            'years'=>Helper::get_year()
        ];

        return View::make('admin.article.new')->with($pageVars);
    }

    public function admin_edit($id){
        $data = Communities::where('id','=',$id)->first();
        $pageVars = [
            'data'=>$data,
            'icon'=>'layout',
            'title'=> 'Article',
            'subtitle' => 'Create New Article',
            'form_name' => 'Article Form',
            'years'=>Helper::get_year()
        ];

        return View::make('admin.article.edit')->with($pageVars);
    }

    public function edit($id){
        $data = Communities::where('id','=',$id)->first();
        $pageVars = [
            'data'=>$data,
            'icon'=>'layout',
            'title'=> 'Student Paper',
            'subtitle' => 'Edit Student Paper',
            'form_name' => 'Student Paper Form',
            'years'=>Helper::get_year()
        ];

        return View::make('article.edit')->with($pageVars);
    }

    public function add(){
        $years = [];
        for($i=0;$i<=20;$i++){
            $years[$i] = date('yy')-$i;
        }
        $pageVars = [
            'years'=>$years
        ];
        return View::make('article.add')->with($pageVars);
    }

    public function submit(Request $request){
        $data = $request->all();
        $code = uniqid("ar");

        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'publish_status' => 'required',
            'abstract_eng' => 'required',
            'author_1' => 'required',
            'publisher' => 'required',
            'publication_place' => 'required',
            'issued_date' => 'required',
            'upload_file' => 'required|mimes:pdf|max:2048',
            'cover_image' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        $data['upload_file'] = $code.'_article.'.$request->upload_file->getClientOriginalExtension();
        $data['cover_image'] = $code.'_cover.'.$request->cover_image->getClientOriginalExtension();

        $data_insert = array(
            'code'=>$code,
            'title' => $data['title'],
            'type'=> "article",
            'publish_status' => $data['publish_status'],
            'abstract_eng' => $data['abstract_eng'],
            'author_1' => $data['author_1'],
            'author_2' => $data['author_2'],
            'author_3' => $data['author_3'],
            'author_4' => $data['author_4'],
            'author_5' => $data['author_5'],
            'user_id' => Auth::user()->id,
            'publisher' => $data['publisher'],
            'publication_place' => $data['publication_place'],
            'issued_date' => $data['issued_date'],
            'isbn_issn' => $data['isbn_issn'],
            'subject' => $data['subject'],
            'upload_file' => $data['upload_file'],
            'cover_image' => $data['cover_image'],
            'created_by' => Auth::user()->name,
            'created_at' => date('yy-m-d h:m:s'),
            'submitted_date' => date('yy')
        );

        if(Auth::user()->role =="administrator"){
            $data_insert['row_status'] = "active";
        }

        if(Communities::firstOrCreate($data_insert)){
            if($data['subject']!= ""){
                $subject_insert=[];
                $header = ['communities_code','subject_name'];
                $arr_subject = explode(",",$data['subject']);

                foreach ($arr_subject as $subject){
                    array_push($subject_insert,array_combine($header,[$code,ltrim($subject)]));
                }

                Subject::insert($subject_insert);
            }

            $upload_file = $request->file('upload_file');
            $upload_file->move(public_path('assets/upload/article/'.$code), $data['upload_file']);

            $cover_image = $request->file('cover_image');
            $cover_image->move(public_path('assets/upload/article/'.$code), $data['cover_image']);

            Helper::set_article_pending_count();
            Helper::set_top_category();
        }

        return json_encode(['status'=> 'true', 'message'=>""]);
    }

    public function update(Request $request){
        $data = $request->all();
        $article = Communities::where('id','=', $data['id'])->first();
        $new_code = uniqid("ar");

        if(!$article){
            return json_encode(['status'=> 'true', 'message'=>"Data not found"]);
        }

        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'publish_status' => 'required',
            'abstract_eng' => 'required',
            'author_1' => 'required',
            'publisher' => 'required',
            'publication_place' => 'required',
            'issued_date' => 'required'
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
            $article->upload_file = $new_code.'_article.'.$request->upload_file->getClientOriginalExtension();

            $upload_file = $request->file('upload_file');
            $upload_file->move(public_path('assets/upload/article/'.$article->code),$article->upload_file);
        }

        if(array_key_exists("cover_image", $data)){
            $validation = Validator::make($request->all(), [
                'cover_image' => 'mimes:jpeg,jpg,png|max:2048'
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $article->cover_image = $new_code.'_cover.'.$request->cover_image->getClientOriginalExtension();

            $cover_image = $request->file('cover_image');
            $cover_image->move(public_path('assets/upload/article/'.$article->code), $article->cover_image);
        }

        $article->title = $data['title'];
        $article->publish_status = $data['publish_status'];
        $article->abstract_eng = $data['abstract_eng'];
        $article->author_1 = $data['author_1'];
        $article->author_2 = $data['author_2'];
        $article->author_3 = $data['author_3'];
        $article->author_4 = $data['author_4'];
        $article->author_5 = $data['author_5'];
        $article->publisher = $data['publisher'];
        $article->publication_place = $data['publication_place'];
        $article->issued_date = $data['issued_date'];
        $article->isbn_issn = $data['isbn_issn'];
        $article->subject = $data['subject'];
        $article->updated_by = Auth::user()->name;
        $article->updated_at = date('yy-m-d h:m:s');

        if($article->save()){
            if($data['subject']!= ""){
                if($data['subject'] != $article->subject){
                    $subject_insert=[];
                    $header = ['communities_code','subject_name'];
                    $arr_subject = explode(",",$data['subject']);

                    foreach ($arr_subject as $subject){
                        array_push($subject_insert,array_combine($header,[$article->code,ltrim($subject)]));
                    }

                    Subject::insert($subject_insert);
                }
            }else{
                Subject::where('communities_code','=',$article->code)->delete();
            }

            Helper::set_subject_count();
            Helper::set_article_pending_count();
        }

        return json_encode(['status'=> 'true', 'message'=>""]);
    }

    public function submit_revise(Request $request){
        $data = $request->all();
        $paper = Communities::where('id','=',$data['id'])->first();
        $arr = explode(',',$paper->data_revision);
        $arr_validation = [];
        foreach ($arr as $item){
            $arr_validation[$item] = "required";
        }
        $validation = Validator::make($data,$arr_validation);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        $fileName = uniqid();

        if($request->cover_image){
            $data['cover_image'] = $fileName.'_cover_image.'.$request->cover_image->getClientOriginalExtension();
            $validation = Validator::make($request->all(), [
                'cover_image' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $cover_image = $request->file('cover_image');
            $cover_image->move(public_path('assets/upload/student-paper/'.$paper->code), $data['cover_image']);
        }

        if($request->upload_file){
            $data['upload_file'] = $fileName.'_article.'.$request->upload_file->getClientOriginalExtension();
            $validation = Validator::make($request->all(), [
                'upload_file' => 'required|mimes:pdf|max:2048',
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $upload_file= $request->file('upload_file');
            $upload_file->move(public_path('assets/upload/article/'.$paper->code), $data['upload_file']);
        }

        $data['updated_at'] = date('Y-m-d h:m:s');
        $data['updated_by'] = Auth::user()->nama;
        $data['is_revised'] = 0;

        unset($data['id']);
        $update = Communities::where('id','=',$request->id)->update($data);

        if($update){
            return json_encode(['status'=> 'true', 'message'=>""]);
        }

        return json_encode(['status'=> 'false', 'message'=>""]);

    }

    public function paging_all(Request $request){
        return DataTables::of(Communities::where('type','=','article')->get())->addIndexColumn()->make(true);
    }

    public function paging_pending(Request $request){
        return DataTables::of(Communities::where('type','=','article')->where('row_status','=','pending')->get())->addIndexColumn()->make(true);
    }

    public function paging_rejected(Request $request){
        return DataTables::of(Communities::where('type','=','article')->where('row_status','=','rejected')->get())->addIndexColumn()->make(true);
    }

    public function paging_publish(Request $request){
        return DataTables::of(Communities::where('type','=','article')->where('publish_status','=','publish')->get())->addIndexColumn()->make(true);
    }

    public function paging_unpublish(Request $request){
        return DataTables::of(Communities::where('type','=','article')->where('publish_status','=','unpublish')->get())->addIndexColumn()->make(true);
    }
}
