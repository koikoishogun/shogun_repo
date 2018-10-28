 /*  Subsciber js goes here
      *
      *
      *
      *
      *
      *
      *
      *
      *
      */
      //________________________________________________________________________________________
 
      $("body").on("click",".subDel",function(e){
           e.preventDefault();
           e.stopImmediatePropagation();
           var id=$(this).closest(".subDiv").find("#subd").val();
           var dat=[];
           var sele=$(".loadContent");
           if (id) {
             dat['url']="/del/subscriber/"+id;
             dat['success']=function(data){
                customResp(data,sele);

             }
             ajaxGET(dat);

           }
           else{
            $(".load_msg").empty().html("<p>Oops..An error occured.</p>");
            $("#mlo").modal("show");
           }
           




      });