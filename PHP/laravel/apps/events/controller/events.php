<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\handleFile;
use App\filezz as zz;
use App\event as ev;

class events extends Controller
{
	use handleFile;
    //add event
    public function addEvent(Request $Request){
    	//check if is post
    	if( $request->isMethod("post")   ){
    		//check for name
    		if ($request->name) {
    			$det['name']=$request->name;
    		}
    		//check for venue
    		if($request->venue){
    			$det['venue']=$reques->venue;

    		}
    		//check for image
    		if ($request->image) {
    			//check if file exists
    			$fing=zz::find($request->image);
    			if ($fing) {
    				$det['file_id']=$requesst->image;
    			}
    			else{
    				$resp['error']="Oops....failed to upload image.";
    			}

    			
    		}
    		//add event
    		if( !empty($det) ){
    			//add
    			$vb=ev::create($det);
    			//check if added
    			if ($vb) {
    				$resp['msg']="Event ".$vb->name." added successfully.";
    			}
    			else{
    				$resp['error']="Oops....An error occured .Failed to add event.";

    			}

    		}
    		else{
    			$resp['error']="Oops....Something happened couldn't add event.";
    		}

    	}else{
    		$resp['err4']=abort(404)->render();
    	}
    	return response()->json($resp);

    }
    //delete event 
    public function deleteEvent(Request $reuest){
    	//check if is post
    	if ($request->isMethod('post')   ) {
    		//check if id is present
    		if($request->id){

    		}
    		else{
    			$resp['error']="Oops...Error.Couldn't delete event.";
    		}
    		
    	}
    	else{
    		$resp['err4']=abort(404);
    	}
    	return response()->json($resp);


    }
    //update event
    public function  updateEvent(){

    }
    //admin view event
    public function adminViewEvent(){

    }
    //user view event
    public function userViewEvent(){

    }
    //return add event form
    public function addEventForm(){

    }
    //return update event form 
    public function updateEventForm(){

    }
}
