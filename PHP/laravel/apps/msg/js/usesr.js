//save msg
	$("body").on("submit",".msg_form",function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		var da=new FormData(this);
		var hii=$(this);
		
		$.ajax({
			async:true,
			type:"POST",
			data: da,
			url:'/new/message',
			processData:false,
			contentType:false,
			success:function(data){
			hii[0].reset();
			customResp(data);
				
			}
			
			
		});