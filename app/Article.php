<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    
    protected $table = "articles";
    
    protected $fillable = [
        'title', 'content', 'photo', 'created_by', 'topic'
    ];


}
