@extends("admin.base")


@section("body")
  <div class="adminContent">   
        <div class="login-form-wrapper">
          
          <div class="login-form-header">  		
	          	<img src="/img/blue-logo.png"> 		
          </div>

          <div class="login-formholder">
	          
			<h2>Login</h2>
	          <form id="loginAdmin" class="login-form" >
	          	 {{ csrf_field() }}
	            	<input type="email" name="email" required placeholder="Enter email" class="form-control">
	            	<input type="password" name="password" required placeholder="Enter password" class="form-control">
	            <button type="submit"  class="login makuku-button btn"><b>Login</b></button>
	         </form>
	       </div>
        </div> 
  </div>
  
	<div class="spin" style="display: none;">
		<div class='loader' style='maragin:auto;'> 
		</div>
    </div>
@endsection
 

