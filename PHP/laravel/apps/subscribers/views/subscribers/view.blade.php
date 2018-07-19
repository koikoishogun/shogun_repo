<div>
{{-- View all subscribers --}}
@if(isset($sub_count)  && $sub_count != null  )
	Total Subscribers :{{$sub_count}}<br>

@endif
@if( isset($subz)  && $subz != null )
		
		@foreach($subz as $value)
			<div class="subDiv">
				<input type="hidden" name="" value="{{$value->id}}" id="subd">
				@if(  $value->name != null  )
				       name:{{$value->name}}<br>
				@endif
				@if(  $value->email != null )
				   email:{{$value->email}}<br>
				@endif
				@if( $value->phone != null)
				   phone:{{$value->phone}}<br>
				@endif
				@if(  $value->category  != null)
				   category:{{$value->category}}<br>
				@endif
				<button class="subDel">Delete</button>
			</div>
				
        @endforeach
	@else
		<p>No subscribers to display</p>
	@endif







</div>