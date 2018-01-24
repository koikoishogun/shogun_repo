
@if( isset($orders) && $orders->isNotEmpty() && isset($numbers)  )

	<div class="row order_up">
		<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="message-count">
						    <h4>Total Enquiries:{{$numbers}}</h4>
		@foreach( $orders as $value )
						</div>
					</div>
				</div>
				
			<div class="col-md-6">
					<div class="admin-messages">
						<h3><i class="fa fa-user-circle"></i> {{$value->name}}</h3>

						<h4><b><span class="blue">Quote for:</b></span><br> {{$value->service }}</h4>
						 <p><i class="fa fa-phone-square"></i> {{$value->phone}} | <i class="fa fa-envelope-open"></i> {{$value->email}}</p>
						 <p><span class="gray"><i class="fa fa-clock-o"></i> {{$value->created_at->diffForHumans() }}</span></p>
						 <a href="#" id="{{$value->id}}" class="del_order"><i class="fa fa-trash"></i> delete</a>&nbsp&nbsp
					     <a href="mailto:{{$value->email}}?subject=Your Order"><i class="fa fa-reply"></i> Reply</a>
				    </div>
			</div>
		@endforeach
	</div>
@else
	<div class="row">
									<div class="message-holder">
												<img class="no-message-icon"  src = "{{ URL::asset('/images/empty-orders.png')}}" alt = "logo">

													<div class="no-message-msg">
														<h1 class=""> No quotes requested!</h1>
														<p>Seems like no one has requested for a quote yet.</p>
													</div>
												<div class="how-it-works">
														<h3>How it Works</h3>
														<p>The orders section receives quotation requests from clients who have already shown willingness to purchase a certain service.</p>
												</div>
									</div>

							</div>
@endif

