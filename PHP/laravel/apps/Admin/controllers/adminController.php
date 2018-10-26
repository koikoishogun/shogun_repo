<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User as us;

class adminController extends Controller
{
    
   
    //return home for admin
    public function home(){
    	$home=view("admin.home");
    	//$resp["html"]=$home;
    	//return response()->json($resp);
        return $home;



    }
    public  function loginAdmin(Request $request){
    	//return "hit";
        if(  $request->isMethod("POST")  ){
            $det=["email"=>$request->email ,"password"=>$request->password];
            //check  credentials
            if( Auth::attempt($det,true)   ){

                //return redirect()->action("adminController@home");
                //$resp=[];
             }
            else{
                 $resp['error']="Oops...Wrong email or password.";
                 return response()->json($resp); 

            }
            
             



        }
        else{
            $resp['err4']=abort(404,"Unauthorized access.")->render();
            return response()->json($resp);
        }
        
           


    }
    public function adminLoginForm(){
    	return view("admin.login");
    }
   
    public function logout(){
    	//return "test";
        $ert=Auth::logout();
        if ( !$ert) {
            
            $resp['nada']="logeed out";

        }
        else{
           $resp['error']="Error.Failed to logout";
          
        }
        return response()->json($resp);
        

    }
   
    //add a new user instance
    public function add_admin(string $name,string $email,string  $password){
        $pas=bcrypt($password);
        $det=["name"=>$name,"email"=>$email,"password"=>$pas];
        $ad=us::create($det);
        if($ad){ 
            $det['users']=[];
            //view of users
             $data=[];
            $data['name']=$ad->name;
            $data['email']=$ad->email;
            $resp['users']=$data;
           
            //check if emoty
            if (!empty($det['users'])) {
                $erty=view("admin.userHome",$det)->render();
                
            }
            else{
             $erty=view("admin.userHome")->render();

                
            }
            $resp['html']=$erty;
            $resp['msg']="Success.User ".$name." added .";  
        
        }else{
            $resp['error']="Error.Failed to create user.";
        }
        return response()->json($resp);
        
    }
    //delete a user instance
    public function del_admin(Request $request){
        //chek if request is post
        if ( $request->isMethod("post") ) {
            //check for id
            if ($request->id) {
               //delete selected user
                $er=$request->id;
                $uzer=us::find($er);
                //check if exists
                if ($uzer) {
                    //save name
                    $name=$uzer->name;
                    //delete user instance
                    $dex=us::destroy($er);
                    //check if success fully destroyed
                    if ($dex) {
                        $resp['msg']="Success.User ".$name." deleted";
                    }
                    else{

                        $resp['error']="Oops...something happened.";
                    }

                    
                }
                else{
                    $resp['error']="Oops...Couldn't find user instance.";
                }

            }
            else{
                $resp['error']="Oops...Couldn't delete user instance.";
            }
        }
        else{
            $resp['err4']=abort(404)->render();

        }
        return response()->json($resp);

    }
    //return add user form
    public function addUserHome(){
        //get all users
        $ty=us::orderBy("created_at","desc")->SimplePaginate(10);
        $det['users']=[];
           if ($ty) {
                //loop and save to array
                foreach ($ty as  $value) {
                    $data=[];
                    $data['name']=$value->name;
                    $data['email']=$value->email;
                    $data['created']=$value->created_at->diffForHumans();
                    $data['updated']=$value->updated_at->diffForHumans();
                    $det['users']=$data;
                    
                }
                $resp['html']=view("admin.form",$det)->render();
           }
           else{
            $resp['html']=view("admin.form")->render();
           }
        
        return response()->json($resp);
    }
}
