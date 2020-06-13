<?php

namespace App\Http\Controllers;

use App\Communities;
use App\DownloadHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use View;

class CommunitiesController extends Controller
{
    public function detail($code){
        $data = Communities::where('code','=',$code)
            ->orderBy('id','desc')
            ->first();

        if (!$data){
            return abort(404);
        }
        $pageVars = [
            'filter'=> 'Author',
            'data'=>$data
        ];

        return View::make('detail.index')->with($pageVars);
    }

    public function download($type,$code,$filetype,$filename)
    {
        clearstatcache();
        $arr_type = [
            "article"=>"article",
            "guide book"=>"guide-book",
            "book"=>"book",
            "monograph"=>"monograph",
            "paper"=>"student-paper",
            "archive"=>"archive",
            "others"=>"others",
        ];

        $file= public_path(). "/assets/upload/".$arr_type[$type]."/".$code."/".$filename;

        if(!file_exists($file)){
            return abort(404);
        }

        $communities = Communities::where('code','=',$code)->first();

        if($communities){
            $user_id = Auth::check() ? Auth::user()->id : 0;
            $download_history = array(
                'communities_id'=>$communities->id,
                'user_id'=>$user_id,
                'type'=>$arr_type[$type],
                'file_type'=>$filetype,
                'file_name'=>$filename
            );

            DownloadHistory::insert($download_history);

            $headers = array(
                'Content-Type: application/pdf',
            );

            return Response::download($file, $filename, $headers);
        }

        return abort(404);
    }
}
