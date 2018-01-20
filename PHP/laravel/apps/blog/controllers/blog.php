<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use App\comment;
use App\Events\postCreated;


class blog extends Controller
{
    //add blog
	public function create_post( Request $request,post $post){
		if($request->isMethod("POST")  ){
			$det=[
			   "title"=>$request->title,
			   "name"=>$request->name,
			   "body"=>$request->body,
			   "category"=>$request->category
			   //"files"=>file_get_contents($request->file("files"));
			 ];
			$file_types=$request->file("ff")->getMimeType() == "image/jpeg" || $request->file("ff")->getMimeType() == "image/png" || $request->file("ff")->getMimeType() == "image/gif";
			 if( $request->hasFile("ff") && $request->file("ff")->isValid() && $file_types ){
				$det["files"]= file_get_contents($request->file("ff"));
				//return pg_escape_bytea($det["files"]  );
				  //return var_dump ( $det['files'] );
				
				 
			 }
			 $np=$post::create($det);
			 if($np){
				 //return "Post created successfully.";
				 //event(new postCreated($np));
				 return redirect()->action("blog@view_post");
			 }
			 else{
				return "Error.Couldn't create post."; 
			 }
		}
		else{
			return abort(404);
		}
	}
	
	
	//del post
	public function del_post(int $id, post $post){
		$dp=$post::destroy($id);
		if($dp){
			//return "Post deleted successfully.";
			 return redirect()->action("blog@view_post");
		}
		else{
			return "Error.Couldn't delete post.";
		}
		
	}
	//return update post form
	public function up_form(int $id , post $posts ){
		$fp=$posts::find($id);
		if($fp){
			return view("post.view",["up_post"=>$fp]);
		}
		else{
			return "Error could not find post. ";
		}
		
		
	}
	//save updated post
	public function save_up(post $posts,request $request){
		if( $request->isMethod("POST")    ){
			$det=[
			 "title"=>$request->title,
			 "name"=>$request->name,
			 "body"=>$request->body,
			 "category"=>$request->category,
			
			 ];
		   if($request->id){
				  //find post
				 $fp=$posts::find($request->id);
				 //check file
				 
				 if( $request->hasFile("ff") && $request->file("ff")->isValid() ){
					 $file_types=$request->file("ff")->getMimeType() == "image/jpeg" || $request->file("ff")->getMimeType() == "image/png" || $request->file("ff")->getMimeType() == "image/gif";
					if($file_types){
						$det["files"]= file_get_contents($request->file("ff") );
						
					}
				 
				 }
				$up=$fp->update($det);
				if($up){
					//return "Post updated.";
					 return redirect()->action("blog@view_post");
				}
				else{
					return "Error.Failed to update.";
				}
			   
		   }
		 else{
			   return "Error.Couldn't find post.";
		   }
		}
		else{
			return abort(404);
			
		}
		
	}
	//return all posts
	public function view_post (post $post){
		$ap=$post::orderBy("created_at","desc")->SimplePaginate(5);
		$cnt=$post::orderBy("created_at","desc")->count();
		return view("post.view",["post"=>$ap,"cnt"=>$cnt]);
		
	}
	//create comment
	public function create_cmt( Request $request,comment $cmt){
		if( $request->isMethod("POST")    ){
			$det=[
			 "name"=>$request->name,
			 //"email"=>$request->email,
			 "post_id"=>$request->post_id,
			 "message"=>$request->message,
			];
			if($request->email){
				$det["email"]=$request->email;
			}
			$cc=$cmt::create($det);
			if($cc){
				//return "Comment created successfully";
				return redirect()->action("blog@view_cmt",[ "id"=>$request->post_id]);
				
			}
			else{
				return "Error failed to add comment.";
			}
			
		}
		else{
			return abort(404);
		}
	}
	//view comment
	public function view_cmt( int $id,Request $request,comment $cmt){
		$vc=$cmt::orderBy("created_at","desc")->where('post_id',$id)->SimplePaginate(5);
	  return  view("cmt.admin_view",["cmt"=>$vc,"post_id"=>$id]);
		
	}
	//del comment
	public function del_cmt( int $cid,Request $request,comment $cmt){
		$postid=$cmt::find($cid)->post->id;
		$dc=$cmt::destroy($cid);
		if($dc  && $postid ){
			//return "Comment deleted successfully.";
			return redirect()->action("blog@view_cmt",["id"=>$postid]);
			//return var_dump($postid);
		}
		else{
			return "Error.Failed to delete comment.";
		}
	  
		
	}
	//return user view post
	public function u_view(Request $request,post $post){
		 //$ap=$post::orderBy("created_at","desc")
		 $recent=$post::orderBy("created_at","desc")->first();
		 $list=$post::orderBy("created_at","desc")->SimplePaginate(5);
		 return view("post.user_view",["post"=>$list]);
	  
		
	}
	//return user view comment
	public function user_cmt(int $id,Request $request,comment $cmt){
		 $ap=$cmt::orderBy("created_at","desc")->where('post_id',$id)->SimplePaginate(5);
		 return view("cmt.user_view",["cmt"=>$ap,"post_id"=>$id]);
	  
		
	}
	//return user create cmt
	public function user_create_cmt(Request $request,comment $cmt){	
	    if( $request->isMethod("POST")    ){
			$det=[
			 "name"=>$request->name,
			 "post_id"=>$request->post_id,
			 "message"=>$request->message,
			];
			if($request->email){
				$det["email"]=$request->email;
			}
			$cc=$cmt::create($det);
			if($cc){
				//return "Comment created successfully";
				return redirect()->action("blog@user_cmt",[ "id"=>$request->post_id]);
				
			}
			else{
				return "Error failed to add comment.";
			}
			
		}
		else{
			return abort(404);
		}
	   
		
	  
		
	}
	//admin view one post
	public function one_post(int $id,post $post){
		$one_p=$post::find($id);
		if($one_p){
			return view("post.view",["one"=>$one_p]);
		}
		
	}
	//user view one post
	public function user_view_blog(int $id,post $post){
		$one_p=$post::find($id);
		if($one_p){
			return view("post.user_view",["one"=>$one_p]);
		}
	}
	
	
	
}
