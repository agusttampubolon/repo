<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadHistory extends Model
{
    protected $table = 'download_history';
    protected $fillable = [
        'id','communities_id','user_id','type','file_type','file_name'
    ];
}
