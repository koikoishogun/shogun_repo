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
         var id=$(".postDiv #pId").val();
         var dat=[];
         var sd=$(this).parents(".loadContent");
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
            var id=$(".postDiv").find("#pId").val();
            console.log("id is"+id.length);
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
            var hi=$(".headerImgs").find(".imageTyt").val();
            //console.log(hi);
            //check for header
            if (hi) {
             thisForm.append("headerImage",hi); 
            }

            


            //Add footer images for blog update form
            var fi=$(".showFooterdivs").find(".imageTyt");
            //check for footer
            if (fi.length ) {
                 fi.each( function(index,element){
                 thisForm.append("footerImages[]",$(this).val());
                });

            }
            

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
        var is=$(this).parents(".showCmt").find("#cId").val();
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
          //alert("test");
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
    var data=[];
    data["selector"]="#headerFile";
    data["load"]=$("#showHeader");
    data['url']="/header/post";
    //var sel=$("#showFooterImage");
    //addInput(".footerImage",sel);
    addInput(data);
    //hide header photo btn
    $(".uploadHeader").hide();
});

//get on change event for footer image
$("body").on("change",".footerImage",function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    //handleFileSelect(e,"showHeader");
    var data=[];
    data["selector"]=".footerImage";
    data["load"]=$("#showFooterImage");
    data['url']="/header/post";
    //var sel=$("#showFooterImage");
    //addInput(".footerImage",sel);
    addInput(data);





});

//delete an  header image from blog  form
$("body").on("click","#postForm .delUploadPhoto",function(e){
  
      e.preventDefault();
      e.stopImmediatePropagation();
      var hut=$(this).parents(".imageDiv");
      var is=$(this).parents(".imageDiv").find(".imageTyt").val();
      var dat=[];
      var sel=$(this).parents(".imageDiv");
      dat['url']="/del/upload/pic/"+is;
      dat['success']=function(data){
          hut.remove();
          $(".uploadHeader").show();
          customResp(data,sel);

          //alert("Reply deleted successfully.");

      }
      ajaxGET(dat);



});
//delete header for blog update form
$("body").on("click","#upPost .headerImgs .delUploadPhoto",function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    //alert('shit');
    var hu=$(".headerImgs  .imageDiv");
    var fid=hu.find(".imageTyt").val();
    var sho=$(".showUploadHeaderBtn");
    //console.log("shiet");
    if (fid ) {
      var data=[];
      data['url']="/del/upload/pic/"+fid;
      data['success']=function(data){

        customResp(data);
        //show header upload btn
        sho.show();
        hu.remove();


      }
      ajaxGET(data);
      

    }

}   );

//delete footer image for update blog form
$("body").on("click",".footerImages .showFooterdivs .delUploadPhoto",function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  var huyu=$(this).parents(".imageDiv");
  
  var fid=huyu.find(".imageTyt").val();
    //console.log("File id is "+fid);
    if (fid ) {


      
      var data=[];
      data['url']="/del/upload/pic/"+fid;
      data['success']=function(data){
        
      customResp(data);
     
      huyu.remove();



      }
      ajaxGET(data);
      

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
  var data=[];
  data["selector"]="#updateHeader";
  data["load"]=$(".headerImgs");
  data["url"]="/header/post";
  //var sese=$(".headerImgs");
  //addInput("#updateHeader",sese);
  addInput(data);
  $(".showUploadHeaderBtn").hide();

}   );

//get on change  event for footer file on blog update form
$("body").on("change","#footerImage",function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  var data=[];
  data["selector"]="#footerImage";
  data["load"]=$(".showFooterdivs");
  data["url"]="/header/post";
  //var serty=$(".showFooterdivs");
  addInput(data);
});

/*
* Link starts here
*
*
*
*
*
*
**/

//add link to blog post
$("body").on("submit","#linkForm",function(e){
      e.preventDefault();
      e.stopImmediatePropagation();
      //alert('hit');
      //get data 
      var dat=new FormData(this);
      var sel=$(".linkShown");
      //check if exists
      if (dat) {
        //save to array
        var ds=[];
        ds['data']=dat;
        ds['url']="/add/link";
        ds['success']=function(data){
          customResp(data,sel);

        }
        ajaxPost(ds);
      }
      



});

//delete link for a particular post
$("body").on("click",".linkDel",function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  //get post
  var popo=$("#pId").val();
  if (popo) {
    var dada=new FormData();
    dada.append("id",popo);
    var sel=$(".linkShown");
    console.log(sel);
    //save 
    var tyty=[];
    tyty['data']=dada;
    tyty['url']="/delete/link";
    tyty['success']=function(data){
      customResp(data,sel);

    }
    ajaxPost(tyty);

  }

}   );

//update link for a particular post
$("body").on("click",".linkUpdate",function(e){
  e.stopImmediatePropagation();
  var das=new FormData();
  var lolo=$(".linkInput").val();
  var ida=$("#pId").val();
  //check 
  if (lolo && ida) {
    das.append("link",lolo);
    das.append("id",ida);
    var dayu=[];
    var sel=$(".linkShown");
    dayu['data']=das;
    dayu['url']="/link/update/form";
    dayu['success']=function(data){
      customResp(data,sel);

    }
    ajaxPost(dayu);

  }
  


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


//save admin reply
$("body").on("submit",".adminReply",function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  var dat=[];
  var huyu=$(this);
  var ss=$(this).parents(".replyContainer").find(".loadReply");
  dat['url']="/admin/reply";
  dat['data']=new FormData(this);
  dat['success']=function(data){
    huyu[0].reset();
    customResp(data,ss);


  }

  ajaxPost(dat);




});