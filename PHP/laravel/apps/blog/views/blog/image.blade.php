
@if( isset($path) &&   isset($id)   )
<script type="text/javascript">
	

	/*$("#showHeader").find("img.imageShow").imgAreaSelect({
      //instance:true
            handles: true,
            aspectRatio:"16:9",
            
            //enable:true,
            //onSelectEnd: someFunction
        });*/
</script>


	<div class="imageDiv blogimage-wrapper">
		<span class="delUploadPhoto cancel-button"><i class="fas fa-times-circle"></i></span>
		<input type="hidden" value="{{$id}}" class="imageTyt" name="blogImge"/>

					<img  class="blogimage-main" src='{{$path}}' class="imageShow" />
	</div>
		@endif


