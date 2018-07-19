<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //
    protected $fillable=["post","tag","title","feature","link"];

    public function comments(){
    	return $this->hasMany("App\comment");
    }
    public function tags(){
    	return $this->hasOne('App\tag');
    }
    public function blogPhotos(){
    	return $this->hasMany('App\blogPhoto');
    }
   

}
