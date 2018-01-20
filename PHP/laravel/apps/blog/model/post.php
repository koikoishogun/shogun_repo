<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //
	protected $fillable=["title","name","body","category","files"];
	public function comments(){
		return $this->hasMany('App\comment');
		
	}
}
