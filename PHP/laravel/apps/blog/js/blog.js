 // add new post
      $("body").on("submit","#postForm",function(e){
             e.preventDefault();
             e.stopImmediatePropagation();
             var huyu=$(this);
             var da= new FormData();
             //get text for post
             var tesdxt=[];
             tesdxt["value"]=$("#blogArticle").val();
             tesdxt['name']=$("#blogArticle").attr('name');
             da.append(tesdxt['name'],tesdxt["value"]);

             //get tags for post
             var tag=[];
             tag['name']=$("#blogTags").attr('name');
             tag['value']=$("#blogTags").val();
             da.append(tag['name'],tag['value']);

             //get post title
             var tit=[];
             tit['name']=$("#blogTitle").attr('name');
             tit['value']=$("#blogTitle").val();
             //console.log(tit['name']+" value is "+ tit['value'] );

             da.append(tit['name'],tit['value']);

             //get post header image 
             var headerImg=[];
             headerImg['name']="headerImage";
             headerImg['value']=$("#showHeader").find(".imageTyt").val();
             //console.log(headerImg);
             da.append( headerImg["name"],headerImg['value']  );

             //check if footer image and header is present
             var footerIk=$("#showFooterImage").find(".imageTyt");
             //
            if(  headerImg['value'] == null  &&   footerIk == null  ){
                var msg="Oops.....Can't post without a post header or footer image.";
                return returnEmmpty(msg);
             

             }
             
             footerIk.each(
                   function(index,element){
                    /*if( index == 0){
                      alert(  "This is"+index+" : "+element);

                    }
                    alert(index+":"+element);*/
                      //alert( "index :"+index+": Attr:"+$(this).attr('name'));
                          
                           da.append("footerImages[]", $(this).val() );
                           //console.log("key :"+index+ " value:"+$(this).val());






                   }


                  );

             
            
            

             //console.log(footerIk);
             //console.log(headerImg['value']);

             $.ajax({
                type:"POST",
                url:"/blog/save",
                data:da,
                processData:false,
                contentType:false,
                success:function(data){
                  //remove all pics
                  $(".loadStuff").find(".imageDiv").remove();
                  $(".uploadHeader").show();
                  huyu[0].reset();
   
                  if(data.html){
                    $(".showPost").empty().html(data.html);
                  }
                  if(data.error){
                    $(".showPost").empty().html(data.error);
                  }
                 //$(".filesDiv").empty();

                }
             });
           



      });

      //display file upload dialog on footer image
      $("body").on("click",".addFooterImage",function(e){
             e.preventDefault();
             e.stopImmediatePropagation();
             var dat=[];
             //var huyu=$(this);
             dat['sel']=$(".footerImage");
             fileClick(dat);
             //dat['sel']=$("#upFile");
             

             //$("#upFile").trigger("click");//.show();
             //
             //alert(name);



      }  );


      //delete selected post
      $("body").on("click",".postDel",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();

         //var pId=$("#pId").val();

         //make ajax call
         var id=$(this).parents(".postDiv").children("#pId").val();
         var dat=[];
         var sd=$(this).parents(".adminContent");
         //dat["data"]={"post_id":};
         dat["url"]="/blog/delete/"+id;
         dat["success"]=function(data){
           
            customResp(data,sd);
            $(".load_msg").empty().html("SuccessPost deleted.");
            $("#mlo").modal("show");
            
         }
         ajaxGET(dat);




            

      });

      //return update form post
      $("body").on("click",".postUp",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            //alert("test");
            var id=$(this).parents(".postDiv").find("#pId").val();
                var dat=[];
                dat['url']="/post/update/form/"+id;
                var sel=$(this).parents(".blogHome").find(".middle-section");
                dat['success']=function(data){
                   
                    customResp(data,sel);


                }
                ajaxGET(dat);

          
           






      });

      //save updated post
      $("body").on("submit","#upPost",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var dat=[];
        //dat['data']=new FormData(this);
        //Add form data
        var thisForm=new FormData();
        //add title
        var title=$("#blogTitle").val();
        thisForm.append("title",title);

        //Add blog article
        var article=$("#blogArticle").val();
        thisForm.append("text",article);

        //Add blog tag
        var tag=$("#blogTags").val();
        thisForm.append("tag",tag);

        //Add  blog update header image
        var hi=$(".headerImgs").children(".imageTyt").val();

        thisForm.append("headerImage",hi);


        //Add footer images for blog update form
        var fi=$(".showFooterdivs").children(".imageTyt");
        fi.each( function(index,element){

          thisForm.append("footerImages[]",$(this).val());
        });

        //Add post id
        var piid=$("#postId").val();
        thisForm.append("postId",piid);

        dat['data']=thisForm;

        dat['url']="/save/updated/blog";
        var select=$(this).parents(".blogHome").find(".middle-section");
        //console.log(select);
        dat['success']=function(data){
            //var select=".blogHome";
            customResp(data,select);

        }
        ajaxPost(dat);




      });

       //return comment admin view
      $("body").on("click",".cmtBtn",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            var huyu=$(this);
            var dat=[];
            var id=$(this).parents(".postDiv").find("#pId").val();
            var sdf=$(this).parents(".postDiv").find(".commentSHow");
            dat['url']="/admin/cmt/home/"+id;
            dat['success']=function(data){

                customResp(data,sdf);

            }
            ajaxGET(dat);
            //$().hide();



      });

      //return comment form 
      $("body").on("click",".cmtAdd", function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            var hu=$(this);
            var dat=[];
            var id=hu.parents(".postDiv").find("#pId").val();
            var ser=hu.parents(".addCmt");
            dat['url']="/cmt/form/"+id;
            dat['success']=function(data){
                customResp(data,ser);

            }
            ajaxGET(dat);




      });

       //return admin comment base view
      $("body").on("click",".cmtBtn",function(e){
         e.preventDefault();
         e.stopImmediatePropagation();
         //alert("test");
         var id=$(this).parents(".postDiv").find("#pId").val();
         var huyu=$(this);
         var dat=[];
         var er;
         dat['url']="/admin/cmt/home/"+id;
         dat['success']=function(data){
            //load tag
             er=huyu.parents(".postDiv").find(".commentsDiv");
            customResp(data,er);

         }
         ajaxGET(dat);
         //alert(er);
         $(this).parents(".postDiv");



      });

      //save admin comment
      $("body").on("submit","#cmtForm",function(e){
          e.preventDefault();
          e.stopImmediatePropagation();
          var ty=$(this);
          var dat=[];
          var ser=$(this).parents(".postDiv").find(".showComments");
          dat["data"]=new FormData(this);
          dat['url']="/cmt/save";
          dat['success']=function(data){
            customResp(data,ser);

          }
          ajaxPost(dat);
          ty[0].reset();


      });

      //delete comment
      $("body").on("click",".cmtDel",function(e){
         e.preventDefault();
         e.stopImmediatePropagation();
         var dat=[];
         var id=$(this).parents(".postDiv").find("#cId").val();
         var ser=$(this).parents(".postDiv").find(".showComments");
         dat['url']="/delete/comments/"+id;
         dat['success']=function(data){
            customResp(data,ser);

         }
         ajaxGET(dat);

      });

      //view one blog post
      $("body").on("click",".postView",function(e){
         e.preventDefault();
         e.stopImmediatePropagation();
         var id=$(this).parents(".postDiv").find("#pId").val();
         var dat=[];
         var sel=$(this).parents(".blogHome").find(".middle-section");
         dat['url']="/view/one/post/"+id;
         dat['success']=function(data){
            customResp(data,sel);

         }
         ajaxGET(dat);


      });

      //feature a prticular post
      $("body").on("click",".fat",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var dat=[];
        var id=$(this).parents('.postDiv').find('#pId').val();
        var sel=$(this);
        dat['url']="/feature/post/"+id;
        dat['success']=function(data){
            
            customResp(data,sel);
            sel.removeClass("fat");
            sel.toggleClass("unfat");
            
        }
        ajaxGET(dat);
        


      });

      //unfeature a poats
      $("body").on("click",".unfat",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var dat=[];
        var id=$(this).parents('.postDiv').find('#pId').val();
        var sel=$(this);
        dat['url']="/unfeature/post/"+id;
        dat['success']=function(data){
            
            customResp(data,sel);
            sel.removeClass("unfat");
            sel.toggleClass("fat");
        }
        ajaxGET(dat);
        



      });

      //return admin relply home
      $("body").on("click",".cmtReply",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var is=$(this).parents(".showCmt").find("#cid").val();
        var dat=[];
        var sel=$(this).parents(".showCmt").find(".repliesHere");
        dat['url']="/admin/reply/"+is;
        dat['success']=function(data){
            customResp(data,sel);

        }
        ajaxGET(dat);
        


      });

      //return admin relply home
      $("body").on("click",".cmtReply",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var is=$(this).parents(".showCmt").find("#cid").val();
        var dat=[];
        var sel=$(this).parents(".showCmt").find(".repliesHere");
        dat['url']="/admin/reply/"+is;
        dat['success']=function(data){
            customResp(data,sel);

        }
        ajaxGET(dat);
        


      });

      //delete admin reply
      $("body").on("click",".delREply", function(e){
          e.preventDefault();
          e.stopImmediatePropagation();
          var is=$(this).parents(".showReply").find("#repID").val();
        var dat=[];
        var sel=$(this).parents(".replyContainer").find(".loadReply");
        dat['url']="/delete/reply/"+is;
        dat['success']=function(data){
            customResp(data,sel);
            //alert("Reply deleted successfully.");

        }
        ajaxGET(dat);
       


      });


            //trigger click for header upload on post
      $('body').on("click",".uploadHeader",function(e){
          e.preventDefault();
          e.stopImmediatePropagation();
          var dat=[];
          dat['sel']=$("#headerFile");
          fileClick(dat);



      });

  
      //display file upload dialog on footer image
      $("body").on("click",".addFooterImage",function(e){
             e.preventDefault();
             e.stopImmediatePropagation();
             var dat=[];
             //var huyu=$(this);
             dat['sel']=$(".footerImage");
             fileClick(dat);
             //dat['sel']=$("#upFile");
             

             //$("#upFile").trigger("click");//.show();
             //
             //alert(name);



      }  );
     
      
       //$('img#test').imgAreaSelect({ maxWidth: 200, maxHeight: 150, handles: true,show:true });
       //catch submit event for header image
       $("body").on("submit","#asdf",function(e){
        //alert("Captured event submit");
            e.preventDefault();
            e.stopImmediatePropagation();
             var da=new FormData(this);
              var huy=$(this);
              var dat =[];
              //div to empty and load
              var sss=$(this).parents(".headerPost").children("#showHeader");
              dat["data"]=da;
              dat["url"]="/header/post";
              dat["success"]=function(data){
                  customResp(data,sss);
                  huy[0].reset();
                  //$(".proImage").empty();

              }
              ajaxPost(dat);





       });
  //
  //get on  change event for header img
  //save blob to database and get back file id
$("body").on("change","#headerFile",function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    //handleFileSelect(e,"showHeader");
    var sel=$("#showHeader")
    addInput("#headerFile",sel);
    //hide header photo btn
    $(".uploadHeader").hide();
    //add  image area select for header image
    
 //alert("hit");

   


    

  

 });

//get on change event for footer image
$("body").on("change",".footerImage",function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    //handleFileSelect(e,"showHeader");
    var sel=$("#showFooterImage")
    addInput(".footerImage",sel);





});

//delete an image from blog  form
$("body").on("click",".delUploadPhoto",function(e){
      e.preventDefault();
      e.stopImmediatePropagation();
      var hut=$(this).parents(".imageDiv");
      var is=$(this).parents(".imageDiv").find(".imageTyt").val();
      var dat=[];
      var sel=$("fgfdg");
      dat['url']="/del/upload/pic/"+is;
      dat['success']=function(data){
          hut.remove();
          $(".uploadHeader").show();
          customResp(data,sel);

          //alert("Reply deleted successfully.");

      }
      ajaxGET(dat);



}); 

//add link fo blog
$("body").on("click",".linkAdd",function(e){
       e.preventDefault();
      e.stopImmediatePropagation();
      var id =$("#pId").val();
      var link=$("#linkVava").val();
      var dat=[];
      dat['url']="/add/link/"+link+"/"+id;
      var sel=$(".linkDiv");
      dat['success']=function(data){
          //hut.remove();
          //$(".uploadHeader").show();
          customResp(data,sel);

          //alert("Reply deleted successfully.");

      }
      ajaxGET(dat);



});
$.fn.equals = function(compareTo) {
  if (!compareTo || this.length != compareTo.length) {
    return false;
  }
  for (var i = 0; i < this.length; ++i) {
    if (this[i] !== compareTo[i]) {
      return false;
    }
  }
  return true;
};



//delete either a header image or footer for blog update form
$("body").on("click",".delHeader",function(e){
	e.preventDefault();
	e.stopImmediatePropagation();
	//get file id and delete from DB
	//get id of file
	//check for which selector has been selected
	  	//check if header
	  	/*var delHead=$(".delHeader");
	  	var delFooter=$(".delFooter");
	  	//perform get request
	  	
	     var huyu=$(this);
	  	if ( huyu.equals(delHead)    ) {
	  		sel=$(".headerImgs");

	  	}
	  	else if( huyu.equals(delFooter)     ){
	  		sel=$(".footerImages");

	  	}
	  	else {
	  		sel=null;
	  	}
	  	console.log("sel is"+sel);*/
	  	var hu=$(this);
	  	var sel=$(".headerImgs");
	  var fid=$(this).children(".imageTyt").val();
	  //console.log("File id is"+fid);
	  if (fid ) {


	  	
	    var data=[];
	    data['url']="/del/upload/pic/"+fid;
	    data['success']=function(data){

		    customResp(data,sel);
		    //show header upload btn
		    $(".showUploadHeaderBtn").show();
		       hu.remove();


	    }
	    ajaxGet(data);
	  	

	  }

}   );

//delete footer image for update blog form
$("body").on("click",".delFooter",function(e){
	e.preventDefault();
	e.stopImmediatePropagation();
	var huyu=$(this);
	var sel=null;
	var fid=$(this).find(".imageTyt").val();
	  //console.log("File id is"+fid);
	  if (fid ) {


	  	
	    var data=[];
	    data['url']="/del/upload/pic/"+fid;
	    data['success']=function(data){
        
	    customResp(data,sel);
	    //show header upload btn
	    $(".showUploadHeaderBtn").show();
	    //remove deleted pic
	    huyu.remove();



	    }
	    ajaxGet(data,sel);
	  	

	  }



});

//trigger click for upload header input button on blog update form

$("body").on("click",".upHBtn",function(e){
	e.preventDefault();
	e.stopImmediatePropagation();
	var dada=[];
	dada['sel']=$("#updateHeader");
	fileClick(dada);



});

//trigger click for footer file btn on blog update form
$("body").on("click",".footerImgBtn",function(e){
	e.preventDefault();
	e.stopImmediatePropagation();
	var dada=[];
	dada['sel']=$("#footerImage");
	fileClick(dada);


});

//get on change event for  header on update post form
$("body").on("change","#updateHeader",function(e){
	e.preventDefault();
	e.stopImmediatePropagation();
	var sese=$(".headerImgs");
	addInput("#updateHeader",sese);

}   );

//get on change  event for footer file on blog update form
$("body").on("change","#footerImage",function(e){
	e.preventDefault();
	e.stopImmediatePropagation();
	var serty=$(".showFooterdivs");
	addInput("#footerImage",serty);
});

