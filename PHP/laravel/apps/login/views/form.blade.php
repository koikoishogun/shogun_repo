<!DOCTYPE HTML5>
<html>
	<head>
	<script src="{{ URL::asset('/js/jquery-3.2.1.min.js')}}"></script>
     <script src="{{ URL::asset('/js/login/login.js')}}"></script>
     <link href="{{ URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet">
     <link href="{{ URL::asset('/css/spess.css')}}" rel="stylesheet">
	  <script src="{{ URL::asset('/js/bootstrap.min.js')}}" ></script>
	 <title>Admin</title>
	 <style>
				.loader {
				border: 5px solid #f3f3f3; /* Light grey */
				border-top: 5px solid #3498db; /* Blue */
				border-bottom: 5px solid #3498db; /* Blue */
				border-radius: 50%;
				width: 60px;
				height: 60px;
				animation: spin 2s linear infinite;
				margin:auto;

			}
			#empty_mod{
				margin:auto;
			}

			@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}
		 
		 
		 
		 </style>

	</head>

	<body>

				<div class="col-md-4 col-md-offset-4">
					<div class="login-form">
						<div class="login-form-header">
							<h1>SPESS Admin Login</h1>
						</div>

						<div class="login-form-body">
							   <form class="login_form">
							   {{csrf_field()}}

								   	<div class="form-group">
									  <input type="email" class="form-control"  placeholder="Enter Email" name="email" />
									</div>

									<div class="form-group">
									  <input type="password" class="form-control"  placeholder="Enter Password"  name="pass"/>
								   	</div>

								   	<div class="form-group">
									   <button type="submit" class="btn btn-warning" >Log In</button>
									</div>
							   </form>
						</div>
					</div>
				</div>
					<!--  Loading Modal -->
<div id="empty_mod" class="modal fade  " role="dialog" data-backdrop="static">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content load_modal modal-sm">
      
    </div>

  </div>
</div>
{{--               MSG MODAL            --}}
<div id="Msg_modal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close " data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body MSG_LOAD">
        
      </div>
      <div class="modal-footer">
	  {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
      </div>
    </div>

  </div>
</div>
{{--               MSG MODAL            --}}

	</body>

</html>