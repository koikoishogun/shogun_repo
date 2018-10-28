<script type="text/javascript" src="/js/admin/msg.js"></script>

<div class="msg_div">

  @if( isset($msg)  && $msg->isNotEmpty() && isset($count)   )
	
	<div class="message-count">
		Total messages:{{$count}}
	</div>
	  @foreach( $msg as $value )
		<div class="message-holder msg_div">
			<input type="hidden" id="mid" value="{{$value->id}}">
			<img class="message-avatar" src ="{{ URL::asset('/images/admin/avatar.png')}}">
            <div class="message-content-holder">
				<h3><b>{{$value->name}}</b></h3>
				<p><b>t:</b> {{$value->phone}} &nbsp;&nbsp; <b>e:</b> {{$value->email}}<br>
				
				<h4 class="message-title">Message:</h4>
				<p>{{$value->message}}</p>
				<p class="gray">{{  $value->created_at->diffForHumans()}}</p>
				 <input type="hidden"  value="{{$value->id}}"  id="msg" />
				 <button type="button" class="del_msg" >Delete</button>
			</div>
		</div>		 
      @endforeach
  @else
	  <p>No messages placed  yet</p>
  @endif


</div>