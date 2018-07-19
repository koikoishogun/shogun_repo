@if( $cid != null && isset($cid)  )
<div  class="replyContainer">
		<div class="replyForm">
			 <form class="userReply">
			 	<input type="hidden" name="ghjl" value="{{$cid}}">
			 	
			 	<div class="form-group">
			 		<textarea name="text" class="form-control" placeholder="enter your reply"></textarea>
			 	</div>

			 	<div class="row">
			 		<div class="col-md-6">
			 			<input type="email" name="email" class="form-control" placeholder="your email">
			 		</div>

			 		<div class="col-md-6">
			 			<input type="text" name="name" class="form-control" placeholder="your name">
			 		</div>
			 	</div>
			 	{{csrf_field()}}
			 	<input type="submit" class="blog-button form-button" value="Reply">
			 </form>
		</div>
		

			 @if( isset($replies)  && $replies->isNotEmpty()  )
				@foreach( $replies as $value)

				  <div class="loadReply">
				  	<div class="row">
					  		<img class="comments-avatar"  src = "{{ URL::asset('/img/reply-avatar.png')}}" alt = "avatar"> 
					  	

					  	<div class="replies-holder">
						  	<p><b>{{$value->name}}</b></p>
						  	<p>{{$value->created_at->diffForHumans()}}</p>
						  	<p>{{$value->text}}</p>
					  	</div>
					</div>
				  </div>

				@endforeach
			 @else
			   <p>No replies yet.Be the first to reply.</p>
			 @endif	
			</div>

@else
 <p>Ooops an error occured.Try reloading the page.</p>
@endif