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
