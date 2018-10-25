<div>
	@if( isset($post)  && $post != null )
	<h1>Recent Blogs</h1>
	<?php  return var_dump($post);  ?>
		@foreach( $post as $value)

				<div class="recent-blog-wrapper">
					  {{--   header     --}}
				      @if( $value['header'])
				        <img src="{{$value['header']}}">
				         
				      @endif
					
					
					<div class="blog-text-wrapper">
						<h5>
							@if( $value['title'])
								<p>
						           {{   $value['title']     }}
						        </p>
					        @endif
							
						</h5>
						
							
							@if( $value['post'])
								<p>
						           {!! $value['post'] !!}
						        </p>
					        @endif
						 <div>
						 	Tags:
						 	@if( $value['tags'])
							 	@foreach($value['tags'] as $er)
							 	  {{$er}}
							 	@endforeach
						        
						    @endif
						 </div>
						
						<div class="blog-details">
							<p class="date">Posted
							   {{--  Check time  --}}
						      @if( $value['time'])
						         {{$value['time']}}
						      @endif 
							</p>
							<button>Read story</button>
						</div>
					</div>
				</div>
		@endforeach
	@else
	<p>
		No posts added yet.
	</p>


	@endif
</div>