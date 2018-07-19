<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class imgesController extends Controller
{
    //crop an image from datase or form input
    //input an image resource
    //input array $data
    public function cropImage($data){
    	//check if image resource  is present
    	if( $data['img']){
    		$createImg=Image::make($data['img'])->crop($data['w'],$data['h']);
    		# check if image cropped success
    		if ($createImg) {

    			##Return response in data uri
    			$ecCoded=$createImg->encode('data-url');
    			##Check if successfully encoded
    			if ($ecCoded) {
    				# code...
    				//$resp['url']=$ecCoded;
    				return $ecCoded;


    			}
    			else{
    				$resp['error']="Error.Failed to encode cropped image.";
    			}

    			
    		}
    		else{
    			$resp['error']="Error failed to crop imge.";
               
    		}
          return $resp;
    	}
      else{
      	return false;
      }
    	
    }


    	
}
