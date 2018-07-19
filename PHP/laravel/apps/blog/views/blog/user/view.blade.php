
<div class="row">
	<div class="blog-story-container blogContau">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="loadbb">
						{{-- Load most recent blog here                     --}}
							@if(isset($post) && $post != null     )
							  
								    <div class="psDiv">
							             <div class="postsHere blog-content">
							               	<input type="hidden"  value="{{$post->id}}" id="pId">
							               	{{-- check for header image   --}}
									    			 @if( isset($head)  && $head != null    )
                                                  <div class="user-bloglist-imagewrapper">
                                                     	{{--   check for header                 --}}
                                                     	  @foreach( $head as  $key => $va )
                                                 	         @if( $key == $value->id )
                                                 	<img  class="user-bloglist-image" src='{{$va}}'>    

                                                 	         @endif
                                                     	  @endforeach
      
								                   </div>          

                                                 @endif
									         
								        
									        <h1>{{$post->title}}</h1>
									        <p class="blog-byline">{{ $post->created_at->diffForHumans()}}</p>
									        <p class="blog-story-post">{{$post->post}}</p>
									        
									        
									        

									         @if($post->comments()->count() != null   )
									            <div class="cmtLink">

									            	<a href="#" class="postCm comment-link"><i class="fas fa-comment-alt"></i> Comments({{$post->comments()->count()}})</a>

									            </div>
									         @else
									            <div class="cmtLink" >
									               <a href="#" class="postCm comment-link"><i class="fas fa-comment-alt"></i> Leave a comment</a>
							                    </div>
									         @endif
								        </div>
								         <div   class="cDIv">
								         	
								         </div>
								   
					                 </div>
							


							@else
							  <p>No posts added yet.</p>
							@endif
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="user-blog-list">

						<h2>More Blogs</h2>
							{{-- list blog here             --}}
							@if( isset($posts)  && $posts->isNotEmpty()  )
							  
							  @foreach($posts as $value)
							    <div class="showLposts">
							    	<div class="blog-list-holder">	
							    		<div class="row">
								    		<div class="col-md-2 col-xs-2">
								    			<div class="bloglist-imageholder">
								    				<img  class="user-bloglist-image"  src="data:image/jpeg;base64,<?php echo base64_encode( $value->file); ?>" />
								    			</div>
								    		</div>

								    		<div class="col-md-10 col-xs-10">
										    	<input type="hidden" name="" id="pid" value="{{$value->id}}">
										    	<h4>{{$value->title}}</h4>
										    	<p class="blog-byline"> {{$value->author}}, {{$value->created_at->diffForHumans()}}</p>
										    	
										    	@if($value->comments()->count() != null  )
										    	   <p>comments ({{$value->comments()->count()}})</p>

										    	@endif
										    	<div class="postLinks">
										    		<a class="viewPost bobo-link">Read</a>
										    	</div>
										    </div>
										</div>
								    </div>
							    </div>
							  @endforeach
							
							@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
