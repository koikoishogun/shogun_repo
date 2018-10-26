<div class="userHome">
	<div class="listUsers">
		@if( isset($users)  && !empty($users)  )
		   @foreach( $sers as $er)
		      <div clas="usersDiv">
		      	<input type="hidden" id="dfg" value="{{$er->id}}">
		      	Created:{{$er['time']}}
		      	  Name:{{ $er['name']}}&nbsp;
		      	  Email:{{$er['email']}}
		      	  <button type="button" class="delUser">Delete</button>
		      	
		      </div>
		   @endforeach
		@else
		   <p>No users set.</p>
		@endif
	</div>
	<form id="userForm" class="login-form">
		@csrf
		<input type="email" name="email" id="userEmail" required>
		<input type="text" name="name"  id="userName" required>
		<input type="submit" value="Add User">
	</form>
</div>
