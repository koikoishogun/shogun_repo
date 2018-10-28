//add subscriber
$("body").on("submit",".sub_form",function(e){
	 e.preventDefault();
	 e.stopImmediatePropagation();
	 var da= new FormData(this);
	 var huyu=$(this);
	 $.ajax({
		 type:"POST",
		 url:"/add/subscriber",
		 data:da,
		 processData:false,
		 contentType:false,
		 success:function(data){
			
			 customResp(data);
        huyu[0].reset();
			 
			 
		 }
		 
	 });
	
	
	
});