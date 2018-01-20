<div class="cmt_div"> 
@if(isset($post_id))
		   
			<div class="comments-form-holder">
				<div class="comments-wrapper">
				   <form class="create_comment" >
					 {{csrf_field()}}

					 <input type="hidden" name="post_id"  class="form-control spess-text" value="{{$post_id}}"  />

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
					 		<input type="text" name="message" class="form-control spess-text" placeholder="type comment"/>
					 	</div>
					</div>
				</div>

				<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<input type="text" name="name" class="form-control spess-text" placeholder="name"/>
							</div>
						</div>

						<div class="col-md-5">
							<div class="form-group">
								<input type="email" name="email" class="form-control spess-text" placeholder="email not made public"/>
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<button type="submit" class="btn btn-success">comment</button>
							</div>
						</div>
					</div>

				   </form>
				  </div>
				
					  
						   @if( isset($cmt)  && $cmt->isNotEmpty()  )
							   @foreach( $cmt as $value)
									<div class="comments">
										<p class="spess-text">{{$value->message}}</p>
										<p class="gray">{{$value->created_at->diffForHumans()}} by
										{{$value->name}}</p>

									</div>
							   @endforeach
						  	
						  	@else
							   <p>No comments to display.</p>
					   		 @endif

			</div>
			
      
 @endif
 </div>