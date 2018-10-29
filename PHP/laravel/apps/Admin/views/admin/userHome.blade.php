<div class="userHome">
	<div class="listUsers">
		@if( isset($users)  && !empty($users)  )
		   @foreach( $users as $er)
		      <div class="usersDiv">
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
	</div>
	<form id="userForm" >
		{{csrf_field()}}
		<input type="email" name="email" id="userEmail"  placeholder="Enter email"  required>
		<input type="text" name="name"  id="userName"  placeholder="Enter name" required>
		<input type="submit" value="Add User">
	</form>
</div>
