$(document).ready(function(){
  //ajax setup
$.ajaxSetup({
    
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
    beforeSend: function(){
      //add  spinner
      $("#loadModal").modal("show");
      
      
      
      
    },
    //dataType:"json",
    error:function(data){
      //var sd=JSON.stringify(data);
      //alert("ajax error:"+sd)
      //alert("Oops An error occured");
      $(".load_msg").empty().html("Oops An error occured");
      $("#mlo").modal("show");
      //$("body").empty().html();
      
      
    },
    complete: function(){
      
      $('#loadModal').modal("hide");
      
      
    }
     });

/*
| Generic functions
|
|
|
|
*/


//capture all links load by get
$(document).on("click",".lodg",function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  //get class
  var asd=$(this).attr("cl");
  var sel=$(""+asd);
  var urr=$(this).attr("href");
  var dat=[];
  dat['url']=urr;
  dat['success']=function(data){
    customResp(data,sel);

  }
  ajaxGET(dat);

} );


/*
| File js functions
|
|
|
|
*/

//Get file from input and display in document
//input file upload event
//return daata uri of image

function showFile(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }



//Get input val,save and send to database
  //Get input 
  function addInput(data){
        //var files=event.target.files;
         var dat =[];
        if (data["selector"]) {
          var filess=$(data["selector"])[0].files[0];
          var name=$(data["selector"]).attr("name");
           var fer=new FormData();
          //var csrf=$().val();
          fer.append("file",filess);
          var huy=$(data["selector"]);
          dat["data"]=fer;

        }
        if (data["load"]) {
            var sss=data["load"];
        }
    

          
         
          if (data["url"]) {
              //dat["url"]="/header/post";
              dat["url"]=data["url"];
          }
          
          
          dat["success"]=function(data){
              customResp(data,sss);

              huy.val("");
              //$(".proImage").empty();

          }
          ajaxPost(dat);
   }






     // alert('true');
 function returnEmmpty( msg){
       // var msg="Oops.....Can't post without an image.";
        $(".load_msg").empty().html(msg);

        $("#mlo").modal("show");

 }








//normal  response
    function normalResp(data,selector){
        if(data){
            $(selector).empty().html(data);
        }

    }
        /*
         |
         |
         | Check for custom json responses field
         |html,msg,error
         |input json data ,string selector
         |output undefined
         |
        */
        function customResp(data,sele=null){
            //check for html
            //console.log(sele);
            if(data.html){
              //alert('hapa');
                sele.empty().html(data.html);
                // alert(sele+"was emp" );

            }
            //check for error
            if(data.error){
                //sele.empty().html(data.error);
                $(".load_msg").empty().html(data.error);
                $("#mlo").modal("show");


            }
            //check for 404 error
            if(data.err4){
              $("body").empty().html(data.err4);

            }

            //check for msg
            //check for error
            if(data.msg){
                //$("#mlo").show();
                $(".load_msg").empty().html(data.msg);
                $("#mlo").modal("show");
                //$(sele).empty().html(data.msg);
                //alert(data.msg);


            }
             //check for photo id
            if(data.id){
                $.ajax({
                  type:"GET",
                  url:"/view/image/"+data.id,
                  dataType:"html",
                  beforeSend:function(){
                    //sele.html("loader");
                    $("#loadModal").modal("show");


                  },
                  complete: function(){
                   $('#loadModal').modal("hide");
                    
                    
                  },
                  success:function(data){
                    sele.append(data);

                  }
                });

            }
            //check for returned image
            if(data.image){
                //check for selector
               
                if(sele){
                   sele.append(data.image);
                }
                else{
                  alert('Oops an error occured.');
                }
              

            }

            //do nothing
            if (data.nada) {
              //do nothing

            }
         

        }
        /*   
         |
         |
         |GEt url from href attr of input class
         |load class data before emptying
         | input array data ["link"] ['load']
         |output udefined
         |
         |
        */
        function   loadByGet(da){
            //check for link
            if( da['sel']){
                var link=da['sel'].attr("href");
                

            }
            if(da['load']){
               var succ=function(data){
                    //data['load'].empty().html(data);
                    //customResp(data, da['load']);
                    //customResp(data,da['load']);
                    da['load'].empty().html(data);


               }

            }
            $.ajax({
                 type:"GET",
                 url:link,
                 dataType:"html",
                 success:succ


            });
            //alert("set suc");



        }











/*
      |Custom functions
      |
      |
      |
      |
      *//*
     |Display upload file dialog
     |input string dat['sel']
     |trigger click on dat['tag']
     |output undefined
     | 
     |
    */
    function fileClick(dat){

       dat['sel'].trigger('click');

    }



    /*
     |GEt uploaded file name and load into html tag
     |id of image
     | input string dat['sel'] ,string dat['tag']
     | output undefined
     | 
     |
    */
     function  uploadName( da){
           var filename = da['sel'].val();
            var lastIndex = filename.lastIndexOf("\\");
            if (lastIndex >= 0) {
                filename = filename.substring(lastIndex + 1);
            }
            var name="<p>"+filename+"</p>";
           da['tag'].empty().prepend(name);


     }



        /*
         | Custom functions
         |input  Array datA=["url"=>"string","success"=>function(){} ,"data"=>new FormD or {}];
         |output=bool undefined
         |
        */
        function ajaxPost(datA){
            $.ajax({

                type:"POST",
                url:datA["url"],
                data:datA["data"],
                //dataType:"json",
                processData:false,
                contentType:false,
                success:datA["success"]

            });
            //return true;
        }

        /*
         | Custom functions
         |input  Array datArray=["url","success"];
         |output=bool undefined
         |
        */
        //Preform ajax get reqest
        function ajaxGET(datArray){
                $.ajax({
                     type:"GET",
                     url:datArray["url"],
                     dataType:"json",
                     success:datArray["success"]


                });
                //return true;




        }
        
}  );