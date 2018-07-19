@extends("welcome")
@section("magic")
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
								        
								               	<h1>{{$post->title}}</h1>
								               	 <p class="blog-byline">{{ $post->created_at->diffForHumans()}}</p>
								        {{--Check for header files            --}}

                                               	@if( isset($head)  && $head != null    )
                                                    <div class="blog-story-imageholder">
                                                     	{{--   check for header                 --}}
                                                     	  @foreach( $head as  $key => $value )
                                                     	         @if($key == $post->id)
                                                     	        <img  class="blog-story-image" src="storage/formUploads/{{$value}}">    

                                                     	         @endif
                                                     	  @endforeach   
								                   </div>          

                                                @endif

                                        {{-- End header file check                     --}}
									             
										        
										       
										        <p class="blog-story-post">{{$post->post}}</p>

										  		<p> Tags:{{$post->tag}} <b>
										         	{{-- Check for tags    --}}
												         @if(  isset($tag)   && $tag != null)
												                 @foreach( $tag as  $key => $value )
												                          @if( $key == $post->id )
													                               @foreach($value as $vava)
													                                      {{$vava}}
													                               @endforeach
												                          @endif
												                         
												                 @endforeach
												         @endif
										         </b><p>

										        

										         {{--  Check for footer images        --}}
                                                  @if(  isset($footer)   && $footer != null )
                                                  		
                                                          @foreach(    $footer as $fots)
		                                                          @foreach( $fots as $rt)
		                                                          	<div class="blog-story-imageholder">
		                                                              <img class="blog-story-image" src="storage/formUploads/{{$rt}}">
		                                                            </div>
		                                                          @endforeach
                                                              
                                                          @endforeach
                                                        
                                                  @else
                                                     <p>No footer</p>

                                                  @endif

										         {{--  End check       --}}
										        
										        	
										        	<img class="signature" src="img/signature.png">

										         @if($post->comments()->count() != null   )
										            <div class="cmtLink">
										         
										            <a href="#" class="postCm comment-link"><i class="fas fa-comment-alt"></i> Comments({{$post->comments()->count()}})</a>
										            </div>
										         @else
										            <div class="cmtLink" >
										               <a href="#" class="postCm comment-link"><i class="fas fa-comment-alt"></i> Comment</a>
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
							<img class="drop-arrow"  src = "{{ URL::asset('/img/drop_arrow_blog.png')}}" alt = "">

							<h2>More Blogs</h2>
								{{-- list blog here             --}}
								@if( isset($posts)  && $posts->isNotEmpty()  )
								  
								  @foreach($posts as $value)
								    <div class="showLposts">
								    	<div class="blog-list-holder">	

									    			{{-- check for header image   --}}
									    			 @if( isset($head)  && $head != null    )
                                                  <div class="user-bloglist-imagewrapper">
                                                     	{{--   check for header                 --}}
                                                     	  @foreach( $head as  $key => $va )
                                                 	         @if( $key == $value->id )
                                                 	<img  class="user-bloglist-image" src="storage/formUploads/{{$va}}">    

                                                 	         @endif
                                                     	  @endforeach
      
								                   </div>          

                                                 @endif

									    			{{--  end       check for header image                  --}}

									    		<div class="user-bloglist-textwrapper">
											    	<input type="hidden" name="" id="pid" value="{{$value->id}}">
											    	<h4>{{$value->title}}</h4>
											    	<p class="blog-byline">{{$value->created_at->diffForHumans()}}</p>
											    	
											    	@if($value->comments()->count() != null  )
											    	   <p>comments ({{$value->comments()->count()}})</p>

											    	@endif
											    	<div class="postLinks">
											    		<a class="viewPost readme"><i class="fab fa-readme"></i> Read</a>
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
@endsection
