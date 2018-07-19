<div class="user-comment-form">
	
	<h3>Post your comment</h3>

	@if( isset($postId) && $postId != null  )
		<form  id="cmtForm">
			{{csrf_field()}}
			<input type="hidden" name="postId" value="{{$postId}}">
			<div class="form-group">
				<textarea name="text" class="form-control" placeholder="Your comment" required></textarea>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="text" name="name" class="form-control" placeholder="Your name" required>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="Your email" required>
					</div>
				</div>
			</div>

			<button type="submit" class="blog-button"> comment <i class="fas fa-chevron-circle-right"></i></button>

		</form>
	@else
	  <p>Error.No post.</p>

	@endif
</div>