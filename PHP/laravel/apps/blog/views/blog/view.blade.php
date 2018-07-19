@if( isset($posts)  && $posts->isNotEmpty()  &&  $count != null )
							
<div class="blog-count">Total posts:<span class="blog-count-number"> {{$count}}</span></div>

	 <div class="bloglist-wrapper">  
	   @foreach( $posts as $value)
	   		<div class="blog-list">
			      <div class="postDiv">
			      	<input type="hidden" name="post" value="{{$value->id}}" id="pId">

			      	 <h3 class="bloglist-title">{{$value->title}}</h3>
			         <p class="bloglist-byline">{{ $value->created_at->diffForHumans() }}</p>

			      	{{--  Get post header file                      --}}
			      	{{--  Check for header image       --}}
			         @if( isset($headerI)  && $headerI != null   )
			              {{--  Check for matching keys in hi              --}}
			             
			            <div class="images-wrapper">
			              @foreach($headerI as $key => $fid      )
			                     @if( $key == $value->id ) 
			                          <img class="bloglist-image" src='{{$fid}}'>
			                     @endif

			              @endforeach
			            </div>
			         @endif
	
                     								{{--       Check for tags          --}}
                                                      @if( isset($tags) )
	                                                      <p class="bloglist-tags">Tags: <b>
	                                                        {{--  Check for matching keys in tags           --}}
		                                                        {{--   loop through tags                                         --}}
		                                                        @foreach( $tags as $key => $tag )
		                                                               {{--Compare keys        --}}
		                                                             @if( $value->id  == $key)
		                                                                 {{-- Show tags         --}}
		                                                                 @foreach(  $tag as $showTags )
		                                                                       {{$showTags}},

		                                                                 @endforeach


		                                                             @endif

		                                                        @endforeach   
	                                                      </b></p>
                                                      @endif
			         <!-- post:{{$value->post}}-->
			         


	                <div class="pLinks">
						<p class=""><i class="fab fa-readme"></i> <a class="postView bloglink">view</a>&nbsp; &nbsp;

						@if( $value->comments()->count() != null    )
							 <i class="fas fa-comments"></i> comments:{{$value->comments()->count()}} &nbsp;
						@else
							<i class="fas fa-comments"></i> comments:(0) &nbsp;
						@endif


						{{-- Check if post is featured                   --}}
							@if($value->feature == "feature")
								<a href="#" class="unfat bloglink"><span class="pink"><i class="fas fa-star"></i></span> unfeature </a>
							@else
								<a href="#" class="fat bloglink"><span class="pink"><i class="far fa-star"></i> </span> feature </a>
							@endif  
						</div>
			    </div>
			</div>
	   @endforeach
	</div>							

@else
	<p>No posts added yet.</p>
@endif
