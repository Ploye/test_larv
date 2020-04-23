<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title','path'];
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
