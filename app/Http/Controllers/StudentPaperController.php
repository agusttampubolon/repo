<?php

namespace App\Http\Controllers;

use App\Communities;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use View;
use Yajra\DataTables\Facades\DataTables;

class StudentPaperController extends Controller
{
    public function index(Request $request){
        $submitted = $request->submitted ? $request->submitted : date('yy');
        $issued_date = $request->issued_date ? $request->issued_date : date('yy');

        $query = "type='paper' and row_status='active' and publish_status='publish' and issued_date={$issued_date} and submitted_date={$submitted}";
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
            'title'=> 'Student Paper',
            'subtitle' => 'List Of Student Paper',
            'form_name' => 'Table of Student Paper'
        ];

        return View::make('admin.student_paper.index')->with($pageVars);
    }

    public function admin_rejected(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Student Paper - Rejected',
            'subtitle' => 'List Of Student Paper',
            'form_name' => 'Table of Student Paper'
        ];

        return View::make('admin.student_paper.rejected')->with($pageVars);
    }

    public function admin_pending(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Student Paper - Pending',
            'subtitle' => 'List Of Student Paper',
            'form_name' => 'Table of Student Paper'
        ];

        return View::make('admin.student_paper.pending')->with($pageVars);
    }

    public function admin_add(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Student Paper',
            'subtitle' => 'Add New Student Paper',
            'form_name' => 'Student Paper Form',
            'years'=>Helper::get_year()
        ];

        return View::make('admin.student_paper.new')->with($pageVars);
    }

    public function admin_edit($id){
        $data = Communities::where('id','=',$id)->first();
        $pageVars = [
            'data'=>$data,
            'icon'=>'layout',
            'title'=> 'Student Paper',
            'subtitle' => 'Edit Student Paper',
            'form_name' => 'Student Paper Form',
            'years'=>Helper::get_year()
        ];

        return View::make('admin.student_paper.edit')->with($pageVars);
    }

    public function submit(Request $request){
        $data = $request->all();
        $code = uniqid("sp");

        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'abstract_eng' => 'required',
            'author_1' => 'required',
            'publisher' => 'required',
            'publication_place' => 'required',
            'issued_date' => 'required',
            'chapter_1' => 'required|mimes:pdf|max:2048',
            'chapter_2' => 'required|mimes:pdf|max:2048',
            'chapter_3' => 'required|mimes:pdf|max:2048',
            'chapter_4' => 'required|mimes:pdf|max:2048',
            'chapter_5' => 'required|mimes:pdf|max:2048',
            'cover_image' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        $data['chapter_1'] = $code.'_paper_chapter_1.'.$request->chapter_1->getClientOriginalExtension();
        $data['chapter_2'] = $code.'_paper_chapter_2.'.$request->chapter_2->getClientOriginalExtension();
        $data['chapter_3'] = $code.'_paper_chapter_3.'.$request->chapter_3->getClientOriginalExtension();
        $data['chapter_4'] = $code.'_paper_chapter_4.'.$request->chapter_4->getClientOriginalExtension();
        $data['chapter_5'] = $code.'_paper_chapter_5.'.$request->chapter_5->getClientOriginalExtension();
        $data['cover_image'] = $code.'_paper.'.$request->cover_image->getClientOriginalExtension();

        $data_insert = array(
            'code'=>$code,
            'title' => $data['title'],
            'type'=> "paper",
            'publish_status' => "publish",
            'abstract_eng' => $data['abstract_eng'],
            'author_1' => $data['author_1'],
            'publisher' => $data['publisher'],
            'publication_place' => $data['publication_place'],
            'issued_date' => $data['issued_date'],
            'chapter_1' => $data['chapter_1'],
            'chapter_2' => $data['chapter_2'],
            'chapter_3' => $data['chapter_3'],
            'chapter_4' => $data['chapter_4'],
            'chapter_5' => $data['chapter_5'],
            'cover_image' => $data['cover_image'],
            'created_by' => Auth::user()->name,
            'created_at' => date('yy-m-d h:m:s'),
            'submitted_date' => date('yy')
        );

        if(Auth::user()->role =="administrator"){
            $data_insert['row_status'] = "active";
        }

        if(Communities::firstOrCreate($data_insert)){
            $chapter_1 = $request->file('chapter_1');
            $chapter_1->move(public_path('assets/upload/student-paper/'.$code), $data['chapter_1']);

            $chapter_2 = $request->file('chapter_2');
            $chapter_2->move(public_path('assets/upload/student-paper/'.$code), $data['chapter_2']);

            $chapter_3 = $request->file('chapter_3');
            $chapter_3->move(public_path('assets/upload/student-paper/'.$code), $data['chapter_3']);

            $chapter_4 = $request->file('chapter_4');
            $chapter_4->move(public_path('assets/upload/student-paper/'.$code), $data['chapter_4']);

            $chapter_5 = $request->file('chapter_5');
            $chapter_5->move(public_path('assets/upload/student-paper/'.$code), $data['chapter_5']);

            $cover_image = $request->file('cover_image');
            $cover_image->move(public_path('assets/upload/student-paper/'.$code), $data['cover_image']);

            Helper::set_paper_pending_count();
            Helper::set_top_category();
        }

        return json_encode(['status'=> 'true', 'message'=>""]);
    }

    public function update(Request $request){
        $data = $request->all();
        $paper = Communities::where('id','=', $data['id'])->first();
        $new_code = uniqid("ar");

        if(!$paper){
            return json_encode(['status'=> 'true', 'message'=>"Data not found"]);
        }

        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'abstract_eng' => 'required',
            'author_1' => 'required',
            'publisher' => 'required',
            'publication_place' => 'required',
            'issued_date' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        if(array_key_exists("cover_image", $data)){
            $validation = Validator::make($request->all(), [
                'cover_image' => 'mimes:jpeg,jpg,png|max:2048'
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $paper->cover_image = $new_code.'_paper.'.$request->cover_image->getClientOriginalExtension();

            $cover_image = $request->file('cover_image');
            $cover_image->move(public_path('assets/upload/student-paper/'.$paper->code), $paper->cover_image);
        }

        if(array_key_exists("chapter_1", $data)){
            $validation = Validator::make($request->all(), [
                'chapter_1' => 'mimes:jpeg,jpg,png|max:2048'
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $paper->chapter_1 = $new_code.'_paper_chapter_1.'.$request->chapter_1->getClientOriginalExtension();

            $chapter_1 = $request->file('chapter_1');
            $chapter_1->move(public_path('assets/upload/student-paper/'.$paper->code), $paper->chapter_1);
        }

        if(array_key_exists("chapter_2", $data)){
            $validation = Validator::make($request->all(), [
                'chapter_2' => 'mimes:jpeg,jpg,png|max:2048'
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $paper->chapter_2 = $new_code.'_paper_chapter_2.'.$request->chapter_2->getClientOriginalExtension();

            $chapter_2 = $request->file('chapter_2');
            $chapter_2->move(public_path('assets/upload/student-paper/'.$paper->code), $paper->chapter_2);
        }

        if(array_key_exists("chapter_3", $data)){
            $validation = Validator::make($request->all(), [
                'chapter_3' => 'mimes:jpeg,jpg,png|max:2048'
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $paper->chapter_3 = $new_code.'_paper_chapter_3.'.$request->chapter_3->getClientOriginalExtension();

            $chapter_3 = $request->file('chapter_3');
            $chapter_3->move(public_path('assets/upload/student-paper/'.$paper->code), $paper->chapter_3);
        }

        if(array_key_exists("chapter_4", $data)){
            $validation = Validator::make($request->all(), [
                'chapter_4' => 'mimes:jpeg,jpg,png|max:2048'
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $paper->chapter_4 = $new_code.'_paper_chapter_4.'.$request->chapter_4->getClientOriginalExtension();

            $chapter_4 = $request->file('chapter_4');
            $chapter_4->move(public_path('assets/upload/student-paper/'.$paper->code), $paper->chapter_4);
        }

        if(array_key_exists("chapter_5", $data)){
            $validation = Validator::make($request->all(), [
                'chapter_5' => 'mimes:jpeg,jpg,png|max:2048'
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $paper->chapter_5 = $new_code.'_paper_chapter_5.'.$request->chapter_5->getClientOriginalExtension();

            $chapter_5 = $request->file('chapter_5');
            $chapter_5->move(public_path('assets/upload/student-paper/'.$paper->code), $paper->chapter_5);
        }

        $paper->title = $data['title'];
        $paper->abstract_eng = $data['abstract_eng'];
        $paper->author_1 = $data['author_1'];
        $paper->publisher = $data['publisher'];
        $paper->publication_place = $data['publication_place'];
        $paper->issued_date = $data['issued_date'];
        $paper->updated_by = Auth::user()->name;
        $paper->updated_at = date('yy-m-d h:m:s');

        if($paper->save()){
            Helper::set_paper_pending_count();
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
        return View::make('student_paper.add')->with($pageVars);
    }

    public function detail(){
        return View::make('student_paper.detail');
    }

    public function paging_all(Request $request){
        return DataTables::of(Communities::where('type','=','paper')->get())->addIndexColumn()->make(true);
    }

    public function paging_rejected(Request $request){
        return DataTables::of(Communities::where('type','=','paper')->where('row_status','=','rejected')->get())->addIndexColumn()->make(true);
    }

    public function paging_pending(Request $request){
        return DataTables::of(Communities::where('type','=','paper')->where('row_status','=','pending')->get())->addIndexColumn()->make(true);
    }
}
