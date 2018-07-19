<div>
	<form class="orderForm">
		    {{csrf_field()}}

	<input type="text" name="name" placeholder="enter name">
	<input type="email" name="email" placeholder="enter email">
	<input type="text" name="phone" placeholder="enter phone no">
	<input type="number" name="quantity" placeholder="enter the quantity">
	<input type="submit" value="Place Order">
		
	</form>
</div>