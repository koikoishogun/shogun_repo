<div class="cmtDiv">
	<div class="comments-holder">
		<img class="drop-arrow"  src = "{{ URL::asset('/img/drop_arrow_blog.png')}}" alt = "">
		
	           @if( isset( $pi)  &&  $pi != null )
		   	     <input type="hidden" id="pi" value="{{$pi}}">
		   	   @endif
		   	 
		   	  <div class="cmtLinks">
		   	  	@if(isset($count) && $count != null )
		   	  		<div class="add-comment">
		   	  	  		<a href="#" class="addCmt readme"><i class="fas fa-plus-square"></i> Add comments({{$count}})</a>
		   	  	  	</div>
		   	  	@else
		   	  		<div class="add-comment">
		   	  	    	<a href="#" class="addCmt readme"><i class="fas fa-plus-square"></i> <b>Add comment<b></a>
		   	  	    </div>
		   	  	@endif
		   	  </div>


		   	  {{--  View comments            --}}
		   	  <div class="loadcmt">
					
						   	  	@if(   isset($cmts)  &&  $cmts->isNotEmpty()  )
						   	  	
						   	  	 @foreach( $cmts as $value )
							   	  	<div class="user-comments-holder">    
							   	  	    <div class="showCmt">
							   	  	    	
							   	  	    	<input type="hidden"  value="{{$value->id}}" id="cid">


							   	  	         <img class="comments-avatar"  src = "{{ URL::asset('/img/cmt-avatar.png')}}" alt = "avatar"> 

							   	  	         	<div class="comments-text-folder">
								   	  	         	
								   	  	         	<p><b>{{$value->name}}</b></p>
								   	  	         	<p>{{$value->created_at->diffForHumans()}}</p>
								   	  	         	<p>{{$value->comment}}</p>
						                            
						                             {{-- Check for replies               --}}
						                             <a class="cmtReply bobo-link"> <i class="fas fa-reply"></i>Reply
						                             @if( $value->replies->count() != null  )
						                                 ({{$value->replies->count()}})
						                             @else
						                                   
						                             @endif
						                             </a>
						                             
						                            <div class="repliesHere">

						                        	</div>
				                             </div>
							   	  	        
							   	  	    </div>
							   	  	</div>

						@endforeach

						@else
						   	<p class="no-comments">No one has commented yet. Be the first comment</p>
						@endif
             </div>
    </div>
</div>
