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
		$mals=$request->em;
		$or=$orders::create($det);
		if($or){
			$mssg_em="Thank you for choosing us .Our sales team will email you a quote for ".$request->serv.".";
			$or_name=$request->name;
			$send_con=Mail::to($mals)->send(new confirm($mssg_em,$or_name));
			$mssg="Success.A confirmation email has been sent to ".$request->em.". We'll email you a quote.";
			if( !$send_con ){
				return $mssg;
			}
			else{
				return "Success.Failed to send a confirmation email.";
				//
			}
		}
		else{
			return "failed to create order";
		}
		
	}
	//view orders
	public function view_order( Request $request,  orders $orders ){
	     $o=$orders::orderBy('created_at','desc')->SimplePaginate(5);
		 $noo=$orders::all()->count();
		 return view("orders.view",["orders"=>$o,"numbers"=>$noo]);
		
	}
	//delete order
	public function del_order( int $id,Request $request,  orders $orders ){
	     $o=$orders::destroy($id);
		 if($o){
			 //return "order deleted successfully";
			 return redirect()->action("order@view_order");
		    }
	     else{
			 return "Error.Failed to delete order.";
		 }
	}
	
}
