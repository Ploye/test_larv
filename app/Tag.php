<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    function posts(){
        return $this->morphedByMany('App\Post','taggable');
    }

    function videos(){
        return $this->morphToMany('App\Video','taggable');
    }
}
