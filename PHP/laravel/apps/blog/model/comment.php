<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //
    protected $fillable=["post_id","comment","name","email"];
    public function  posts(){
    	return $this->belongsTo('App\post','post_id');

    }
    public function replies(){
    	return $this->hasMany('App\reply','comment_id');
    }
}
