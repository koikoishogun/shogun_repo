<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\subscriber as sub;
use App\Mail\confirm;

class subscribers extends Controller
{
    //add subscribers
	public function add_subscriber( Request $request,sub $subz){
		$det=["name"=>$request->name,"email"=>$request->email,"phone"=>$request->phone];
		$nsu=$subz::create($det);
		$ert=$subz::where("email",$request->email)->first();
		if($ert){
			/*$rtym="Thank you for subscribing  to our mailing list we will send you newsletters periodically";
			$senr=Mail::to($request->email)->send(new confirm( $request->name,$rtym) );
			if($senr == null ){
			   return "Successfully subscribed to mailing list .A confirmation email has been sent  to ".$request->email." .";	
			}
			else{
				return "Successfully subscribed to mailing list .";
			}*/
			return "Oops....the email ".$request->email." is already subscribed.";
			
			
		}
		if($nsu){
			$rtym="Thank you for subscribing  to our mailing list we will send you newsletters periodically";
			$senr=Mail::to($request->email)->send(new confirm( $request->name,$rtym) );
			if($senr == null ){
			   return "Successfully subscribed to mailing list .A confirmation email has been sent  to ".$request->email." .";	
			}
			else{
				return "Successfully subscribed to mailing list .";
			}
			
			
		}
		else{
			return "Error.Failed to add subscriber.";
		}
		
	}
	//return all subs
	public function view_subscriber( sub $subz){
		$subscribd=$subz::orderBy("created_at","desc")->SimplePaginate(5);
		$su_count=$subz::all()->count();
		$resp['html'] = view("subscribers.view",["subz"=>$subscribd,"sub_count"=>$su_count])->render();
		return response()->json($resp);
		
	}
	
	//delete subscribers
	public function delete_subscribers( int $id,sub $subz){
	  $del_sub=$subz::destroy($id);
	  if($del_sub){
		 return $this->view_subscriber($subz); 
	  }
	  else{
		  $resp['error']="Error.Failed to delete subscriber.";
	  }
	  return response()->json($resp);
		
		
	}
	
}
