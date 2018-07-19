<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    //
    protected $table="replies";
    protected $fillable=["name","email","text","comment_id"];
    public function  comments(){
    	return $this->belongTo("App\comment","comment_id");

    }
}
