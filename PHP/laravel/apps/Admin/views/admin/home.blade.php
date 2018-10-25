@extends("admin.base")
@section("body")


	<div class="admin-header">
		<div class="admin-logo-holder">
			<h2>Admin panel</h2>
		</div>
		
		<button type="button"  class="logout-btn">logout <i class="fas fa-sign-out-alt"></i></button>
	</div>
	
	<div class="adminHome">
		<div class="adminSide">
		 <a href="/event" class="lodg" cl=".loadContent"><img src="/img/events.svg"><span class="link-text"> Events</span></a>
		{{--<a href="#" class="lodg" cl=".loadContent"><img src="/img/booking.svg"> <span class="link-text"> Bookings</span></a> --}}
			<a href="/view/subscriber" class="lodg" cl=".loadContent"><img src="/img/subscribers.svg"> <span class="link-text"> Subscribers</span></a>
			<a href="/view/messages" class="lodg" cl=".loadContent"><img src="/img/msgs.svg"> <span class="link-text"> Messages</span></a>
			<a href="/admin/blog" class="lodg" cl=".loadContent"><img src="/img/blog.svg"> <span class="link-text"> Blog</span></a>
		</div>

		<div class="loadContent">
			<div class="on-boarding">
				<div class="on-boarding-text">
					<img src="img/admin-home.svg">
					<h2>Admin Panel</h2>
					<h4>Welcome to the admin panel. Its an ‘easy to use’ interface that helps you manage contents on your website with increadible ease.</h4>
				</div>
			</div>
		</div>
		
	</div>

@endsection

