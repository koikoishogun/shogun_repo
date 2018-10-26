			
				@if( isset($msg) && $msg->isNotEmpty($msg)  && isset($count)  )
					
			<div class="msg_div enquiries">
				<div class="messages-wrapper">
					
					<div class="message-count">
							<h4>Total Messages:</h4>
							<h4>{{$count}}</h4>
					</div>

					@foreach( $msg as $value )

					<div class="admin-messages">		
						<div class="admin-messages-header">
							<img src="/img/avatar.svg">
							
							<div class="messages-header-details">
								<h3>{{$value->name}}</h3>
								
								<div class="admin-messages-details">
									<p><i class="fa fa-phone-square"></i> {{$value->phone}}</p>
									<p><i class="fa fa-envelope-open"></i> {{$value->email}}</p></p>
								</div>
							</div>
						</div>

						<div class="admin-message-text">
							<input type="hidden"  value="{{$value->id}}" class="mkjasdf">
							<h4>Message:</h4>
							<p>{{$value->message}}</p>
							<h5>{{$value->created_at->diffForHumans() }}</h5>
						</div>

						<div class="actions">
						     <a href="#" id="{{$value->id}}" class="del_msg"><i class="fa fa-trash"></i> delete</a>&nbsp&nbsp
						     <a href="mailto:{{$value->email}}?subject=Question"><i class="fa fa-reply"></i> Reply</a>
						</div>
					</div>
					@endforeach
				</div>
			</div>
				    

				    @else
									<div class="message-holder">
										<div class="no-message-wrapper">
											<img src="/img/inbox.svg">
												
											<div class="no-message-msg">
												<h1 class="">Inbox Empty!</h1>
												<p>You do not have messages at the moment</p>
											</div>
										</div>
									</div>
					@endif
			