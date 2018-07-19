
{{-- Load selected post here                   --}}
							@if(isset($post) && $post != null     )
							  
								    <div class="psDiv">
							             <div class="postsHere blog-content">
							               	<input type="hidden"  value="{{$post->id}}" id="pId">
								            
								            <h1>{{$post->title}}</h1>
									        <p class="blog-byline">{{ $post->created_at->diffForHumans()}}</p>

								            {{--  Add header files                      --}}
									         @if( isset( $head )  &&   $head != null )
                                                <div class="blog-story-imageholder">   
                                                   <img class="blog-story-image" src="storage/formUploads/{{$head}}">
                                                </div>
									         @endif
									        
									        <p class="blog-story-post">{{$post->post}}</p>
									        {{--    Check for tags  --}}
									          @if(  isset($tags) && $tags != null     )
									            Tags:
									              @foreach( $tags as $tata)
									                     {{$tata}}
									              @endforeach
									          @endif

									        {{--  End tag check      --}}
									        
									        {{--Check for file types               --}}
									         @if( $post->file)
									            <div class="blog-story-imageholder">
									            	<img  class="blog-story-image"  src="data:image/jpeg;base64,<?php echo base64_encode( $post->file); ?>" />
									            </div>
									         @endif
									         {{--    Footer images         --}}
									         @if( isset($footer)  && $footer != null   )
									             @foreach($footer as $vaava )
									                   
									                   @foreach( $vaava as $ertd)
									                   	<div class="blog-story-imageholder">
									                   		<img class="blog-story-image" src="storage/formUploads/{{$ertd}}">
									                   	</div>
									                   @endforeach

									             @endforeach
									         @endif

									          
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
							  <p>Error.No post set.</p>
							@endif