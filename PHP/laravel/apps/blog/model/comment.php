<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable=["name","email","post_id","message"];
	public function post(){
		return $this->belongsTo("App\post",'post_id');
	}
}
