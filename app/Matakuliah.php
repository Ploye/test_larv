<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'kode_matakuliah';
    public $incrementing = false;
    protected $keyType = 'char';

    //Many ri Many Inverse
    public function dosens(){
            return $this->belongsToMany('App\Dosen', 'jadwal', 'kode_matakuliah', 'nidn');
        
    }
}
