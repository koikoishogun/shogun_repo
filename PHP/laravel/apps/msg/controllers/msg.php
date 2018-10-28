<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\message;
use Illuminate\Support\Facades\Mail;
use App\Mail\confirm;
use App\user as us;
use App\Notifications\newMessage as nMsg;
use App\Mail\confirmMessage as cMs;

class msg extends Controller
{
    //create msg
	public function create_msg(Request $request,message $message){
		if($request->isMethod("POST")  ){
				/*$det=[
			 "name"=>$request->name,
			 "email"=>$request->email,
			 "phone"=>$request->phone,
			 "message"=>$request->msg
			 
			 ];*/
			 if($request->name){
			 	$det['name']=$request->name;

			 }
			 if($request->email){
			 	$det['email']=$request->email;

			 }
			 if($request->phone){
			 	$det['phone']=$request->phone;

			 }
			 $det['message']=$request->msg;
			
			 //$det['email']=$request->phone;

			 
			$em=$request->email;
			$msgs=$message::create($det);
			if($msgs){
				//return "message sent";
				//return var_dump($msgs);
				$ms_name=$request->name;
				$mdf="Thank you ".$ms_name." for messaging us.A confirmation email has been sent to ".$em.".";
				//$send_conf=Mail::to($em)->send(new confirm($mdf,$ms_name)  );
				$resp['msg']=$mdf;
				//send notification to admin
				//send notification
				//$getusers=us::all();
				//check if user is authenticated
				/*if ($getusers) {
					# send notification
					foreach ($getusers as  $value) {
						# notify all admins
						$value->notify( new nMsg($msgs) );
						//Mail::to('sydneysayeed@gmail.com')->send( new test);
					}



				}*/
				//return response()->json();
				//send confirmation email
				//Mail::to($em)->send( new cMs($msgs)    );
             }
			else{
				$resp['error']="Ooops an error occured in sending your message.";
			}


			
		}
		else{
			$resp["err4"]=abort(404)->render();

			
		}
	return response()->json($resp);	
 }
	//view msg
	public function view_msg(  message $message,$msg=null ){
		$msgs=$message::orderBy('created_at','desc')->SimplePaginate(10);
		$ccc=$message::all()->count();
		$wero=view("msg.view",["msg"=>$msgs,"count"=>$ccc])->render();
		$resp['html']=$wero;
			
		if($msg){
	          $resp["msg"]=$msg;
	     }
		

		return response()->json($resp);
		
		
	}
	//delete msg
	public function delete_msg(message $message,  $id){
		$msgss=$message::destroy($id);
		if($msgss){
			//return "Message deleted successfully";
			$msg="Message deleted successfully";
		     $er=$this->view_msg($message,$msg);
		     return $er;
			
		}
		else{
			$resp['msg']= "Message not deleted";
		}
		return response()->json($resp);
	}
}
