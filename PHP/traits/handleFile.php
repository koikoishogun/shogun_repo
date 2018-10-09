<?php
namespace App\Traits;
use Illuminate\Http\Request;
use App\filezz as zz;
use Illuminate\Support\Facades\Storage;
trait handleFile 
{
            //Upload a file of any type
            //Input  
            public function uploadFile( Request $request){
                //return "hit";
            	$name="file";
                $re=$this->addFormImage($request,$name);
                //return var_dump($re);
                foreach ($re as $key => $value) {
                    # code...
                    //check for id of image
                    if( $key == "id"  ){
                        //$resp['html']= "<p>".$value."</p>";
                        //$res=$this->getImageTag($value);
                        //$resp['id']=$value;
                        $showfile="".$this->showfile($value);
                        if($showfile){
                           $resp['image']=$showfile;
                        }
                        else{
                            $resp['error']="Oops an error occured while displaying the image.";
                        }
                        

                    }
                    //check for errors
                    //
                    if(  $key ==  'error'){
                        $resp['error']=$value;

                    }
                }
                return response()->json($resp);

            }

            //Save blob in database
            //input request
            //output
            public function addFormImage( Request $request,$name){
                if( $request->isMethod("POST") ){
                            //get input file
                            if($request->hasFile($name) &&  $request->file($name)->isValid()          ){
                                        $file_types=$request->file($name)->getMimeType() == "image/jpeg" || $request->file($name)->getMimeType() == "image/png" || $request->file($name)->getMimeType() == "image/gif";    

                                        if($file_types){
                                            
                                            
                                            //save to disk
                                            $saveFile=$this->saveToDisk($request,$name);
                                            //check if successfully added
                                            if(   $saveFile){
                                                if($saveFile){
                                                    //return $saveFile->id;
                                                    $det['id']=$saveFile;
                                                    //return  var_dump($resp);
                                                    //return $resp;
                                                }
                                                else{
                                                    //return "";
                                                    //return false;
                                                    $det['error']="Error.No id present";//
                                                    //return $resp;

                                                }
                                                

                                            }
                                            else{
                                                //return "Error.Failed to save file.";
                                                //return false;
                                                $det['error']="Error.Failed to save file.";

                                            }

                                        }
                                        else{
                                            $det['error']="Error.Only images allowed";
                                        }

                            }
                            //check for file types
                            
                            else{
                                //return "Error.File failed to upload properly.";
                                $det['error']="Error.File failed to upload properly.";
                                 //return false;

                            }



                   //return details
                   //return  var_dump($det);
                   return  $det;


                 
                }
                else{
                    return abort(404,"Unauthorized acess.")->render();
                }

            }
            //return file name type and size from input request
            //name of the input tag
            //return array det contains name ,type,size keys || false
            public function  inputFileInfo(Request $request,$name){
                //check if file  has input && input is valid
                $checkfile=$this->inputFileValid($request,$name);
                if($checkfile){
                    //check for ndetails of files
                    $det['name']=$request->file($name)->getClientOriginalName();
                    $det['type']=$request->file($name)->getMimeType();
                    $det['size']=$request->file($name)->getClientSize();
                    if($det['name'] && $det['type'] &&  $det['size']){
                        return $det;

                    }
                    else{
                        return false;
                    }
                    
                    

                }
                else{
                    //$resp['error']="Error.File failed to upload properly.";
                    return false;

                }


            }
            //check if request has file and is valid
            //name of selector
            //return false for empty or invalid upload ||  true
            public function  inputFileValid(Request $request,$name){
                if( $request->file($name) && $request->file($name)->isValid()  ){
                    return true;


                }
                else{
                    return false;
                }

            }

            //return datat uri from scheme
            public function dataUri($blob,$type){
                $dataUri="data:".$type.";base64,".base64_encode($blob)."";
                return $dataUri;

            }

            //show file view with delete option
            //input file id
            //output view || false
            public function showFile($id){
            	//retrieve file from input
                $qwer=zz::find($id);
                //check if file exists
                if($qwer){
                   
                   return view("files.showFile",["path"=>$qwer->path,"id"=>$id])->render();



                }
                else{
                    return false;
                }

            }
            //delete file from database
            //input int
            //output string
            public function deleteFileDB($id){
                $file=zz::destroy($id);
                if($file){
                    $resp['msg']='Success.File deleted.';

                }
                else{
                    $resp['error']='Error.Failed to delete file.';
                }
                return response()->json($resp);

            }

            //delete file from harddisk
            //input int 
            //output string
            public function deleteFileSD($id){
                //check for file
                $ffile=zz::find($id);
                //check if it exists
                if($ffile){
                    //check for file in storage
                    $cfSto=Storage::exists("/images/".$ffile->name);

                    //check if file exists
                    if($cfSto){
                        //delete file from sd
                        $delSD=Storage::delete("/images/".$ffile->name);
                        //delete file from DB
                        $delDB=zz::destroy($id);

                        //Check if files successfully deleted
                        if($delSD && $delDB){
                            $det['msg']="Success.File deleted.";

                        }
                        else{
                            $det['error']="Error.Failed to delete file.";
                        }

                    }
                    else{
                        $det['error']="Error.Couldn't locate file on SD.";
                    }

                }
                else{
                  $det['error']="Error.Couldn't find specified file.";
                }
             return response()->json($det);
            }
            //save file to database
            //
            public function saveToDb(Request $request,$name){
                $rew=file_get_contents( $request->file($name) );
                $addInputDet=$this->inputFileInfo($request,$name);

                //check if inputFileInfo is success
                if( $addInputDet){
                    //return var_dump($addInputDet);
                    foreach ($addInputDet as $key => $value) {
                        if( $key == "name" ){
                            $da['name']=$value;

                        }
                        if( $key == "type" ){
                            $da['type']=$value;

                        }
                        if( $key == "size" ){
                            $da['size']=$value;

                        }
                        # code...
                        
                    }
                    $da['path']=$this->dataUri($rew,$da['type']);
                    //save to db
                    $saveFile=zz::create($da);
                    //check if successfully saved
                    if($saveFile){
                        return $saveFile->id;

                    }
                    else{
                        return false;
                    }

                }
                else{
                    return false;
                }
                
                
                
                
                

            }

            //save to disk
            //input string $request,string $name name of uploaded file
            //output string $path(relative to disk)
            public function saveToDisk(Request $request,$name){
                
                //get file details
                $addInputDet=$this->inputFileInfo($request,$name);

                //check if inputFileInfo is success
                if( $addInputDet){
                    //return var_dump($addInputDet);
                    foreach ($addInputDet as $key => $value) {
                        /*if( $key == "name" ){
                            $da['name']=$value;

                        }*/
                        if( $key == "type" ){
                            $da['type']=$value;

                        }
                        if( $key == "size" ){
                            $da['size']=$value;

                        }
                        # code...
                        
                    }
                    //store file to disk
                    $svD=$request->file($name)->store('images');
                    //check if success
                    if($svD){
                        //$da['path']=$svD;
                        //get path info
                        $path=pathinfo($svD);
                        $da['name']=$path['basename'];
                        $da['path']="/uploads/images/".$path['basename'];
                        //Add file details to db
                        $asd=zz::create($da);
                        //check if details saved successfully
                        if($asd){
                            return $asd->id;

                        }
                        else{
                            return false;
                        }

                    }
                    else{
                        return false;
                    }
                }
                else{
                    return false;
                }

                

            }
            //get path to file from DB
            //input int
            //output string
            public function   getFilePathDB($id){
                $finFile=zz::find($id);
                //check if it exists
                if($finFile){
                  return $finFile->path;
                  
                 }
                 else{
                    return false;
                 }

            }
            //check request for custom mimetype
            //default checks for images png gif jpg
            //input object Http\Request ,array containning custom mime type
            //output true || false
            public function getRequestMime(Request $request,$customMimeType=null){
                //check requset for mimeType
                $checkRequest=$request->getMimeType();
                //check for custom memetype
                if ($customMimeType && !empty($customMimeType)) {
                    # code...
                   $checkComparison=in_array($checkRequest, $customMimeType);
                   //check if found
                   if($checkComparison){

                   }

                }

            }
}
