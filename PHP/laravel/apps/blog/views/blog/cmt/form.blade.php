@if( isset($postId) && $postId != null  )

		<div class="cmtForm">
			<h4>Post Comment</h4>
			<form  id="cmtForm">
				{{csrf_field()}}
				<input type="hidden" name="postId" value="{{$postId}}">
				
				<div class="form-group">	
					<textarea name="text" class="form-control" placeholder="your comment"></textarea>
				</div>

				<div class="form-group">
					<input type="text" name="name" class="form-control"  placeholder="your name">
				</div>

				<button type="submit"  class="blog-button">comment <i class="fas fa-chevron-circle-right"></i></button>
				
			</form>
		</div>

		
@else
	  <p>Error.No post.</p>

@endif

