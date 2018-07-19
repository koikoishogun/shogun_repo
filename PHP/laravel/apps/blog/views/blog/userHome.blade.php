{{--  Show featured posts here          --}}


<div class="showFeaturedPOsts">
         @if(isset($fe)  && $fe->isNotEmpty()   )

                    @foreach($fe as $value)
                    {{-- Need for js       --}}
                    <div   class="fWrapeer">
                            <div class="row">
                              <input type="hidden"  value="{{$value->id}}" id="foid">
                                  {{-- Check for headr image         --}}
                                    @if( isset($headerI)   && $headerI != null  )
                                          {{--  Check for matching keys in hi              --}}
                                          @foreach($headerI as $key => $fid      )
                                                 @if( $key == $value->id )
                        <div class="slider" style=" background-image:linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 59%, rgba(0, 0, 0, 0.9) 100%), url('{{$fid}}'); background-position: center top;">              
                                                 @endif

                                          @endforeach

                                     @endif
                                
                                    {{--  End check for header image      --}}

                                </div>
                            </div>

                             <div class="row">
                            
                                        <div class="my-story">
                                                <div class="col-md-6">
                                                    <div class="featured_stories">
                                                        <h1>{{$value->title}}</h1>
                                                        <p>{{$value->created_at->diffForHumans()}}</p>
                                                        <button class="blog-button fread">Read More <i class="fa fa-chevron-circle-right"></i></button>
                                                    </div>
                                                </div>

                                            <!--    
                                                <div class="col-md-6">
                                                    <div class="about_me">
                                                        <h1>{{$value->tag}}</h1>
                                                        <p>{{$value->post}}...</p>
                                                    </div>
                                                </div>
                                            -->
                                        </div>
                            </div>
                      
                    </div>
                            
                              

                           
                            @endforeach
                         @else
                           <p class="">
                              No featured post 
                           </p>
                        @endif  
</div>






{{--  Show other blogs here          --}}
<div class="row">
                        <div class="recent-blogs">
        <!--REPEATING SECTION-->
                            @if(isset($posts) && $posts->isNotEmpty() )  
                                @foreach($posts as $value)
                                      {{--Check if feature posts exists         --}}
                                          @if(isset($fe)  && $fe->isNotEmpty()   )
                                                    {{--filter feature images           --}}
                                                    @foreach($fe as $fet)
                                                           {{-- Compare keys   --}}
                                                           @if($fet->id != $value->id)
                                                               <div class="col-md-6">
                                                                    <div class="blog-holder Loadpp">
                                                                        <input type="hidden"  value="{{$value->id}}" id="oid">

                                                                         {{--  Check for header image       --}}
                                                                                     <div class="blog-image-holder">
                                                                                         @if( isset($headerI)    )
                                                                                          {{--  Check for matching keys in hi      <img src='{{$fid}}'>        --}}

                                                                                          @foreach($headerI as $key => $fid      )
                                                                                                 @if( $key == $value->id )
                                                                                                  <div class="blog-image-holder" style="background-image: url('{{$fid}}');  background-color: #ebebeb; background-position: center top">
                                                                                                        

                                                                                                      </div>   

                                                                                                 @else
                                                                                                   <p>
                                                                                                     No header image to display.
                                                                                                   </p>

                                                                                              
                                                                                                 @endif

                                                                                          @endforeach

                                                                                        @endif
                                                                                     </div>   

                                                                                <div class="blog-text-holder">
                                                                                        <img class="drop-arrow"  src = "{{ URL::asset('/img/drop_arrow.png')}}" alt = "">    
                                                                                        <h1>{{$value->title}}</h1>
                                                                                        <p class="date">{{$value->created_at->diffForHumans() }}</p>

                                                                                        {{--       Check for tags          --}} 
                                                                                           @if( isset($tags) && $tags != null )
                                                                                          <p>Tags:<b>
                                                                                            {{--  Check for matching keys in tags           --}}
                                                                                            {{--   loop through tags                                         --}}
                                                                                            @foreach( $tags as $key => $tag )
                                                                                                   {{--Compare keys        --}}
                                                                                                 @if( $value->id  == $key)
                                                                                                     {{-- Show tags         --}}
                                                                                                     @foreach(  $tag as $showTags )
                                                                                                           {{$showTags}}

                                                                                                     @endforeach


                                                                                                 @endif

                                                                                            @endforeach
                                                                                             
                                                                                              
                                                                                          </b></p>
                                                                                          @endif 
                                                                                          {{--   end tag check              --}} 


                                                                                        <hr class="border-short">

                                                                                        <p class="blog-story">
                                                                                            {{$value->post}}
                                                                                        </p>
                                                                                </div>

                                                                                <button class="blog-button story_button">Read Full Story <i class="fa fa-chevron-circle-right"></i></button>
                                                                         
                                                                                     

                                                                                  
                                                                        </div>
                                                                </div>
                                                           @endif
                                                    @endforeach


                                          {{-- End if       --}}
                                          @else
                                              {{--   Show all posts        --}}
                                              <div class="col-md-6">
                                                                    <div class="blog-holder Loadpp">
                                                                        <input type="hidden"  value="{{$value->id}}" id="oid">

                                                                         {{--  Check for header image       --}}
                                                                                     <div class="blog-image-holder">
                                                                                         @if( isset($headerI)    )
                                                                                          {{--  Check for matching keys in hi      <img src='{{$fid}}'>        --}}

                                                                                          @foreach($headerI as $key => $fid      )
                                                                                                 @if( $key == $value->id )
                                                                                                  <div class="blog-image-holder" style="background-image: url('{{$fid}}');  background-color: #ebebeb; background-position: center top">
                                                                                                        

                                                                                                      </div>   

                                                                                                 @else
                                                                                                   <p>
                                                                                                     No header image to display.
                                                                                                   </p>

                                                                                              
                                                                                                 @endif

                                                                                          @endforeach

                                                                                        @endif
                                                                                     </div>   

                                                                                <div class="blog-text-holder">
                                                                                        <img class="drop-arrow"  src = "{{ URL::asset('/img/drop_arrow.png')}}" alt = "">    
                                                                                        <h1>{{$value->title}}</h1>
                                                                                        <p class="date">{{$value->created_at->diffForHumans() }}</p>

                                                                                        {{--       Check for tags          --}} 
                                                                                           @if( isset($tags) && $tags != null )
                                                                                          <p>Tags:<b>
                                                                                            {{--  Check for matching keys in tags           --}}
                                                                                            {{--   loop through tags                                         --}}
                                                                                            @foreach( $tags as $key => $tag )
                                                                                                   {{--Compare keys        --}}
                                                                                                 @if( $value->id  == $key)
                                                                                                     {{-- Show tags         --}}
                                                                                                     @foreach(  $tag as $showTags )
                                                                                                           {{$showTags}}

                                                                                                     @endforeach


                                                                                                 @endif

                                                                                            @endforeach
                                                                                             
                                                                                              
                                                                                          </b></p>
                                                                                          @endif 
                                                                                          {{--   end tag check              --}} 


                                                                                        <hr class="border-short">

                                                                                        <p class="blog-story">
                                                                                            {{$value->post}}
                                                                                        </p>
                                                                                </div>

                                                                                <button class="blog-button story_button">Read Full Story <i class="fa fa-chevron-circle-right"></i></button>
                                                                         
                                                                                     

                                                                                  
                                                                        </div>
                                                                </div>



                                          @endif
                                  
                                  
                                @endforeach
                            @else
                               <p>No posts yet.</p>
                            @endif             
                           
        <!--END REPEATING SECTION-->
                    </div>
                </div>