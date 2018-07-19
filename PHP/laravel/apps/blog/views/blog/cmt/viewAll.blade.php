
		   	  	@if(   isset($cmts)  &&  $cmts->isNotEmpty() && $count != null )
		   	  	 Total Comments: {{$count}}
		   	  	 @foreach( $cmts as $value )

		   	  	 	<div class="admin-comment-wrapper">
			   	  	    <div class="showCmt">
			   	  	    	<input type="hidden" name="postId" value="{{$value->id}}" id="cId">

			   	  	    	<img class="comments-avatar"  src = "{{ URL::asset('/img/cmt-avatar.png')}}" alt = "avatar">

			   	  	         
			   	  	    	<div class="admin-comments-wrapper">
				   	  	        
			   	  	    		<p><b>{{$value->name}}</b></p>
				   	  	        <p>{{$value->comment}}<p>
				   	  	         
				   	  	        @if($value->email)
				   	  	         	email{{$value->email}}<br>
	                            @endif
	                             
	                            @if( $value->replies->count() == null  )
			                        <a class="cmtReply bloglink"><i class="fas fa-reply"></i> Reply</a> &nbsp; &nbsp; 
			                    @else
			                         <a class="cmtReply bloglink"> <i class="fas fa-reply"></i> Reply({{$value->replies->count()}})</a> &nbsp; &nbsp;
			                    @endif

			                    <a  class="cmtDel bloglink"> <i class="fas fa-trash"></i> Delete</a>
			                    
			                    {{-- @if( !$value->email  )
			                        <button class="cmtUp">Update</button>

			                    @endif --}}
	                              <div class="repliesHere">
			                             	
			                      </div>
			                </div>
			   	  	        
			   	  	    </div>
			   	  	</div>

		   	  	 @endforeach

		   	  	@else
		   	  	  <p>No comments yet.Add comments</p>
		   	  	@endif
		   	  	