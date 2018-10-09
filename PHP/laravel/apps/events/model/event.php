<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    //
    protected $fillable=['name','venue','file_id'];
    //add 1 to 1 with files
    public function  filez(){
    	return $this->hasOne('App\file';)

    }
}
