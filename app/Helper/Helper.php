<?php

namespace App\Helper;

use App\Communities;
use App\DownloadHistory;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class Helper
{
    protected static $CACHE_KEY_USER_PENDING = "__count_pending_user";
    protected static $CACHE_KEY_ARTICLE_PENDING = "__count_pending_article";
    protected static $CACHE_KEY_PAPER_PENDING = "__count_pending_paper";
    protected static $CACHE_KEY_SUBJECT_COUNT = "__count_subject";
    protected static $CACHE_KEY_AUTHOR_COUNT = "__count_author";
    protected static $CACHE_KEY_TOP_CATEGORY = "__top_category";
    protected static $CACHE_DOWNLOAD_COUNT = "__download_count";
    protected static $SLUG = ["paper"=>"student-paper","article"=>"article","book"=>"book","monograph"=>"monograph","guide book"=>"guide-book", "others"=> "others","archive"=>"archive"];

    public static function get_user_pending_count(){
        $count = Cache::get(self::$CACHE_KEY_USER_PENDING);

        if($count == null){
            $count = User::where('status','=','inactive')->get()->count();
            Cache::forever(self::$CACHE_KEY_USER_PENDING,$count == 0 ? "0" : $count);
        }
        return $count;
    }

    public static function set_user_pending_count(){
        Cache::forget(self::$CACHE_KEY_USER_PENDING);
    }

    public static function get_article_pending_count(){
        $count = Cache::get(self::$CACHE_KEY_ARTICLE_PENDING);

        if($count == null){
            $count = Communities::where('row_status','=','pending')->where('type','=','article')->get()->count();
            Cache::forever(self::$CACHE_KEY_ARTICLE_PENDING,$count == 0 ? "0" : $count);
        }
        return $count;
    }

    public static function set_article_pending_count(){
        Cache::forget(self::$CACHE_KEY_ARTICLE_PENDING);
    }

    public static function get_paper_pending_count(){
        $count = Cache::get(self::$CACHE_KEY_PAPER_PENDING);

        if($count == null){
            $count = Communities::where('row_status','=','pending')->where('type','=','paper')->get()->count();
            Cache::forever(self::$CACHE_KEY_PAPER_PENDING,$count == 0 ? "0" : $count);
        }
        return $count;
    }

    public static function set_paper_pending_count(){
        Cache::forget(self::$CACHE_KEY_PAPER_PENDING);
    }

    public static function get_year(){
        $years = [];
        for($i=0;$i<=20;$i++){
            $years[$i] = date('yy')-$i;
        }

        return $years;
    }

    public static function get_subject_count(){
        $count = Cache::get(self::$CACHE_KEY_SUBJECT_COUNT);

        if($count == null){
            $count = Communities::where('row_status','=','active')->where('publish_status','=','publish')
                ->join('subject','subject.communities_code', 'communities.code')
                ->select(DB::raw('subject_name, count(*) as count'))
                ->groupBy('subject_name')->paginate(10);

            Cache::forever(self::$CACHE_KEY_SUBJECT_COUNT,$count);
        }
        return $count;
    }

    public static function set_subject_count(){
        Cache::forget(self::$CACHE_KEY_SUBJECT_COUNT);
    }

    public static function get_author_count(){
        $count = Cache::get(self::$CACHE_KEY_AUTHOR_COUNT);

        if($count == null){
            $count = Communities::where('row_status','=','active')->where('publish_status','=','publish')
                ->select(DB::raw('author_1, count(*) as count'))
                ->groupBy('author_1')->paginate(10);

            Cache::forever(self::$CACHE_KEY_AUTHOR_COUNT,$count);
        }
        return $count;
    }

    public static function set_author_count(){
        Cache::forget(self::$CACHE_KEY_AUTHOR_COUNT);
    }

    public static function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
            array(1 , 'second')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return "{$print} ago";
    }

    public static function page(){
        return 15;
    }

    public static function get_top_category(){
        $count = Cache::get(self::$CACHE_KEY_TOP_CATEGORY);

        if($count == null){
            $count = Communities::where('row_status','=','active')->where('publish_status','=','publish')
                ->select(DB::raw('type, count(*) as count'))
                ->orderBy('count', 'desc')
                ->groupBy('type')->get();

            Cache::forever(self::$CACHE_KEY_TOP_CATEGORY,$count);
        }
        return $count;
    }

    public static function set_top_category(){
        Cache::forget(self::$CACHE_KEY_TOP_CATEGORY);
    }

    public static function get_download_count($id){
        $count = Cache::get(self::$CACHE_DOWNLOAD_COUNT);

        if($count == null){
            $count = DownloadHistory::where('communities_id','=',$id)->get()->count();
            Cache::put(self::$CACHE_DOWNLOAD_COUNT,$count == 0 ? "0" : $count,1800);
        }

        return $count;
    }

    public static function is_admin(){
        if(Auth::user()->role != 'administrator'){

            return abort(404);
        }
    }

    public static function get_slug($type){
        return self::$SLUG[$type];
    }
}