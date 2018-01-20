<div class="col-md-7">
		<div class="blogform-section">
		{{-- view update div --}}
				@if(isset($up_post)  )
						<h3><span class="blue"><i class="fa fa-plus-circle"></i> Edit article</span></h3>
					
						<form class="up_post">
						   {{csrf_field()}}

						   	 <div class="form-group">
								<label for="blogtitle">Blog Title:</label>
							  	<input type="text" class="form-control" name="title"  id="blogtitle" value="{{ $up_post->title  }}">
							 </div>

							 <input type="hidden"  value="{{ $up_post->id}}" name="id"/>

							 <div class="form-group">
								<label for="blogauthor">Blog Author:</label>
							  	<input  type="text"  class="form-control" name="name" value="{{ $up_post->name  }}" id="blogauthor" />
							 </div>

							 <div class="form-group">
								<label for="editor">Blog Article:</label>
								<textarea name="body" class="form-control" id="editor">{{ $up_post->body }}</textarea>
							 </div>

							 <div class="form-group">
								<label for="blogcat">Blog Category:</label>
							  	<input type="text"  class="form-control" name="category"  value="{{ $up_post->category  }}" id="blogcat"/>
							 </div>

							  <img  class="img-responsive blog-image"  src="data:image/jpeg;base64,<?php echo base64_encode( $up_post->files); ?>" /><br>
							  
							  Replace with:<input type="file"  name="ff" /><br>
							  <button type="submit" class="btn btn-success">Update blog</button>
							  <button type="button" class="btn btn-warning load_ajax" href="/view/post" cl="admin_content">Cancel</button>
						   
						 </form>

				@endif
				{{--  End view update div --}}
					
				@if(isset($one)  )
							<div class="one_div">
										<img  class="img-responsive blogger-image"  src="data:image/jpeg;base64,<?php echo base64_encode( $one->files); ?>" />
									

									
										<h4>{{$one->title}}</h4>
										<p>Posted {{$one->created_at->diffForHumans()}} by {{$one->name}}</p>
										   
										   
										   Body:{!!$one->body!!}
										    
										    Category:{{$one->category}}<br>
										<a href="#" class="view_cmt" id="{{$one->id}}"><span class="blue"><i class="fa fa-commenting"></i> comments({{$one->comments()->count()}})</span></a>
							
                            </div>
					@endif	

				    @if( ! isset($one) &&  ! isset($up_post)  )
					
					<div  class="one_post">
						<h3><span class="blue"><i class="fa fa-plus-circle"></i> Create a new article</span></h3>
							
							<form class="ad_post" >
								   {{csrf_field()}}

								   <div class="form-group">
								   		<label for="blogtitle">Blog Title:</label>
									  <input type="text" class="form-control" name="title"  placeholder="blog title" id="blogtitle">
								   </div>

								   <div class="form-group">
								   		<label for="blogauthor">Blog Author:</label>
									  <input  type="text" class="form-control"  placeholder="author" name="name" id="blogauthor" />
								   </div>

								   <div class="form-group">
								   		<label for="editor">Blog Article:</label>
									  <textarea name="body" class="form-control" id="editor" placeholder="your blog..." rows="6"></textarea>
									</div>

									<div class="form-group">
								   		<label for="blogcat">Blog Category:</label>
									  		<input type="text"  class="form-control" placeholder="category" name="category" id="blogcat" />
									 </div>

									 <div class="form-group">
								   		<label for="blogimage">Upload image:</label>
									  		<i class="fa fa-cloud-upload"></i><input type="file" name="ff" id="blogimage"/>
									  </div>
									  <button type="submit" class="publish-btn" >Publish blog <i class="fa fa-plus-circle"></i></button> 
							 </form>
					 </div>
					 @endif

				</div>
			</div>

	@if( isset($post)  && $post->isNotEmpty() && isset($cnt)  )	
	<div class="col-md-5">
		<div class="recent-blogs">
			<h3 class="recent-blogs-header">Recent Blogs</h3>
				
		               Total Posts:{{$cnt}}
					   @foreach( $post as $value)
							<div class="post_div more-blogs">
								<div class="row">

										<div class="col-md-3">
											<img  class="img-responsive blogger-image"  src="data:image/jpeg;base64,<?php echo base64_encode( $value->files); ?>" />
										</div>

									<div class="col-md-9">
										<h4>{{$value->title}}</h4>
										<p>Posted {{$value->created_at->diffForHumans()}} by {{$value->name}}</p>
										
										<i class="fa fa-commenting"></i> comments({{$value->comments()->count()}})</span>&nbsp;&nbsp;
										<a href="#" class="edit_post" id="{{$value->id}}"><span class="blue"><i class="fa fa-pencil-square-o"></i> update</span></a>&nbsp;&nbsp;
										<a href="#" class="del_post" id="{{$value->id}}"><span class="red"><i class="fa fa-trash"></i> delete</span></a>&nbsp;&nbsp;
										<a href="#" class="view_post" id="{{$value->id}}"><span class="red"><i class="fa fa-trash"></i> view</span></a>
									</div>
								</div>
							</div>
					   @endforeach
			  
			@else
				@if( ! isset($up_post) && ! isset($one) )
					   <p>No posts to display.</p>
				@endif
		@endif
		</div>		   
	</div>


 
	<script src="[ckeditor-build-path]/ckeditor.js"></script>	
	<script>
		ClassicEditor
		    .create( document.querySelector( '#editor' ) )
		    .then( editor => {
		        console.log( editor );
		    } )
		    .catch( error => {
		        console.error( error );
		    } );
	</script>
  
