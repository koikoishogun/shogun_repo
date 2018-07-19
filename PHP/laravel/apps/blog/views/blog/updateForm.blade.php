
	<div class="blog-update-form">
		<h1 class="blog-update-form-title">Update Blog</h1>
		@if(  isset($post) && $post != null   )
			<form id="upPost">
				{{csrf_field()}}
				<input type="hidden" name="postId" value="{{$post->id}}" id="postId">
				{{--  Check for header image                 --}}
				@if( isset($header)     )
				   <div class="headerImgs">
					   	<span class="delHeader">
					   		X
					   		<?php echo $header;?>
					   	</span>
				   	    
				   </div>
				   {{--  Upload header image button           --}}
				   <div class="showUploadHeaderBtn"  style="display: none;">
				   	<input type="file" name="headerFile" id="updateHeader" style="display: none;">
				   	<button type="button" class="upHBtn">add Header Image</button>
				   	
				   </div>
				     
				@endif
				{{--  End check for header image --}}
				
				<div class="form-group">
					<label for="blogTitle">Blog Title:</label>
					<input type="text" name="title"  id="blogTitle" class="form-control" value="{{$post->title}}" required>
				</div>

				<!--<div class="form-group">
					<label for="blogAuthor">Blog Author:</label>
					<input type="text" name="name" id="blogAuthor" class="form-control" required  value="{{$post->author}}">
				</div> -->

				
				<div class="form-group">
					<label for="blogArticle">Blog Article:</label>
					<textarea type="text" name="text" rows="7" class="form-control" id="blogArticle" required>{{$post->post}}</textarea>
				</div>

				<div class="form-group">
					<label for="blogTags">Relevant Tags:</label>
					 {{--  Check for tags        --}}
					 @if( isset($tag)     && $tag != null )
					 <input type="text" name="tag" class="form-control" id="blogTags" required 

					 value="<?php foreach( $tag as $ta) {


					 	echo $ta;} ?>">
                     @else
                       <p>Error couldn't display tags</p>
					 @endif
						
					
				</div>

				<div class="row image-btn-holder">
					<!-- <div class="update-image-holder">
					 
					 	<img  class="update-image"  src="data:image/jpeg;base64,<?php echo base64_encode( $post->file); ?>" />
					</div> -->
                    {{--   Show Footer images         --}}
                          @if( isset($foot)   )
                           <div class="footerImages">
	                           	<div class="showFooterdivs">
	                           		@foreach( $foot as $value)
	                             
	                              	
	                              		<span class="delFooter">X

	                                     <?php  echo $value; ?>
	                              		</span>  
	                              
	                              	  
	                             
	                                 
	                                @endforeach
	                           		
	                           	</div>
	                           	<div class="foIBdiv">
	                           		<input type="file" style="display: none;" name="footerImg" id="footerImage">
	                           		<button type="button" class="footerImgBtn">Add more Images</button>
	                           		
	                           	</div>
                             
                            </div>
                          @endif


                    {{--End footer images                      --}}

					
					
				</div>
					
					<input type="submit"  class="blog-button update-button" value="update blog">
			</form>
		@else
			<p>
				Error.Unauthorized access.
			</p>

		@endif
	</div>
