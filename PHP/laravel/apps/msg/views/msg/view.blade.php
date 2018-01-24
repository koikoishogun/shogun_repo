			
				@if( isset($msg) && $msg->isNotEmpty($msg)  && isset($count)  )
					
			<div class="row msg_div">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="message-count">
							<h4>Total Messages:{{$count}}</h4>
						</div>
					</div>
				</div>
					@foreach( $msg as $value )
				<div class="col-md-6">
					<div class="admin-messages">
						<h3 class="admin-messages-h3"><span class="blue"><i class="fa fa-user-circle"></i> {{$value->name}}</span></h3>
						<p>{{$value->message}}</p>
						<p><i class="fa fa-phone-square"></i> {{$value->phone}} | <i class="fa fa-envelope-open"></i> {{$value->email}}</p>
					     <p><span class="gray"><i class="fa fa-clock-o"></i> {{$value->created_at->diffForHumans() }}</span></p>
					     <a href="#" id="{{$value->id}}" class="del_msg"><i class="fa fa-trash"></i> delete</a>&nbsp&nbsp
					     <a href="mailto:{{$value->email}}?subject=Question"><i class="fa fa-reply"></i> Reply</a>
					</div>
				</div>
					@endforeach
				
			</div>
				    

				    @else
				    		<div class="row">
									<div class="message-holder">
												<img class="no-message-icon"  src = "{{ URL::asset('/images/empty-messages.png')}}" alt = "logo">

													<div class="no-message-msg">
														<h1 class=""> Oops!</h1>
														<p>Seems like no one has sent a message yet.</p>
													</div>
												<div class="how-it-works">
														<h3>How it Works</h3>
														<p>The messages panel receives messages from the questions form in your website. It is provided for customers to seek answers for querries that they might have about your services prior to commiting to make a purchase.</p>
												</div>
									</div>

							</div>
				
							
						
					@endif
			