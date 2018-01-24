<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //
	protected  $fillable=[
	    "name","phone","email","service"
	];
}
