//------------------------------------------------------------------
    /*  Admin js goes here
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
   
     /*
     *Lgin admin

     */
   
   //login admin
   $(document).on("submit","##login-form",function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    //alert(window.location.pathname);
    //alert(window.location.host);
    var huyu=$(this);
  var data=[];
    data['url']="/admin/login";
    data['data']=new FormData(this);
    var sele=$(".magic").find(".adminContent");
    //console.log(sele);
    data['success']=function(data){
      //var spinner="";
      //$(".adminContent").empty().html(spinner);
      //show spinner after successful load
      $(".login-form-wrapper").hide();
      $(".spin").show();

            if(data.error){
                customResp(data);
                //show form hide spinner
                $(".spin").hide();
                $(".login-form-wrapper").show();
                
             
                huyu[0].reset();

            }
            else{
               window.location.href="/admin"; 
            }
      
      }
     


    
    ajaxPost(data);
    //
     


   });

   //logout admin 
   $(document).on("click",".logout-btn",function(e){
      e.preventDefault();
      e.stopImmediatePropagation();
      
      var dat=[];
      
      dat['url']="/admin/logout";
      dat['success']=function(data){
          if(data.error){
            customResp(data);

          }
          window.location.href="/login";

      }
      ajaxGET(dat);

   });

   //add new admin instance
   $("body").on("submit","#userForm",function(e){
      e.preventDefault();
      e.stopImmediatePropagation();
      //get data
      //var data=new FormData(this);
      //get name
      var nan=$("#userName").val();
      //get email
      var nasd=$("#userEmail").val();
      var dat=[];
      //check if exists
      if ( nan && nasd) {
        var pass=2018;
        dat['url']="/add/user/"+nan+"/"+nasd+"/"+pass; 
        dat['data']=data;
        var sel=$(".userHome");
      
        dat['success']=function(data){
          customResp(data,sel);

        }
        ajaxGET(dat);
      }
      


   });
   //delete admin instance
   $("body").on("click",".delUser",function(e){
     e.preventDefault();
     e.stopImmediatePropagation();
     //get id for user
     var idi=$(this).parents(".usersDiv").find("#dfg").val()
     //check if true
     if (idi) {
      var ty=new FormData();
      ty.append("id",idi);
      var dat=[];
      dat["url"]="/delete/user";
      dat['data']=ty;
      dat['success']=function(data){
        customResp(data);
      }
      ajaxPost(dat);

     }



   });
   //update admin