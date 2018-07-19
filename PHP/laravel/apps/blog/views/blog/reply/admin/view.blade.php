@if( isset($replies)  && $replies->isNotEmpty()  )
			@foreach( $replies as $value)
			  <div class="showReply">
			  	<input type="hidden" name="" value="{{$value->id}}" id="repID">
			  	<img class="comments-avatar"  src = "{{ URL::asset('/img/reply-avatar.png')}}" alt = "avatar">

			  	<div class="admin-replies-wrapper">

			  		<p><b>{{$value->name}}</b></p>
			  		<p>{{$value->text}}</p>
				  	<p>{{$value->created_at->diffForHumans()}}</p>
				  	
				  	@if($value->email)
				  	  email:{{$value->email}}<br>
				  	@endif

				  	<a class="delREply bloglink"><i class="fas fa-trash"></i> Delete reply</a>
				</div>
			  </div><br>
			@endforeach
		 @else
		   <p>No replies yet.Be the first to reply.</p>
		 @endif