<?php

namespace App\Http\Controllers;

use App\Communities;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;

class FilterController extends Controller
{
    public function all(Request $request){
        $data = null;
        if($request->keyword){
            $data = Communities::
                orWhere('title','like','%'.$request->keyword.'%')
                ->orWhere('author_1','like','%'.$request->keyword.'%')
                ->orWhere('abstract_eng','like','%'.$request->keyword.'%')
                ->orWhere('issued_date','like','%'.$request->keyword.'%')
                ->orWhere('subject','like','%'.$request->keyword.'%')
                ->where('row_status','=','active')
                ->where('publish_status','=','publish')
                ->orderBy('id','desc')
                ->paginate(Helper::page());
        }

        $pageVars = [
            'filter'=> 'All',
            'title' => 'Search result for <u>'.$request->keyword.'</u>',
            'data' => $data
        ];

        return View::make('filter.result')->with($pageVars);
    }

    public function author($author){
        $data = Communities::where('author_1','=',$author)
            ->where('row_status','=','active')
            ->where('publish_status','=','publish')
            ->orderBy('id','desc')
            ->paginate(Helper::page());

        $pageVars = [
            'filter'=> 'Author',
            'title' => 'Search result for <u>'.$author.'</u>',
            'data'=>$data
        ];

        return View::make('filter.result')->with($pageVars);
    }

    public function subject($subject){
        $data = Communities::where('subject_name','=',$subject)
            ->where('row_status','=','active')
            ->where('publish_status','=','publish')
            ->join('subject','subject.communities_code','=','communities.code')
            ->orderBy('communities.id','desc')
            ->paginate(Helper::page());

        $pageVars = [
            'filter'=> 'Subject',
            'title' => 'Search result for <u>'. $subject .'</u>',
            'data'=>$data
        ];

        return View::make('filter.result')->with($pageVars);
    }

    public function filter_by_issued(Request $request){
        $data = [];
        $issued_date = $request->issued_date ? $request->issued_date : date('yy');
        if($request->keyword){
            $data = Communities::
                orWhere('title','like','%'.$request->keyword.'%')
                ->orWhere('author_1','like','%'.$request->keyword.'%')
                ->orWhere('abstract_eng','like','%'.$request->keyword.'%')
                ->orWhere('issued_date','like','%'.$request->keyword.'%')
                ->orWhere('subject','like','%'.$request->keyword.'%')
                ->where('issued_date','=',$issued_date)
                ->where('row_status','=','active')
                ->where('publish_status','=','publish')
                ->orderBy('id','desc')
                ->paginate(Helper::page());
        }else{
            $data = Communities::where('issued_date','=',$issued_date)
                ->where('row_status','=','active')
                ->where('publish_status','=','publish')
                ->orderBy('id','desc')
                ->paginate(Helper::page());
        }

        $pageVars = [
            'data'=>$data,
            'keyword' => $request->keyword,
            'issued_date'=>$issued_date
        ];

        return View::make('filter.issued_date')->with($pageVars);
    }

    public function filter_by_title(Request $request){
        if($request->char){
            $data = Communities::orderBy('id','asc')
                ->where('title','like', $request->char.'%')
                ->where('publish_status','=','publish')
                ->paginate(Helper::page());
        }elseif ($request->keyword){
            $data = Communities::orderBy('id','asc')
                ->where('title','like', '%'.$request->keyword.'%')
                ->where('publish_status','=','publish')
                ->paginate(Helper::page());
        }else{
            $data = Communities::orderBy('id','asc')
                ->where('publish_status','=','publish')
                ->paginate(Helper::page());
        }

        $pageVars = [
            'data'=>$data,
            'keyword'=>$request->keyword
        ];

        return View::make('filter.title')->with($pageVars);
    }

    public function filter_by_author(Request $request){
        if($request->char){
            $data = Communities::orderBy('id','asc')
                ->where('author_1','like', $request->char.'%')
                ->where('publish_status','=','publish')
                ->paginate(Helper::page());
        }elseif ($request->keyword){
            $data = Communities::orderBy('id','asc')
                ->where('author_1','like', '%'.$request->keyword.'%')
                ->where('publish_status','=','publish')
                ->paginate(Helper::page());
        }else{
            $data = Communities::orderBy('id','asc')
                ->where('publish_status','=','publish')
                ->paginate(Helper::page());
        }

        $pageVars = [
            'data'=>$data,
            'keyword'=>$request->keyword
        ];

        return View::make('filter.author')->with($pageVars);
    }

    public function filter_by_subject(Request $request){
        if($request->char){
            $data = Communities::orderBy('id','asc')
                ->where('subject','like', $request->char.'%')
                ->where('publish_status','=','publish')
                ->paginate(Helper::page());
        }elseif ($request->keyword){
            $data = Communities::orderBy('id','asc')
                ->where('subject','like', '%'.$request->keyword.'%')
                ->where('publish_status','=','publish')
                ->paginate(Helper::page());
        }else{
            $data = Communities::orderBy('id','asc')
                ->where('publish_status','=','publish')
                ->paginate(Helper::page());
        }

        $pageVars = [
            'data'=>$data,
            'keyword'=>$request->keyword
        ];

        return View::make('filter.subject')->with($pageVars);
    }

    public function filter_by_type(Request $request){
        $data = Communities::where('row_status','active')
            ->where('publish_status','publish')
            ->select(DB::raw('type, count(*) as count'))
            ->groupBy('type')->get();

        $pageVars = [
            'data'=>$data
        ];

        return View::make('filter.types')->with($pageVars);
    }

    public function filter_by_submitted_date(Request $request){
        $data = [];
        $submitted_date = $request->submitted_date ? $request->submitted_date : date('yy');
        if($request->keyword){
            $data = Communities::
            orWhere('title','like','%'.$request->keyword.'%')
                ->orWhere('author_1','like','%'.$request->keyword.'%')
                ->orWhere('abstract_eng','like','%'.$request->keyword.'%')
                ->orWhere('issued_date','like','%'.$request->keyword.'%')
                ->orWhere('subject','like','%'.$request->keyword.'%')
                ->where('issued_date','=',$submitted_date)
                ->where('row_status','=','active')
                ->where('publish_status','=','publish')
                ->orderBy('id','desc')
                ->paginate(Helper::page());
        }else{
            $data = Communities::where('issued_date','=',$submitted_date)
                ->where('row_status','=','active')
                ->where('publish_status','=','publish')
                ->orderBy('id','desc')
                ->paginate(Helper::page());
        }

        $pageVars = [
            'data'=>$data,
            'keyword' => $request->keyword,
            'submitted_date'=>$submitted_date
        ];

        return View::make('filter.submitted_date')->with($pageVars);
    }
}
