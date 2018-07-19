<div class="blogHome">
	         <div class="col-md-8 ">
					{{--  This is where content is dynamically loaded   onchange=" handleFileSelect(event,'showHeader')"               --}}	
						<div class="middle-section loadStuff">
							<h2 class="new-blog-heading"> Start a new blog</h2>
							<form id="postForm">
								
								{{csrf_field()}}
								{{--thi is where the header image is selected                               --}}
								{{-- Constrain to actual size   of photo --}}
								<div class="headerPost header-image-wrapper">

										<div id="showHeader" >
											
										</div>

                                    <!-- <img src="" id="header"> -->

                                    	<input type="file" name="headerImage" style="display: none;" id="headerFile"   >
                                    	  
									 	<button type="button" class="uploadHeader makuku-button btn"><i class="fas fa-upload"></i> Upload main image</button> Recommended (1200X600)px
	
                                    
                                    
									
								</div>
								
								<div class="form-group">
									<label for="blogTitle">Blog Title:</label>
									<input type="text" name="title" class="form-control" id="blogTitle" required>
								</div>

								<!-- <div class="form-group">
									<label for="blogAuthor">Blog Author:</label>
									<input type="text" name="name" class="form-control" id="blogAuthor" required>
								</div> -->

								<div class="form-group">
									<label for="blogArticle">Blog Body:</label>
									<textarea type="text" name="text" rows="7" class="form-control" id="blogArticle" required></textarea>
								</div>	

								<div class="form-group">
									<label for="blogTags">Relevant Search Tags (separated by a comma (,) ):</label>
									<input type="text" name="tag" class="form-control" id="blogTags" required placeholder="fashion,style,natural hair,beauty">
								</div>
								
								
								<div class="more-blogimages-wrapper">
									<div id="showFooterImage">
										
									</div>

			                        <div class="footerPost footer-button">
			                        	<input type="file" name="footerImage" style="display: none;" class="footerImage">
									    <button href="#" class="addFooterImage makuku-button btn"><i class="fas fa-upload"></i> Add more images to your story</button>
			                        </div>
			                    </div>

								<button type="submit" class="blog-button makuku-button-inverse btn">Publish Blog <i class="fas fa-share-square"></i></button>
							</form>
						</div>
					</div>

					<div class="col-md-4 showPost">

								@if( isset($posts)  && $posts->isNotEmpty()  &&  $count != null )
											
											<div class="blog-count">
												<h4>Total posts:<span class="pull-right"> {{$count}}</span></h4>
											</div>

									<div class="bloglist-wrapper">  
									   @foreach( $posts as $value)
									   		<div class="blog-list">
											      <div class="postDiv">
											      	<input type="hidden" name="post" value="{{$value->id}}" id="pId">

											         <h4 class="bloglist-title">{{$value->title}}</h4>
											         <p class="bloglist-byline">
											         	created {{ $value->created_at->diffForHumans() }}, last updated {{ $value->updated_at->diffForHumans() }}
											         </p>
											         
											         <div class="images-wrapper">	
												         @if( isset($headerI)  && $headerI != null  )
                                                              {{--  Check for matching keys in hi              --}}
                                                              @foreach($headerI as $key => $fid      )
                                                                     @if( $key == $value->id )
                                                                          
                                                                <img class="bloglist-image" src='{{$fid}}'>       
                                                                          
                                                                     @endif

                                                              @endforeach

                                                         @endif
                                                      </div>


                                                      {{--       Check for tags          --}}
                                                      @if( isset($tags) )
	                                                      <p class="bloglist-tags">Tags: <b>
	                                                        {{--  Check for matching keys in tags           --}}
		                                                        {{--   loop through tags                                         --}}
		                                                        @foreach( $tags as $key => $tag )
		                                                               {{--Compare keys        --}}
		                                                             @if( $value->id  == $key)
		                                                                 {{-- Show tags         --}}
		                                                                 @foreach(  $tag as $showTags )
		                                                                       {{$showTags}},

		                                                                 @endforeach


		                                                             @endif

		                                                        @endforeach   
	                                                      </b></p>
                                                      @endif
                                                      
											         
											         <!-- post:{{$value->post}}-->
											         


									                  <div class="pLinks">
													         
									                  		 <p class=""><i class="fab fa-readme"></i> <a class="postView bloglink">view</a>&nbsp; &nbsp;

													         @if( $value->comments()->count() != null    )
													            <i class="fas fa-comments"></i> comments:{{$value->comments()->count()}} &nbsp;
													         @else
													            <i class="fas fa-comments"></i> comments:(0) &nbsp;

													         @endif
													         {{-- Check if post is featured                   --}}
													         @if($value->feature == "feature")
													            <a href="#" class="unfat bloglink"><span class="pink"><i class="fas fa-star"></i></span> unfeature </a>
													         @else
													            <a href="#" class="fat bloglink"><span class="pink"><i class="far fa-star"></i> </span> feature </a>
													         @endif  
											         </div>
											         
											         
											    </div>
											</div>
									   @endforeach
									</div>		

							 @else
							   <p>No posts added yet.</p>
							 @endif
					</div>
</div>
				

	


</div>