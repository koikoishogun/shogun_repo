@if( isset($cmt) && $cmt != null )
	<div>
		<form  id="upForm">
			{{csrf_field()}}
			<input type="hidden" name="postId" value="{{$cmt->post_id}}">
			body:<input type="text" name="text" value="{{$cmt->comment}}">
			name:<input type="text" name="name" value="{{$cmt->name}}">
			email:<input type="email" name="email" value="{{$cmt->email}}">
			<input type="submit" name="" value="update">
			
		</form>
	</div>
@endif