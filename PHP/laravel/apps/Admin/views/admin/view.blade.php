@if( isset($users)  && !empty($users)  )
   @foreach( $users as $er)
      <div clas="usersDiv">
      	<input type="hidden" id="dfg" value="{{$er['id']}}">
	      	Created:{{$er['created']}}
			Updated:{{$er['updated']}}
      	  Name:{{ $er['name']}}&nbsp;
      	  Email:{{$er['email']}}
      	  <button type="button" class="delUser">Delete</button>
      	
      </div>
   @endforeach
@else
   <p>No users set.</p>
@endif