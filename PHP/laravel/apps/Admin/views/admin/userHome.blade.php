<div>
	<div class="listUsers">
		@if( isset($users)  && !empty($users)  )
		   @foreach( $sers as $er)
		      <div clas="usersDiv">
		      	  Name:{{ $er['name']}}&nbsp;
		      	  Email:{{$er['email']}}
		      	
		      </div>
		   @endforeach
		@else
		   <p>No users set.</p>
		@endif
	</div>
	<form id="userForm">
		@csrf
		<input type="email" name="email" id="userEmail" required>
		<input type="text" name="name"  id="userName" required>
		<input type="submit" value="Add User">
	</form>
</div>