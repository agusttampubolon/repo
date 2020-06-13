<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Communities extends Model
{
    protected $table = 'communities';
    protected $fillable = [
        'id','code','row_status','publish_status','type', 'title','major', 'abstract_eng','abstract_ind','subject','author_1','author_2','author_3','author_4','author_5','user_id','isbn_issn','advisor','issued_date','publisher','publication_place','upload_file','submitted_date','cover_pdf','cover_image','chapter_1','chapter_2','chapter_3','chapter_4','chapter_5','lock_chapter_3','lock_chapter_4','lock_chapter_5','lock_reference','lock_appendix','reference','appendix','created_at','created_by','updated_at','updated_by','approved_at','approved_by','remark','notes','data_revision','is_revised'
    ];
}
