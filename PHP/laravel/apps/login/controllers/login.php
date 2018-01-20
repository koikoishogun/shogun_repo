<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class login extends Controller
{
    //
	public function login_form(){
		return view("login.form");
		
	}
	public function add_admin(string $email,string  $password,string $name){
		$pas=bcrypt($password);
		$det=["name"=>$name,"email"=>$email,"password"=>$pas];
		$ad=User::create($det);
		if($ad){ 
		
		   return "admin created success.";  
		
		}else{
			return "Error.Failed to create admin.";
		}
		
	}
	//log in admin
	public function login_admin(Request $request){
		if( $request->isMethod("POST")  ){
			$det=["email"=>$request->email,"password"=>$request->pass];
			
			if( Auth::attempt($det) ){
				//return redirect()->route("admin");
				//return var_dump(   Auth::attempt($det)  );
			}
			else{
				return "Error.Invalid Email or Password.";
			}
			
		}
		else{
			return abort(404);
		}
		
	}
	//log out admin 
	public function log_out(Request $request){
		$lo=Auth::logout();
		if($lo){
			
		}
		else{
			return "Error.Failed to logout.";
		}
		
	}
}
