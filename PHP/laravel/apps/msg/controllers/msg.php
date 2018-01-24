<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\message;
use Illuminate\Support\Facades\Mail;
use App\Mail\confirm;

class msg extends Controller
{
    //create msg
	public function create_msg(Request $request,message $message){
		if($request->isMethod("POST")  ){
				$det=[
			 "name"=>$request->name,
			 "email"=>$request->email,
			 "phone"=>$request->phone,
			 "message"=>$request->msg
			 
			 ];
			$em=$request->email;
			$msgs=$message::create($det);
			if($msgs){
				//return "message sent";
				$ms_name=$request->name;
				$mdf="Thank you for messaging us.Our support team has raised a ticket for your message and will get back to you shortly.";
				$send_conf=Mail::to($em)->send(new confirm($mdf,$ms_name)  );
				if( !$send_conf){
					return "Message sent successfully.A confirmation email has been sent to ".$em.".";
				}
				else{
					return "Ooops failed to send confirmation email but don't worry  we have received your email anyway.";
				}
				
			}
			else{
				return "Ooops an error occured in sending your message.";
			}
			
			
		}
		else{
			return abort(404);
			
		}
		
		
	}
	//view msg
	public function view_msg(  message $message ){
		$msgs=$message::orderBy('created_at','desc')->SimplePaginate(5);
		$ccc=$message::all()->count();
		return view("msg.view",["msg"=>$msgs,"count"=>$ccc]);
		
		
	}
	//delete msg
	public function delete_msg(message $message, int $id){
		$msgss=$message::destroy($id);
		if($msgss){
			//return "Message deleted successfully";
			 return redirect()->action("msg@view_msg");
			
		}
		else{
			return "Message not deleted";
		}
	}
}
