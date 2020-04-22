<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Dosen extends Model
{
    use SoftDeletes;
    protected $table = 'dosen';
    protected $primaryKey = 'nidn';
    public $incrementing = false;
    protected $keyType = 'char';
    protected $attributes = [
        'status' => 1
    ];

    protected $fillable = [
        'nidn',
        'nama',
        'keterangan'
    ];
}
