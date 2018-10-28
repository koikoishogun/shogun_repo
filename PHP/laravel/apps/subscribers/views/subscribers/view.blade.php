
{{-- View all subscribers --}}
@if(isset($sub_count)  && $sub_count != null  )
	
	<div class="subscribers">
		
		<div class="subscribers-wrapper">
		
			<div class="total-subscribers">
				<h4>Total Subscribers</h4>
				<h4>{{$sub_count}}</h4>
			</div>


		@if( isset($subz)  && $subz->isNotEmpty() )
				

				@foreach($subz as $value)
					<div class="subscriber-wrapper subDiv">
						<input type="hidden" name="" value="{{$value->id}}" id="subd">
						
						<div class="subscribers-details subDiv">
							@if(  $value->email != null )
								<div class="subscriber-details">
									<img src="/img/avatar.svg">
									<p>{{$value->email}}</p>
								</div>
							@endif 
							<a href="#" class="subDel"><i class="fa fa-trash"></i><span class="delete-sub-btn">Delete</span</a>
						</div>
					</div>
						
				@endforeach
		</div>
	</div>
@else
	<div class="message-holder">
		<div class="no-message-wrapper">
			<img src="/img/admin/no-subscriber.png">
			<div class="no-message-msg">
				<h1 class="">No Subscribers!</h1>
				<p>Seems like no one has subscribed yet.</p>
			</div>
	</div>
	</div>
@endif
       
	@else
		<div class="message-holder">
			<div class="no-message-wrapper">
				<img src="/img/avatar.svg">
				<div class="no-message-msg">
					<h1 class="">No Subscribers!</h1>
					<p>Seems like no one has subscribed yet.</p>
				</div>
			</div>
		</div>
	@endif
