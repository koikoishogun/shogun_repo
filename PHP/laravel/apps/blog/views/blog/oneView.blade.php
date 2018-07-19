
					@if( isset($post)  && $post != null  )

							<div class="one-view">
							   <div class="postDiv">
							      	<input type="hidden" name="post" value="{{$post->id}}" id="pId">

 
							         <h1>{{$post->title}}</h1>
							         <p class="blog-byline">{{ $post->created_at->diffForHumans()}}</p>
							         {{-- Check for tags    --}}
							         
							         <p> Tags:{{$post->tag}} <b>
							         	{{-- Check for tags    --}}
									         @if(  isset($tag) )
									                 @foreach( $tag as $value )
									                 {{$value}}
									                 @endforeach
									         @endif
							         </b><p>


							         {{--  Check for header image             --}}
							      	@if(   isset($head)   && $head != null   )
							      	    <div class="blog-image-holder"> 
							      	      <img class="blog-image" src='{{$head}}'>
							      	    </div>
							      	@endif
							      	{{--  End Check for header image             --}}

								         


							         <p>{{$post->post}}</p>  
                                      
                                         {{-- Check for footer images --}}
                                         @if(isset($footer) )
                                               @foreach( $footer as $value)
                                                 @foreach($value as $vivi)
                                                 <div class="blog-image-holder">
                                                 	    <img class="blog-image" src='{{$vivi}}'>
                                                 </div>
                                                        
                                                 @endforeach
                                               @endforeach
                                               @else
                                               <p>Noo footetr</p>
                                         @endif
                                        
                                        {{--  End Check for footer images --}}
					                  
							         <p class="bloglinks-wrapper">
							         	{{-- Check for a link            --}}
							         	<div class="linkDiv">
				         	      @if( $post->link != null  )
				         	            
				         	             	link is http//premiumkingincubators.com/blogs/{{$post->link}}
				         	             
				         	      @else
				         	        Add link http//premiumkingincubators.com/<input type="text" name="link" required placeholder="type link here" id="linkVava"><button class="linkAdd">Add</button>
				         	      @endif
				         	      </div>
							         	{{-- End Check for a link            --}}
								         
						        		{{-- CHECKING FOR COMMENTS--}}

						        		@if( $post->comments()->count() != null)
								            <a class="cmtBtn bloglink"><i class="fas fa-comments"></i> Comment({{$post->comments()->count()  }})</a> &nbsp;&nbsp;
								        @else
								           <a class="cmtBtn bloglink"><i class="fas fa-comments"></i> Comment</a>&nbsp;&nbsp;
								        @endif

								        <a  class="postUp bloglink"><i class="fas fa-edit"></i> Update</a>&nbsp;&nbsp;
								        <a class="postDel bloglink"><i class="fas fa-trash"></i> Delete</a> &nbsp;&nbsp;
								         
								          {{-- Check if post is featured                   --}}
								         @if($post->feature == "feature"         )
								            <a href="#" class="unfat bloglink"><span class="pink"><i class="fas fa-star"></i></span> unfeature</a>
								         @else
								            <a href="#" class="fat bloglink"><span class="pink"><i class="far fa-star"></i></span> feature</a>
								         @endif
								    </p>
							         
							         <div class="commentSHow">
							         	
							         </div>
							         	
							         </div>
							    </div><br>
							</div>
							  
					@else
							   <p>No posts added yet.</p>
					@endif
