<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    function comment(){
        return $this->morphOne('App\Comment','commentable');
    }

    function comments(){
        return $this->morphMany('App\Comment','commentable');
    }

    function tags(){
        return $this->morphToMany('App\Tag','taggable');
    }
}
