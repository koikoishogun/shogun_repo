<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    //
    protected $fillable=["post_id","tag"];

    //relationship with posts
    public function  posts(){
    	return $this->belongsTo('App\post','post_id');

    }
}
