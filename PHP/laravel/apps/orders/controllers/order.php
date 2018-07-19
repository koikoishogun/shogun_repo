<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order as orders;
use Illuminate\Support\Facades\Mail;
use App\Mail\confirm;

class order extends Controller
{
    //create orders
	public function create_order( Request $request,  orders $orders ){
		$det=[
		 "name"=>$request->name,
		 "phone"=>$request->ph,
		 "email"=>$request->em,
		 "service"=>$request->serv
			  
		];

		//check if all are present
		//check for name
		if($request->name){

          $det["name"]=$request->name;
		}
		//check for phone
		if($request->phone){

          $det["phone"]=$request->phone;
		}
		//check for email
		if($request->email){

          $det["email"]=$request->email;
		}
		//check for quantity
		if($request->quantity){
			$det['quantity']=$request->quantity;


		}
		//check for product_id
		if($request->pid){

          $det["product_id"]=$request->pid;
		}
		$mals=$request->email;
		$or=$orders::create($det);
		if($or){
			$mssg_em="Thank you ".$request->name." for choosing us .Our sales team will email you a quote for ".$request->serv." at ".$mals."";
			//$or_name=$request->name;
			//$send_con=Mail::to($mals)->send(new confirm($mssg_em,$or_name));
			//$mssg="Success.A confirmation email has been sent to ".$request->em.". We'll email you a quote.";
			$resp['msg']=$mssg_em;

			//return  response()->json($resp);			
			/*if( !$send_con ){
				return $mssg;
			}
			else{
				return "Success.Failed to send a confirmation email.";
				//
			}*/
		}
		else{
			//return "failed to create order";
			$resp['error']="Ooops.....Something happened failed to create order."
		}
		return response()->json($resp);
		
	}
	//view orders
	public function view_order( orders $orders){
	     $o=$orders::orderBy('created_at','desc')->SimplePaginate(5);
		 $noo=$orders::all()->count();
		 //return view("orders.view",["orders"=>$o,"numbers"=>$noo]);
		 $resp['html']=view("orders.view",["orders"=>$o,"numbers"=>$noo])->render();

		 return response()->json($resp);
		
	}
	//delete order
	public function del_order( int $id,Request $request,  orders $orders ){
	     $o=$orders::destroy($id);
		 if($o){
			 //return "order deleted successfully";
			 return redirect()->action("order@view_order");
		    }
	     else{
			 //return "Error.Failed to delete order.";
	     	$resp['error']="Error.Failed to delete order.";
		 }
		 return response()->json($resp);
	}
	
}
