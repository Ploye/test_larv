<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    protected $fillable =['tag_id'];
    protected $table = 'taggables';
    function posts(){
        return $this->morphedByMany('App\Post','taggable');
    }

    function videos(){
        return $this->morphToMany('App\Video','taggable');
    }
}
