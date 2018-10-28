/*  Msg js goes here
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

   //delete a particular message
      $("body").on("click",".del_msg",function(e){
           e.preventDefault();
           e.stopImmediatePropagation();
           var is=$(this).parents(".msg_div").find("#mid").val();
           
          var dat=[];
          var sel=$(this).closest(".loadContent");
          dat['url']="/del/message/"+is;
          dat['success']=function(data){
              customResp(data,sel);
              
              //alert("Reply deleted successfully.");

          }
          ajaxGET(dat);

          

      });