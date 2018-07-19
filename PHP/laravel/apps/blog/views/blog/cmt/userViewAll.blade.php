<div class="comts">
		   	  	@if(   isset($cmts)  &&  $cmts->isNotEmpty() && $count != null )
		   	  	 Total Comments: {{$count}}
		   	  	 @foreach( $cmts as $value )
		   	  	 	<div class="user-comments-holder">
			   	  	    <div class="showCmt">
			   	  	    	
			   	  	    	<input type="hidden" name="cId" value="{{$value->id}}">

			   	  	    	<img class="comments-avatar"  src = "{{ URL::asset('/img/cmt-avatar.png')}}" alt = "avatar">

			   	  	    	<div class="omments-text-folder">

			   	  	    		<p><b>{{$value->name}}</b></p>
				   	  	         <p>{{$value->created_at->diffForHumans()}}</p>

				   	  	         <p>{{$value->comment}}<p>

				   	  	         @if($value->email)
				   	  	         	email{{$value->email}}<br>
	                             @endif
	                             
	                             @if( $value->replies->count() == null  )
	                                  <a class="cmtReply"><i class="fas fa-reply"></i> Reply</a>
	                             @else
	                                   <a class="cmtReply"><i class="fas fa-reply"></i> Reply ({{$value->replies->count()}})</a>
	                             @endif
	                             
		                         <div class="repliesHere">
		              	
		                         </div>
		                    </div>   
			   	  	    </div>
			   	  	</div>

		   	  	 @endforeach

		   	  	@else
		   	  	  <p>No comments yet.Add comments</p>
		   	  	@endif
		   	  	
 </div>