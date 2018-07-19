<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class filezz extends Model
{
    //
    protected $fillable=["file","name","type","size","path"];

    public function   blogPhotos(){
    	return $this->hasMany('App\blogPhoto');

    }
     public function   productPhotos(){
    	return $this->hasMany('App\productPhoto');

    }
}
