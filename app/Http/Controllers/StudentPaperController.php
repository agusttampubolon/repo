<?php

namespace App\Http\Controllers;

use App\Communities;
use App\Helper\Helper;
use App\User;
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

    public function admin_revision(){
        $pageVars = [
            'icon'=>'layout',
            'title'=> 'Student Paper',
            'subtitle' => 'Add New Student Paper',
            'form_name' => 'Student Paper Form',
            'years'=>Helper::get_year()
        ];

        return View::make('admin.student_paper.revision')->with($pageVars);
    }

    public function user(Request $request){
        $pageVars = [
            'filter'=>$request->filter,
            'icon'=>'layout',
            'title'=> 'Student Paper',
            'subtitle' => '',
            'form_name' => 'List of Users',
        ];

        return View::make('admin.student_paper.user')->with($pageVars);
    }

    public function user_submitted_detail($id){
        $user = User::where('id','=',$id)->first();
        $pageVars = [
            'data'=>$user,
            'icon'=>'layout',
            'title'=> "Student Paper",
            'subtitle' => "",
            'form_name' => "Submitted by : " .$user->name,
        ];

        return View::make('admin.student_paper.user_paper')->with($pageVars);
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
            'cover_pdf' => 'required|mimes:pdf|max:2048',
            'chapter_1' => 'required|mimes:pdf|max:2048',
            'chapter_2' => 'required|mimes:pdf|max:2048',
            'chapter_3' => 'required|mimes:pdf|max:2048',
            'chapter_4' => 'required|mimes:pdf|max:2048',
            'chapter_5' => 'required|mimes:pdf|max:2048',
            'reference' => 'required|mimes:pdf|max:2048',
            'appendix' => 'required|mimes:pdf|max:2048',
            'cover_image' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        $data['cover_pdf'] = $code.'_paper_cover.'.$request->cover_pdf->getClientOriginalExtension();
        $data['chapter_1'] = $code.'_paper_chapter_1.'.$request->chapter_1->getClientOriginalExtension();
        $data['chapter_2'] = $code.'_paper_chapter_2.'.$request->chapter_2->getClientOriginalExtension();
        $data['chapter_3'] = $code.'_paper_chapter_3.'.$request->chapter_3->getClientOriginalExtension();
        $data['chapter_4'] = $code.'_paper_chapter_4.'.$request->chapter_4->getClientOriginalExtension();
        $data['chapter_5'] = $code.'_paper_chapter_5.'.$request->chapter_5->getClientOriginalExtension();
        $data['cover_image'] = $code.'_paper.'.$request->cover_image->getClientOriginalExtension();
        $data['reference'] = $code.'_paper_reference.'.$request->reference->getClientOriginalExtension();
        $data['appendix'] = $code.'_paper_appendix.'.$request->appendix->getClientOriginalExtension();

        $data_insert = array(
            'code'=>$code,
            'title' => $data['title'],
            'type'=> "paper",
            'major'=> $data['major'],
            'publish_status' => "publish",
            'abstract_eng' => $data['abstract_eng'],
            'author_1' => $data['author_1'],
            'user_id' => Auth::user()->id,
            'publisher' => $data['publisher'],
            'publication_place' => $data['publication_place'],
            'issued_date' => $data['issued_date'],
            'cover_pdf' => $data['cover_pdf'],
            'chapter_1' => $data['chapter_1'],
            'chapter_2' => $data['chapter_2'],
            'chapter_3' => $data['chapter_3'],
            'chapter_4' => $data['chapter_4'],
            'chapter_5' => $data['chapter_5'],
            'reference' => $data['reference'],
            'appendix' => $data['appendix'],
            'cover_image' => $data['cover_image'],
            'lock_chapter_3'=>$request->lock_chapter_3 ? $request->lock_chapter_3 : 0,
            'lock_chapter_4'=>$request->lock_chapter_4 ? $request->lock_chapter_4 : 0,
            'lock_chapter_5'=>$request->lock_chapter_5 ? $request->lock_chapter_5 : 0,
            'lock_reference'=>$request->lock_reference ? $request->lock_reference : 0,
            'lock_appendix'=>$request->lock_appendix ? $request->lock_appendix : 0,
            'created_by' => Auth::user()->name,
            'created_at' => date('yy-m-d h:m:s'),
            'submitted_date' => date('yy')
        );

        if(Auth::user()->role =="administrator"){
            $data_insert['row_status'] = "active";
        }

        if(Communities::firstOrCreate($data_insert)){
            $cover_pdf = $request->file('cover_pdf');
            $cover_pdf->move(public_path('assets/upload/student-paper/'.$code), $data['cover_pdf']);

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

            $reference = $request->file('reference');
            $reference->move(public_path('assets/upload/student-paper/'.$code), $data['reference']);

            $appendix = $request->file('appendix');
            $appendix->move(public_path('assets/upload/student-paper/'.$code), $data['appendix']);

            Helper::set_paper_header_count();
            Helper::set_paper_pending_count();
            Helper::set_top_category();
            Helper::set_author_count();
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
                'chapter_1' => 'mimes:pdf|max:2048',
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
                'chapter_2' =>  'mimes:pdf|max:2048',
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
                'chapter_3' =>  'mimes:pdf|max:2048',
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
                'chapter_4' =>  'mimes:pdf|max:2048',
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
                'chapter_5' =>  'mimes:pdf|max:2048',
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $paper->chapter_5 = $new_code.'_paper_chapter_5.'.$request->chapter_5->getClientOriginalExtension();

            $chapter_5 = $request->file('chapter_5');
            $chapter_5->move(public_path('assets/upload/student-paper/'.$paper->code), $paper->chapter_5);
        }

        if(array_key_exists("reference", $data)){
            $validation = Validator::make($request->all(), [
                'reference' =>  'mimes:pdf|max:2048',
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $paper->reference = $new_code.'_paper_reference.'.$request->reference->getClientOriginalExtension();

            $reference = $request->file('chapter_5');
            $reference->move(public_path('assets/upload/student-paper/'.$paper->code), $paper->reference);
        }

        if(array_key_exists("appendix", $data)){
            $validation = Validator::make($request->all(), [
                'appendix' =>  'mimes:pdf|max:2048',
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $paper->appendix = $new_code.'_paper_appendix.'.$request->appendix->getClientOriginalExtension();

            $appendix = $request->file('appendix');
            $appendix->move(public_path('assets/upload/student-paper/'.$paper->code), $paper->appendix);
        }

        if(array_key_exists("cover_pdf", $data)){
            $validation = Validator::make($request->all(), [
                'cover_pdf' =>  'mimes:pdf|max:2048',
            ]);
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $paper->cover_pdf = $new_code.'_paper_cover_pdf.'.$request->cover_pdf->getClientOriginalExtension();

            $cover_pdf = $request->file('cover_pdf');
            $cover_pdf->move(public_path('assets/upload/student-paper/'.$paper->code), $paper->cover_pdf);
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
            Helper::set_paper_header_count();
            Helper::set_top_category();
            Helper::set_author_count();
            return json_encode(['status'=> 'true', 'message'=>""]);
        }

        return json_encode(['status'=> 'false', 'message'=>""]);
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

        if($request->chapter_1){
            $data['chapter_1'] = $fileName.'_paper_chapter_1.'.$request->chapter_1->getClientOriginalExtension();
            $validation = Validator::make($request->all(), [
                'chapter_1' => 'required|mimes:pdf|max:2048',
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $chapter_1 = $request->file('chapter_1');
            $chapter_1->move(public_path('assets/upload/student-paper/'.$paper->code), $data['chapter_1']);
        }

        if($request->chapter_2){
            $data['chapter_2'] = $fileName.'_paper_chapter_2.'.$request->chapter_3->getClientOriginalExtension();
            $validation = Validator::make($request->all(), [
                'chapter_2' => 'required|mimes:pdf|max:2048',
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $chapter_2 = $request->file('chapter_2');
            $chapter_2->move(public_path('assets/upload/student-paper/'.$paper->code), $data['chapter_2']);
        }

        if($request->chapter_3){
            $data['chapter_3'] = $fileName.'_paper_chapter_3.'.$request->chapter_3->getClientOriginalExtension();
            $validation = Validator::make($request->all(), [
                'chapter_3' => 'required|mimes:pdf|max:2048',
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $chapter_3 = $request->file('chapter_3');
            $chapter_3->move(public_path('assets/upload/student-paper/'.$paper->code), $data['chapter_3']);
        }

        if($request->chapter_4){
            $data['chapter_4'] = $fileName.'_paper_chapter_4.'.$request->chapter_4->getClientOriginalExtension();
            $validation = Validator::make($request->all(), [
                'chapter_4' => 'required|mimes:pdf|max:2048',
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $chapter_4 = $request->file('chapter_4');
            $chapter_4->move(public_path('assets/upload/student-paper/'.$paper->code), $data['chapter_4']);
        }

        if($request->chapter_5){
            $data['chapter_5'] = $fileName.'_paper_chapter_5.'.$request->chapter_5->getClientOriginalExtension();
            $validation = Validator::make($request->all(), [
                'chapter_5' => 'required|mimes:pdf|max:2048',
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $chapter_5 = $request->file('chapter_5');
            $chapter_5->move(public_path('assets/upload/student-paper/'.$paper->code), $data['chapter_5']);
        }

        if($request->reference){
            $data['reference'] = $fileName.'_paper_reference.'.$request->reference->getClientOriginalExtension();
            $validation = Validator::make($request->all(), [
                'reference' => 'required|mimes:pdf|max:2048',
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $reference = $request->file('reference');
            $reference->move(public_path('assets/upload/student-paper/'.$paper->code), $data['reference']);
        }

        if($request->appendix){
            $data['appendix'] = $fileName.'_paper_appendix.'.$request->appendix->getClientOriginalExtension();
            $validation = Validator::make($request->all(), [
                'appendix' => 'required|mimes:pdf|max:2048',
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $appendix = $request->file('appendix');
            $appendix->move(public_path('assets/upload/student-paper/'.$paper->code), $data['appendix']);
        }

        if($request->cover_pdf){
            $data['cover_pdf'] = $fileName.'_paper_cover.'.$request->cover_pdf->getClientOriginalExtension();
            $validation = Validator::make($request->all(), [
                'cover_pdf' => 'required|mimes:pdf|max:2048',
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            $cover_pdf = $request->file('cover_pdf');
            $cover_pdf->move(public_path('assets/upload/student-paper/'.$paper->code), $data['cover_pdf']);
        }

        $data['updated_at'] = date('Y-m-d h:m:s');
        $data['updated_by'] = Auth::user()->nama;
        $data['is_revised'] = 0;

        unset($data['id']);
        $update = Communities::where('id','=',$request->id)->update($data);

        if($update){
            Helper::set_paper_revision_count();
            Helper::set_paper_header_count();
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

        return View::make('student_paper.edit')->with($pageVars);
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

    public function paging_revision(Request $request){
        return DataTables::of(Communities::where('type','=','paper')->where('row_status','=','revised')->get())->addIndexColumn()->make(true);
    }

    public function paging_user($id, Request $request){
        return DataTables::of(Communities::where('type','=','paper')->get())->addIndexColumn()->make(true);
    }
}
