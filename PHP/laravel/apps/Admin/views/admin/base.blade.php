<!DOCTYPE html>
<html>
	<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <link href="{{ URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="/css/admin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css"/ >
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/cropper.min.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
     
    <script type="text/javascript" src="{{ URL::asset('/js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('/js/admin/admin.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('/js/cropper.min.js')}}"></script>
	
		   
       <!-- Loader style   -->
           <style>
        .loader {
          border: 6px solid #f3f3f3;
          border-radius: 50%;
          border-top: 3px solid red;
          width: 60px;
          height: 60px;
          -webkit-animation: spin 2s linear infinite; /* Safari */
          animation: spin 1s linear infinite;
          margin:auto;
        }
        img.crp{
          max-width: 100%;
        }
       

        /* Safari */
        @-webkit-keyframes spin {
          0% { -webkit-transform: rotate(0deg); }
          100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
           </style>
            <title>Admin Panel</title>
            @yield("head")
	</head>
	<body>
              <div class="magic">
                @yield("body")
                
              </div>
                     
              
		
		 

     <!-- Modal -->
        <div id="loadModal" class="modal"  tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                            <div class="modal-content">
                                
                                <div class="modal-header">
                                    
                                    <h4 class="modal-title" id="loadTitle">
                                           Loading...
                                    </h4>
                                </div>
                                <div class="modal-body">
                                        <div class="loader"></div>  
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                                    
                            </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        

                
        <!-- Msg Modal -->
        <div id="mlo" class="modal"  tabindex="-1" role="dialog"  aria-labelledby="modaTitk" aria-hidden="true">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close " data-dismiss="modal">&times;</button>
                <h4 class="modal-title"  id="modaTitk">Bluemotion</h4>
              </div>
              <div class="modal-body  load_msg">
                
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
              </div>
            </div>

          </div>
        </div>

	</body>
</html>