<div>
@if(  isset($posts) && $posts != null  )
            {{-- LOOP THROUGH ALL POSTS              --}}
	  @foreach($posts as $psdf      )
            {{--   Loop through all parsed post with tags         --}}
          @if(isset($parsed)    &&  $parsed != null )
                  {{--  Loop through all      --}}
                    @foreach($parsed as $parse)
                            {{--  Match with post       --}}
			                @if(  $psdf->id == $parse )
			                         {{--   Show post    --}}
	                   {{-- Show post       --}}
	                   {{--  looop through all header i            --}}
	                   @foreach(  $head as $ert => $ghj)
		                   @if( $ert ==  $parse )
		                          <img src="storage/formUploads/{{$ghj}}">
		                   @endif

	                   @endforeach
	                   <p>Title:{{ $psdf->title     }}</p>
	                   <p>Title:{{ $psdf->post     }}</p>
	                   {{--  loop through all tags                 --}}
	                   Tags:
	                   @foreach(   $tags as $er => $ty)
	                       @if(  $er == $parse)
	                            @foreach( $ty as $qa)
	                             {{$qa}}
	                            @endforeach
		                   @endif
	                   @endforeach

	                   {{--Loop all footer i        --}}
	                   @foreach(   $foot as $df => $xc )
	                       @if( $df == $parse)
	                         @foreach(   $xc as $wewe)
	                         <img src="{{$wewe}}">
	                         @endforeach
		                   @endif
	                   @endforeach
			                   
			                
			                @endif
			                {{--  End match      --}}
                              
              
	                @endforeach
                    {{-- End parse         --}}
			                }
          @endif
          {{-- End parse  --}}

	  @endforeach


@endif




</div>