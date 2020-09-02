<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class test2 extends Model
{
    protected $table = 'test2' ;
    protected $guarded = [];
    public $timestamps = false;

    public function donthuoc()
    {
        return $this->hasMany('App\test1','id_donthuoc','id_thuoc');
    }
}
