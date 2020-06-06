<?php

namespace App\Http\Controllers;

use App\Communities;
use Illuminate\Http\Request;
use View;

class CommunitiesController extends Controller
{
    public function detail($code){
        $data = Communities::where('code','=',$code)
            ->where('row_status','=','active')
            ->where('publish_status','=','publish')
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
}
