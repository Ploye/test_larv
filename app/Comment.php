<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{   
    protected $fillable =['content'];
    function commentable(){
        return $this->morphTo();
    }
    function video(){
        return $this->belongsTo('App\Video');
    }
    function post(){
        return $this->belongsTo('App\Post');
    }
}
