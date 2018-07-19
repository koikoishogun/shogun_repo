@if( $cid != null && isset($cid)  )
<div  class="replyContainer">
		<div class="replyForm">

			<h4>Post reply</h4>
			 <form class="userReply">
			 	<input type="hidden" name="ghjl" value="{{$cid}}">
			 	
			 	{{csrf_field()}}
			 	
			 	<div class="form-group">
			 		<textarea name="text" required class="form-control" placeholder="your reply"></textarea>
			 	</div>

			 	<div class="form-group">
			 		<input type="text" name="name" class="form-control" required placeholder="your name">
			 	</div>
			 	

			 	<button type="submit" class="blog-button"> Reply <i class="fas fa-chevron-circle-right"></i></button>
			 

			 	

			 </form>
			
		</div>
		<div class="loadReply">
		
		 @if( isset($replies)  && $replies->isNotEmpty()  )
			@foreach( $replies as $value)
			  <div class="showReply">
			  	
			  	<input type="hidden"  value="{{$value->id}}" id="repID">
			  	<img class="comments-avatar"  src = "{{ URL::asset('/img/reply-avatar.png')}}" alt = "avatar">

			  		<div class="admin-replies-wrapper">

			  			<p><b>{{$value->name}}</b></p>
			  			<p>{{$value->text}}<p>
					  	<p>{{$value->created_at->diffForHumans()}}</p>
					  	
					  	@if($value->email)
					  	  email:{{$value->email}}<br>
					  	@endif
					  	
					  	<a class="delREply bloglink"><i class="fas fa-trash"></i> Delete reply</a>
					</div>
			  </div>
			@endforeach
		 @else
		   <p>No replies yet.Be the first to reply.</p>
		 @endif
			
		</div>
</div>
@else
 <p>Ooops an error occured.Try reloading the page.</p>
@endif