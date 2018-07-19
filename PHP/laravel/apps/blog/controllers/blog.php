<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post as po;
use App\comment;
use App\fileUploads as fu;
use App\reply as re;
use App\filezz as zz;
use App\blogPhoto as blgp;
use App\tag as tg;
//use Intervention\Image\ImageManager as Image;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Events\newPost as npp;
require  "imgesController.php";

class blog extends Controller
{

    //return  blog home for admin
    public function home( Request $request){

    	//$resp['html']=view("blog.home")->render();
    	$allp=po::orderBy("created_at","desc")->SimplePaginate(10);
    	$cAll=po::all()->count();
        $popo=po::all();
        //get header images  for each post
         $postH=$this->showHeaderFile($popo);

       
        //get footer image for each post
        $getFi=$this->showFooterFile($popo);
        //$getFi=$this->getFooterimage(4);
        //get array of tags for each post
        $postTa=$this->showAllPosTags($popo);
        $det["posts"]=$allp;
        $det['count']=$cAll;
        $det['headerI']=$postH;
        //$det['footerI']=$getFi;
        $det['tags']=$postTa;

        //return  var_dump($postH);

    	$resp["html"]=view("blog.home",$det)->render();
    	return response()->json($resp);


    }

    //return user home
    //return all posts with header images
    public function userHome(){
            $allp=po::orderBy("created_at","desc")->SimplePaginate(20);
            //$allF=po::where("feature","feature")->get();
            //show all image names getFileName
            
            $popo=po::all();
            //get header images  for each post
             $postH=$this->showHeaderFile($popo);

           
            //get footer image for each post
            $getFi=$this->showFooterFile($popo);
            //$getFi=$this->getFooterimage(4);
            //get array of tags for each post
            $postTa=$this->showAllPosTags($popo);
            $det["posts"]=$allp;
            $det['headerI']=$postH;
            //$det['footerI']=$getFi;
            $det['tags']=$postTa;
            //$det['fe']=$allF;
            //$resp['html']=view("welcome")->render();
            //return response()->json($resp);
             return view("blog.userHome",$det);
            //return var_dump($getFi);

    }
    //Check if master 
    //retrieve all  header Files for all posts
    //input objet $posts
    //output array file name
    public function  showHeaderFile($pp){
         $getatgPOst=$pp;
         $postH=[];
         //$hids=[];
            foreach ($getatgPOst as  $value) {
                # code...
                
                $geHi=$this->headerFileName($value->id);
                $postH[$value->id]=$geHi;
                 
                
               
            }
            //return $hids;

            if($postH){
                return $postH;
            }
            else{
                return false;
            }
            


    }

   


    //retrieve all footer images
    //input none
    //return   array $fileids footer names
    public function   showFooterFile($posts){
        //get footer image for each post
        $getatgPOst=$posts;
        //$footim=[];
        $resp=[];
        foreach ($getatgPOst as  $value) {
            # code...
            //echo
            $getFi=$this->getFooterimage($value->id);

            if ($getFi) {
                # code...

                //save footer image ids to post id
                //$postFi[$value->id]=$getFi;
                //get image for each id
                //loop through all 
                //$getimage=$this->getImageTag($getFi );

                foreach ($getFi as  $fids) {
                    # code...
                   
                       //$getimage=$this->getImageTag($fids);
                        $postFi[$value->id]=$getFi;
                }
                //return $getFi;
                 //loop through  all footer ids  to get  images
                 foreach ($postFi as $kay => $val) {
                     # code...
                    //compare to id
                    if( $kay == $value->id){
                        //loop through all ids
                        foreach ($val as $vivo) {
                            # code...

                            $getimage=$this->footerFileName($vivo);
                            //return var_dump($getimage);
                            if($getimage){
                                $resp[$kay]=$getimage;

                            }

                        }

                    }
                    
                 }
                
                 
            }
            
        }
         if( $resp){
                //return 
                //$postFi=$getimage;
                return  $resp;



             }
             else{
                return false;
             }
        

    }

    //retrieve  all tags into an array
    //input none
    //output array tags - array of tags already parsed
    public function  showAllPosTags($posts){
        $getatgPOst=$posts;
        //get array of tags for each post
        $postTa=[];
        foreach ($getatgPOst as  $value) {
            # code...
            $getTag=$this->getPostTag($value->id);
            if($getTag){
                $postTa[$value->id]=$getTag;

            }
            
        }
        return  $postTa;

    }



    //add post
    public function  addPost(Request $request){
    	//check if request is post
    	if( $request->isMethod("POST")  ){
		             //return response()->json(["error"=>"fuck"]);
			    		//check for title
			    		if($request->title){
		                     $det['title']=$request->title;
                             //return  $request->title;
			    		}
			    		
			    		//save text
			    		if( $request->text){
			    			$det['post']=$request->text;

			    		}
                        //save posts
                        //create post
                        //return var_dump($det);
                        $creap=po::create($det);
                        //check if post is created
                        if($creap){
                            $potid=$creap->id;

                            //return redirect()->action("blog@viewPost");
                            //return redirect()->route("viewPosts");
                            //add tags
                            //check for tags
                            if($request->tag){
                                $tagDet['tag']=$request->tag;
                                $tagDet['post_id']=$potid;
                                $addtg=tg::create($tagDet);
                                if($addtg){
                                    //do nothing

                                }
                                else{
                                     $msg="Error.Couldn't add tags .";
                                     $this->returnJsonError($msg);

                                }

                                 
                            }

                            //check for post header images
                            if($request->headerImage){
                                //save header image
                                $hedId=$request->headerImage;
                                $findHeadr=zz::find($hedId);
                                if($findHeadr){
                                    //add blog header image
                                    $addedPDet['header']="header";
                                    $addedPDet['file_id']=$findHeadr->id;
                                    $addedPDet['post_id']=$potid;
                                    $newblp=blgp::create($addedPDet);
                                    if($newblp){

                                    }
                                    else{
                                         $msg="Error.Couldn't add header images.";
                                         $this->returnJsonError($msg);


                                    }

                                }
                                else{
                                    $resp['error']="Error.couldn't find header image.";
                                    return response()->json($resp);
                                     //$this->returnJsonError($msg);
                                }

                            }
                            //chceck for posts footer images
                            if ($request->footerImages ) {
                                //return "fukj yes";
                                foreach ($request->footerImages as  $value) {
                                    # code...
                                    //echo " key is:".$key."  ;value is :".$value."";
                                    //return $ert;
                                    //find uploaded file
                                    $fgh=zz::find($value);
                                    if($fgh){
                                        //Save footer images
                                        $footerIDet['footer']="foot";
                                        $footerIDet['file_id']=$value;
                                        $footerIDet['post_id']=$potid;
                                        $addblp=blgp::create($footerIDet);
                                        if($addblp){
                                            //do nothing

                                        }


                                    }
                                    else{
                                        $msg="Error.Couldn't find footer images.";
                                        $this->returnJsonError($msg);
                                    }
                                }
                                # code...
                            }
                            //event(  new npp($creap) );
                            return redirect()->action("blog@viewPost");

                        }
                        else{
                            $resp["error"]="Oops something happened...Failed to add post.";
                            
                        }
                        

                        

			    		
		            

    		
                 



    	}
    	else{
    		$resp["error"]=abort(404,"Unauthorized access ")->render();

    		
             return respose()->json($resp);

    	}
        return response()->json($resp);
        


    }

    //view all Posts return most recent first without form for admin
    public function  viewPost(){
    	$allp=po::orderBy("created_at","desc")->SimplePaginate(10);
    	$cAll=po::all()->count();
        //add header images
        $popo=po::all();
        //get header images  for each post
        $postH=$this->showHeaderFile($popo);
        //get footer files
        //$getFi=$this->showFooterFile($popo);
        //get tags for each post
        $postTa=$this->showAllPosTags($popo);
        $det['posts']=$allp;
        $det['count']=$cAll;
        $det['headerI']=$postH;
        //$det['footer']=$getFi;
        $det['tags']=$postTa;


        //get 

        //get footer images

    	$resp["html"]=view("blog.view",$det)->render();
    	return response()->json($resp);



    	
    }

    //del post
    public function  delPost($postId){
        $delPos=po::destroy($postId);


            //check if post is deleted
            if($delPos){
                return redirect()->action("blog@home");
            }
            else{
                $resp["error"]="Error.Failed to delete post.";
            }
         return response()->json($resp);
    	
    }


    //return update form
    public function updateForm($postid){
        //fetch post
        $fpos=po::find($postid);
        if ($fpos) {
            # code...
            $det['post']=$fpos;
            //get header image for post
             $header="".$this->returnIMG($this->getHeaderImage($postid));
             if( $header){
                $det['header']=$header;

             }



            //get footer image for post
            $foter=$this->getFooterimage($postid);
            
            //loop through all footer ids
            foreach ($foter as  $value) {
                # code...
                //return img for each id
                $fIm=$this->returnIMG($value);
                //check if image exists
                if($fIm){
                    //save to an array
                    $fot[]="".$fIm;
                }

            }
            if($fot){
                $det['foot']=$fot;

            }



            //get tags for post
            //check for tags
            $mkl=$this->getPostTag($postid);
            //check tag array
            if($mkl){
                $det['tag']=$mkl;

            }

            //$formDet=["post"=>$fpos];
            $resp["html"]=view("blog.updateForm",$det)->render();
        }
        else
        {
            $resp["error"]="Error.Couldn't find post.";
        }
        return response()->json($resp);


        


    }

    //save a updated post
    public function updatePost(Request $request){
        $potid=$request->postId;
        //check if request is method POST
        if($request->isMethod("POST") ){
                //check for title
                            if($request->title){
                                 $det['title']=$request->title;
                            }
                            //check for tags
                           if($request->tag){
                            //$det['tag']=$request->tag;
                            $sdf['tag']=$request->tag;
                            $updateTag=tg::where("post_id",$request->postId)->update($sdf);
                                //check if tag sucessfully updated
                                if ( !$updateTag) {
                                    # code...
                                    $resp['error']="Error.Failed to update tag.";
                                    return response()->json($resp);

                                }

                            }


                            //save text
                            if( $request->text){
                                $det['post']=$request->text;

                            }

                            //save author
                            /*if( $request->name){
                                $det['author']=$request->name;

                            }*/

                            
                        
                        //check for header image
                        if($request->headerImage){
                            //save header image
                            $hedId=$request->headerImage;
                            $findHeadr=zz::find($hedId);
                            if($findHeadr){
                                //check whether header exists
                                $chHeader=blgp::where("header","header")->where("file_id",$hedId)->first();
                                if( $chHeader ){
                                    #do nothing

                                }
                                else{
                                    //add blog header image
                                    $addedPDet['header']="header";
                                    $addedPDet['file_id']=$findHeadr->id;
                                    $addedPDet['post_id']=$potid;
                                    $newblp=blgp::create($addedPDet);
                                    //check if file exists
                                    if($newblp){

                                    }
                                    else{
                                         $msg="Error.Couldn't add header images.";
                                         $this->returnJsonError($msg);


                                    }


                                }
                                

                            }
                            else{
                                $resp['error']="Error.couldn't find header image.";
                                return response()->json($resp);
                                 //$this->returnJsonError($msg);
                            }

                        }

                        //check for footer images
                        //chceck for posts footer images
                        if ($request->footerImages ) {
                            //return "fukj yes";

                            foreach ($request->footerImages as  $value) {
                                # code...
                                //echo " key is:".$key."  ;value is :".$value."";
                                //return $ert;
                                //find uploaded file
                                $fgh=zz::find($value);
                                if($fgh){
                                    //get all footer images for post
                                    $getFooter=blgp::where("footer","foot")->where("post_id",$potid)->where("file_id",$value)->first();
                                    if ($getFooter) {
                                        # code...
                                    }
                                    else{
                                        //Save footer images
                                        $footerIDet['footer']="foot";
                                        $footerIDet['file_id']=$value;
                                        $footerIDet['post_id']=$potid;
                                        $addblp=blgp::create($footerIDet);
                                        if($addblp){
                                            //do nothing

                                        }

                                    }
                                    


                                }
                                else{
                                    $msg="Error.Couldn't find footer images.";
                                    $this->returnJsonError($msg);
                                }
                            }
                            # code...
                        }
                        //save updated post
                        $savUp=po::where("id",$request->postId)->update($det);
                        //check if post was updated
                        if($savUp){
                            //$resp["html"]="Success."
                            return redirect()->action("blog@viewOne",["postid"=>$request->postId]);
                        }
                        else{
                            $resp['error']="ErrorFFailed to upload post.";
                            return response()->json($resp);
                        }




        }
        else{
            return abort(404,"Oops Something happened.Unauthorised access.");
        }

    }

   //return view for one post for admin
    public function viewOne($postid){
        $rt=po::find($postid);
        $det['post']=$rt;
        //get header image
        $cbn=$this->getHeaderImage($postid);
        //get header image as a html tag
        $cvm=$this->headerFileName($cbn);
        //check if exists
        if($cvm){
           $getHeaderImg=$cvm; 
           $det['head']=$getHeaderImg;
        }
        
        $awer=$this->getFooterimage($postid);
        //check for footer imgs
        if ($awer) {
            # code...
            //loop through all footer to get names
            $getFooteri=[];
            foreach ($awer as  $value) {
                # code...
                $sdff=$this->footerFileName($value);
                //check if img is returned
                if($sdff){

                  $getFooteri[]=$sdff;

                }
            }
            $det['footer']=$getFooteri;

        }
        //check for tags
        $mkl=$this->getPostTag($postid);
        //check tag array
        if($mkl){
            $det['tag']=$mkl;

        }
        //return var_dump($det['head']);
        $resp['html']=view("blog.oneView",$det)->render();
        return response()->json($resp);

        

    }

    //user view one post
    public function userViewPost($postid){
        $rt=po::find($postid);
        $dfg=po::orderBy('created_at','desc')->SimplePaginate(10);
        $ert=po::all();
       

        //return all header image names
        $fg=$this->showHeaderFile($ert);


        
        $det=[];
        //check for footer imgs
        
            # code...
            //loop through all footer to get names
           $awer=$this->getFooterimage($postid);
        //check for footer imgs
        if ($awer) {
            # code...
            //loop through all footer to get names
            $getFooteri=[];
            foreach ($awer as  $value) {
                # code...
                $sdff=$this->footerFileName($value);
                //check if img is returned
                if($sdff){

                  $getFooteri[]=$sdff;

                }
            }
            $det['footer']=$getFooteri;

        }
            //$det['footer']=$getFooteri;

         
        //return all tags
        $QaSD=$this->showAllPosTags($ert);
        $det=["post"=>$rt,"posts"=>$dfg,"head"=>$fg,"tag"=> $QaSD,"footer"=>$getFooteri];
        //return var_dump($fg);
        




            $resp['html']=view("blog.user.oneView",$det)->render();
        
           return response()->json($resp);  
       
       


    }
    public function userViewOne($postid){
        $rt=po::find($postid);
        //$dfg=po::orderBy('created_at','desc')->SimplePaginate(10);
        //return header image for post
        //get heaader file name
        $asd=$this->headerFileName($this->getHeaderImage($postid));
          

          //get footer image ids
            $rty=$this->getFooterimage($postid);
            //loop through all to get names
            $fot=[];
            foreach ($rty as  $value) {
                # code...
                $sxcv=$this->footerFileName($value);
                if($sxcv){
                    $fot[]=$sxcv;

                }

            }
         //get tags for post
         $zxc=$this->getPostTag($postid);
         $det=["post"=>$rt,"tags"=>$zxc,"head"=>$asd,"footer"=>$fot];
             
        
        $resp['html']=view("blog.user.viewPost",$det)->render();
        return response()->json($resp);


    }

    //Feature a particular post 
    public function featurePost($postid){
        //count number of featured posts cannot exceed four
        $palfe=po::where('feature','feature')->get()->count();
        if($palfe >= 5 ){
            $resp['msg']="Ooops....cannot feature more than five blogposts. Unfeature one to feature another.";
            return response()->json($resp);

        }


        $fer=po::find($postid);
        $det=["feature"=>"feature"];
        $fup=$fer->update($det);
        if($fup){
            $resp['html']="unfeature";
        }
        else{
            $resp['error']="Error.Couldn't feature post.";
        }
        return response()->json($resp);


    }

    //unfeature a particular post
    public function unfeature($postid){
        $fer=po::find($postid);
        if($fer->feature == "feature"){
            $fer->feature="";
            $sasd=$fer->save();
            if($sasd){
                $resp['html']="feature";

                return response()->json($resp);

            }

        }


    }

    //return reply home for user
    public function userREplyHome($cid){
         $ret=re::where("comment_id",$cid)->orderBy("created_at","desc")->get();
         $cidf=$cid;
         $det=["replies"=>$ret,"cid"=>$cidf];
         $resp['html']=view("blog.reply.user.home",$det)->render();
         return response()->json($resp);

       
    }

    //Save a reply for guest users
    public function saveUSerReply(Request $request){
        if(   $request->isMethod('POST')  ){
            //check for comment id
            if($request->ghjl){
                $det['name']=$request->name;
                $det['email']=$request->email;
                $det['text']=$request->text;
                $det['comment_id']=$request->ghjl;
                $saveReplirs=re::create($det);
                //check whether it saved successfully
                if($saveReplirs){
                    //redirect to view all replies for comments
                    //$resp['html']
                    return redirect()->action('blog@userViewAllReplies',['cid'=>$det['comment_id'] ]);

                }
                else{
                    //return failed error
                    $resp['error']="Something happened. Failed to post reply.";
                }

            }
            else{
                return "cvmvchmn";
            }

            //REPLY DETails
            
         





        }
        else{
            return abort(404,"Unauthorized access.");
        }

    }

    //view all replies for a particular comment ofor user
    public function userViewAllReplies($cid){
        //check if comment id is present error if not
        if($cid){
            $allreg=re::where('comment_id',$cid)->orderBy('created_at','desc')->SimplePaginate(10);
            $mesgCount=re::where('comment_id',$cid)->get()->count();
            $resp['html']=view('blog.reply.user.view',['replies'=>$allreg,'count'=>$mesgCount])->render();

        }
        else{
            return abort(404);

            }
        return response()->json($resp);

    }

    //return reply home for adn\min
    public function adminReplyHome($cid){
        $ret=re::where("comment_id",$cid)->orderBy("created_at","desc")->get();
         $cidf=$cid;
         $det=["replies"=>$ret,"cid"=>$cidf];
         $resp['html']=view("blog.reply.admin.home",$det)->render();
         return response()->json($resp);

    }

    //save admin reply

    public function saveDminReply(Request $request){
        if(   $request->isMethod('POST')  ){
            //check for comment id
            if($request->ghjl){
                $det['name']=$request->name;
                $det['email']=$request->email;
                $det['text']=$request->text;
                $det['comment_id']=$request->ghjl;
                $saveReplirs=re::create($det);
                //check whether it saved successfully
                if($saveReplirs){
                    //redirect to view all replies for comments
                    //$resp['html']
                    return redirect()->action('blog@adminViewAllreplies',['cid'=>$det['comment_id'] ]);

                }
                else{
                    //return failed error
                    $resp['error']="Something happened. Failed to post reply.";
                }

            }
            else{
                return "cvmvchmn";
            }

            //REPLY DETails
            
         





        }
        else{
            return abort(404,"Unauthorized access.");
        }

    }


    //View all replies  for admin
    public function adminViewAllreplies($cid){
        //check if comment id is present error if not
        
            $allreg=re::where('comment_id',$cid)->orderBy('created_at','desc')->SimplePaginate(10);
            $mesgCount=re::where('comment_id',$cid)->get()->count();
            $resp['html']=view('blog.reply.admin.view',['replies'=>$allreg,'count'=>$mesgCount])->render();

      
       
        return response()->json($resp);


    }

    //delete a particular reply
    public function delReply($cid){
        $ettt=re::find($cid);
        $er=$ettt->comment_id;
        if($er){
                $erk=re::destroy($cid);
                if( $erk){
                    //$resp['msg']="Reply deleted succcessfully.";
                    return redirect()->action('blog@adminViewAllreplies',['cid'=>$er ]);

                }
                else{
                    $resp['error']="OOps...Error.Failed to delete reply.";

                }
                return response()->json($resp);

                }
        
    }

    //Save  a blog post image,name of atrribute for input tag
    public function addFormImage( $request,$name){
        if( $request->isMethod("POST") ){
                    //get input file
                    if($request->hasFile($name) &&  $request->file($name)->isValid()          ){
                                $file_types=$request->file($name)->getMimeType() == "image/jpeg" || $request->file($name)->getMimeType() == "image/png" || $request->file($name)->getMimeType() == "image/gif";    

                                if($file_types){
                                    $rew=file_get_contents( $request->file($name) );
                                    //$rew=$request->file($name)->store("public/formUploads");
                                    //$storeSaBlo=file_get_contents($request->file($name));

                                    $addInputDet=$this->inputFileInfo($request,$name);
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
                                    //return var_dump($det);

                                    //$da["path"]=$this->dataUri($rew,$det['type']);
                                    $zxc['img']=$this->dataUri($rew,$da['type']);
                                    $zxc['w']=15;
                                    $zxc['h']=15;
                                    //$zxc['x']=56;
                                      $crop=new imgesController();
                                    $cropped=$crop->cropImage($zxc);
                                    $da['path']=$cropped;
                                    //return   $kk; //var_dump();
                                    //$det['file']=$rew;
                                    //return  var_dump($det);
                                    $saveFile=zz::create($da);
                                    
                                    //return $saveFile;
                                    //check if successfully added
                                    if(   $saveFile){
                                        if($saveFile->id){
                                            //return $saveFile->id;
                                            $det['id']=$saveFile->id;
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
            return abort(404,"Unauthorized acess.");
        }

    }
    //return file name type and size from input request
    //name of the input tag
    //return array det contains name ,type,size keys
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
    //add header image
    public function addHeaderImage(Request $request){
        $name="file";
        $re=$this->addFormImage($request,$name);
        //return var_dump($re);
        foreach ($re as $key => $value) {
            # code...
            //check for id of image
            if( $key == "id"  ){
                //$resp['html']= "<p>".$value."</p>";
                //$res=$this->getImageTag($value);
                $resp['id']=$value;

            }
            //check for errors
            //
            if(  $key ==  'error'){
                $resp['error']=$value;

            }
        }
        return response()->json($resp);
       


    }

    //return image url
    public function getImageTag($id){
        //
        //retrieve file from input
        $qwer=zz::find($id);
        //check if file exists
        if($qwer){
           //$content=base64_encode($qwer->file);
            $path=$qwer->path;
            //$type=$qwer->type;

           //header('Content-type: '.$type);
            //echo $content;


            //return response($content)->header("Content-Type",$type);
            //$tagg="<img  src='data:".$type.";base64,".$content."'/>";
            //return $tagg;
            //$resp['html']=$tagg;
           return view("blog.image",["path"=>$path,"id"=>$id]);



        }
        else{
            return false;
        }
        //return $resp;
        //return $resp;


    }
    //function crop image and then return img resource t o 1px by 1px
    //name attr of html tag
    //id of uploaded file
    public function  cropImage($name){
        //$wert=zz::find($id);
        //check if file exists
        if($wert){
            //add intervention image
            $eri=Image::make($name)->crop(1,1);
            //check if succesfully cropped
            if($eri){
                //return var_dump($eri);
                $det=["file"=>$eri];
                $newzz=$wert->update($det);
                if($newzz){
                    $resp['success']=true;

                }
                else{
                    $resp['error']="Error.Failed to update.";
                }


            }
            else{
                $resp['error']="Error.Failed to crop image.";
            }


        }
        else{
            $resp['error']="Error.No image found";
        }
        return $resp;



    }

    public function returnJsonError($error){
        $resp["error"]=$error;
        return response()->json($resp);

    }
    //return an id  for blog header  image
    //input post id
    //output id || false
    public function  getHeaderImage($id){

        $fpost=blgp::where("header","header")->where("post_id",$id)->first();

        if($fpost){
            return  $fpost->file_id;

        }
        else{
            return false;
        }

    }

    //return image name from post id
    //return array resp keys head foot matching img names

    public function getFileName($id){
        
        //check  for header return single name
              $xcv=blgp::where('post_id',$id);
              $ert=$xcv->where("header","header")->first();
              //check for footer
              $qwr=$xcv->where("footer","foot")->get();
              //save header
              if($ert){
                   $herN=$ert->files->name;
                   if($herN){
                     $resp['head']=$herN;

                   }

              }
             //save footer
              if($qwr){
                   //loop through all footer
                 foreach($qwr as $value ){
                    //check for files
                    if ($value->files->name       ) {
                        $fi[]=$value->files->name;
                        # code...
                    }

                  }
                   if($fi){
                     $resp['foot']=$fi;

                   }

              }
              if($resp){
                return $resp;

              }
              else{
                return false;
              }

        //check for footer return array of names

    }

    //get header file name
    //input file id
    public function  headerFileName($id){
             $xcv=zz::find($id);

              if($xcv){
                   $herN=$xcv->path;
                   if($herN){
                     $resp=$herN;
                     return $resp;

                   }
                   else{
                    return false;
                   }

              }
              else{
                return false;
              }



    }
    //get footer file name
    //return array of footer names
    public function footerFileName($id){
          //save footer
        $xcv=blgp::where('file_id',$id);
        $qwr=$xcv->where("footer","foot")->get();
         $fi=[];
         foreach($qwr as $value ){
            //check for files
            if (  $value->files->path ) {
                $fi[]=$value->files->path;
                # code...
            }
            else{
                return false;
            }

          }
          //return "fuk";
          if($fi ){
            return $fi;

          }
          else{
            return false;
          }
      
              

    }

    //return array of footer images
    //input  post  int $id
    //output  array  fotterImgIds
    public function getFooterimage($id){
      
        $footerImage=blgp::where("post_id",$id)->where("footer","foot")->get();
        //return $footerImage;
        if($footerImage ){
                //return "hit";
                 //$ert=[];
                 $yes=[];
                 foreach ( $footerImage as  $value) {
                     # code...
                       $yes[]=$value->file_id;
                     //var_dump($value->file_id) ;
                 }
                 //return $yes;
                 if($yes){
                    //return $yes;
                    //$resp[$id]=$yes;
                    return $yes;

                 }
                 else{
                    return false;
                 }
                 

                


        }
        else{
            return false;
        }
    }

    //Get tags from db and filter each out separetely into an array
    //input post id
    //
    public function getPostTag($id){
        $getTsd=tg::where("post_id",$id)->first();
        if($getTsd){
            $pTAg=$getTsd->tag;
            //parse tag here
            $efg=$this->parseTag($pTAg);
            if($efg){
                return $efg;

            }
            else{
                return false;

            }


        }
        else{

            return false;
        }

    }


    //parse tag for post int ann array of tags
    //input text to parse
    public function  parseTag($text){
        //parse function here
        $pTer=preg_split("/[\s,]+/", $text);
        //Check if Array exists
        if($pTer){
            return $pTer;

        }
        else{
            return false;

        }

    }
    //get  tag from url and search in database
    public function getPostFromTags($tags){
        //get post and eager load
        $sdf["post"]=po::all();

        //get tags all fro db
        $sdf['tag']=$tags;

        //search for tags
        $searchT=$this->searchTag($sdf);
       
        

        //check if tags are found
        if($searchT){
            //get all header images
            $headerI=$this->showHeaderFile($sdf['post']);

            //get al footer images
            $footerI=$this->showFooterFile($sdf['post']);

            //get all tags already parsed
            $erer=$this->showAllPosTags($sdf['post']);

            //parsed posts
            $det['parsed']=$searchT;
            $det['head']=$headerI;
            $det['foot']=$footerI;
            $det['tags']=$erer;

            $det['posts']=$sdf['post'];
            $vgh=view("blog.user.viewTag",$det)->render();
            $resp['html']=$vgh;




        }
        else{
            $resp['html']="No post matches that tag.";
        }

        return response()->json($resp);



    }

    //Search all posts tags for a specific tag
    //input array $tags  "tag"=>tag to search "post"=>all posts
    //output array "tag"=>[postids]
    public  function  searchTag($tags){
        $posts=$tags['post'];
        //$posts=po::all();
        $searchTag=$tags['tag'];
        //$searchTag="sex";
        //loop through all posts  to search tags
        $resp=[];
        foreach ($posts as  $value) {
            # get tags and parse into an array
            $parsT=$this->parseTag($value->tags->tag);
            //check whether success parsed into array
            if($parsT){
                //search tag for parameter
                foreach ($parsT as  $va) {
                    # check if any matches post
                    if($va ==  $searchTag){
                        //save post id into array
                        $resp[]=$value->id;

                    }
                }

            }
        }
        //var_dump($resp);
        //return response if exists
        if($resp){
            return $resp;

        }
        else{
            return false;
        }
       
        

    }
    public function delUpload( $id){
        $ert=zz::find($id);
        if($ert){
            //$fileName=$ert->path;
            //$edelFromDisk=Storage::delete("public/formUploads/".$fileName);
            //check whether successfully deleted
             $dfg=zz::destroy($id);
                //check whether deleteed from db
                if($dfg){
                    $resp['msg']="Success.File deleted.";


                }
                else{
                    $resp['error']="Error.Failed to delete file.";
                }

            /*if($edelFromDisk){
               
            }
            else{
                $resp['error']="Error.Failed to delete file.";
            }*/


        }
        else{
            $resp['error']="Error.Couldn't find file";
        }
        return response()->json($resp);

    }
    //get a generic img tag
    public function returnIMG($id){
         $qwer=zz::find($id);
        //check if file exists
        if($qwer){
          
            $path=$qwer->path;
            
           return view("blog.imageGeneric",["path"=>$path,"id"=>$id]);



        }
        else{
            return false;
        }

    }

    //add link to a particular post
    public function addLink($link,$id){
        $checkifiko=po::where("id",$id)->where("link",$link)->first();
        if($checkifiko){
             $resp["error"]="Oops....That link already exists.";
        }
        else{
            $rret=po::find($id);
            if($rret){
                $det=["link"=>$link];
                $jert=$rret->update($det);
                if($jert){
                    $resp['html']="http//wambuikamau.com/blog/".$rret->link;

                }
                else{
                    $resp['error']="Failed to add link.";

                }

            }


        }
        return response()->json($resp);
    }

    //delete a link to a post
    public function  delLink($id){
        $ert=po::find($id);
        if($ert){
            $det['link']="";
            $deg=$ert->update($det)->save();
            if(  $deg ){
                $resp['msg']="Link deleted successfully.";

            }
            else{
                $resp['error']="Failed to delete link.";
            }

        }
        else{
            $resp['error']="Error.Failed to find post";
        }
        return response()->json($resp);
    }

    //View post of a particular post
    public function viewLink($link){
       $fg=po::where("link",$link)->first();
       if($fg ){
           //get header file

           //sharubati
           return view("blog.user.viewLinks"); 

       }
       else{
        return redirect("/");

       }


       

    }
    //return datat uri from scheme
    public function dataUri($blob,$type){
        $dataUri="data:".$type.";base64,".base64_encode($blob)."";
        return $dataUri;

    }








}


