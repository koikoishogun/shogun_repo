 @if( isset($post)  && $post->isNotEmpty($post)   )	
<div class="row">
	<div class="container">
     
	
		<div class="blog-section">				
				<div class="col-md-8">
					<div class="view_div">
					    <div class="post_div one_div">
				 			<h1 class="red most-recent-h1"> Most Recent Story</h1>
									<div class="recent-blog-wrapper">

										<h2 class="blog-title">{{$post->first()->title}}</h2>
										<h4 class="gray byline">Posted {{$post->first()->created_at->diffForHumans()}} by {{$post->first()->name}}</h4>
											
											<div class="blog-image">
												<img  class="img-responsive blog-image-inner"  src="data:image/jpeg;base64,<?php echo base64_encode( $post->first()->files); ?>" />
											</div>

										<div class="recent-blog-body load_cmt">
											<p>{!!$post->first()->body!!}</p>
											<a  class="u_view" id="{{$post->first()->id}}"><span class="blue"><i class="fa fa-commenting " ></i> comments({{$post->first()->comments()->count()}})</span></a>&nbsp;
											<!-- Load Facebook SDK for JavaScript -->
												  <a  href="#" class="fbclick" id="{{$post->first()->id}}">fb</a>
												  <!-- Load Facebook SDK for JavaScript -->
										</div>
									</div>
						</div>
					</div>
				</div>
		</div>

			<div class="col-md-4">
			
					<div class="blog-list">
						   
						<div class="post_page">
							<div class="pagi_up" >

						<h2 class="moreblogs blue">More Blogs</h2>
						     @foreach( $post as $value)
									<div class="blog-thumbnail">	
										<div class="post_div ">
											<div class="row">
													<div class="col-md-3 col-xs-3">
														<div class="blog-list-image">
															<img  class="img-responsive blogger-image-thumbnail"  src="data:image/jpeg;base64,<?php echo base64_encode( $value->files); ?>" />
														</div>
													</div>

													<div class="col-md-9 col-xs-9">
														<div class="blog-thumbnail-text">
															<a  class="view_post"><h4 class="view_post blog-thumbnail-title spess-text" id="{{$value->id}}">{{$value->title}}</h4></a>
															<p class="blog-byline gray">Posted {{$value->created_at->diffForHumans()}} by {{$value->name}}</p>
															
															<span class="blue blog-thumbnail-links"><i class="fa fa-commenting " ></i> comments({{$value->comments()->count()}})</span>&nbsp;&nbsp;
															<a  class="view_post blog-thumbnail-links" id="{{$value->id}}"><span class="blue"><i class="fa fa-commenting " ></i> View</span></a>
															
														</div>
													</div>
												</div>
										</div>
									</div>
						@endforeach
						</div>	
					 </div>
				   @else
					   @if(  ! isset($one)   )
					   <p>No posts yet.</p>
				       @endif
				   
				</div>
			  </div>
			</div>
		

@endif


{{-- view one post --}}

@if(isset($one)  )
	
<div class="one-view">
	 <div class="one_post_div ">
		<div class="row">
		 
			<div class="blog-wrapper">
				<div class="one_com_up">
					<h2 class="blog-title">{{$one->title}}</h2>
					<h4 class="gray byline">Posted {{$one->created_at->diffForHumans()}} by {{$one->name}}</h4>
						<div class="blog-image">
							<img  class="img-responsive blog-image-inner"  src="data:image/jpeg;base64,<?php echo base64_encode( $one->files); ?>" />
						</div>

					<div class="recent-blog-body load_cmt">
						<p class="spess-text">{!!$one->body!!}</p>
						<a  class="one_cmt" id="{{$one->id}}"><span class="blue"><i class="fa fa-commenting " ></i> comments({{$one->comments()->count()}})</span></a>					
					</div>

				</div>
		  </div>
		</div>
	</div>
</div>
	
@endif
	
	</div>
</div>