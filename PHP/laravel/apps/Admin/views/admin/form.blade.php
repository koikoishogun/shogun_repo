<div>
	<form id="userForm">
		@csrf
		<input type="email" name="email" id="userEmail" required>
		<input type="text" name="name"  id="userName" required>
		<input type="submit" value="Add User">
	</form>
</div>