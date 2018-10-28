<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subscriber as sub;
use App\User as us;
use App\Notifications\newSuubscriber as nS;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\confirmSubscriber as coS;

class subscribers extends Controller
{
    //add subscribers
	public function add_subscriber( Request $request){
		//$det=["name"=>$request->name,"email"=>$request->email,"phone"=>$request->phone,"category"=>$request->cat];
		if($request->name){
			$det['name']=$request->name;

		}
		if($request->email){
			$det['email']=$request->email;
			
		}
		if($request->phone){
			$det['phone']=$request->phone;
		}
		if($request->cat){
			$det['category']=$request->cat;
			
		}
		$ert=sub::where("email",$request->email)->first();
		if($ert){
			/*$rtym="Thank you for subscribing  to our mailing list we will send you newsletters periodically";
			$senr=Mail::to($request->email)->send(new confirm( $request->name,$rtym) );
			if($senr == null ){
			   return "Successfully subscribed to mailing list .A confirmation email has been sent  to ".$request->email." .";	
			}
			else{
				return "Successfully subscribed to mailing list .";
			}*/
			$resp['msg']="Oops....the email ".$request->email." is already subscribed to our mailing list.";
			
			
		}
		else{
			    $nsu=sub::create($det);
				if($nsu){

					//get all admin users and notify
					//send notification
					//$getusers=us::all();
					//check if user is authenticated
					/*if ($getusers) {
						# send notification
						foreach ($getusers as  $value) {
							# notify all admins
							$value->notify( new nS($nsu) );
						   
						}
						



					}*/
					//send confirmation email to subscribers
					//Mail::to($nsu->email)->send( new  coS( $nsu  )    );
                    
					$resp['msg']="Successfully subscribed to mailing list. A confirmation email sent to ".$request->email." .";
					
				}
				else{
					$resp['error']="Ooops something happened.Failed to add subscriber.";
				}

		}
		
		return response()->json($resp);
		
	}
	//return all subs
	public function view_subscriber( sub $subz){
		$subzg=$subz::orderBy("created_at","desc")->SimplePaginate(10);
		$su_count=sub::all()->count();
		 $resp['html']=view("subscribers.view",["subz"=>$subzg,"sub_count"=>$su_count])->render();
		 return response()->json($resp);
		
	}
	
	//delete subscribers
	public function delete_subscribers( int $id,sub $subz){
	  $del_sub=sub::destroy($id);
	  if($del_sub){
	  	$ert=$this->view_subscriber();
	  	return $ert;
		 
	  }
	  else{
		  $resp['error']="Error.Failed to delete subscriber.";
	  }
	  return response()->json($resp);
		
		
	}
	
}
