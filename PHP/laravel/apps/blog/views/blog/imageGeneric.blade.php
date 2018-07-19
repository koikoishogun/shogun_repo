@if( isset($path) &&   isset($id)   )

		<div class="images-wrapper">
			<div class="genericImg">
				<input type="hidden" value="{{$id}}" class="imageTyt" name="imgGene"/>
				<img  src='{{$path}}''  class="imageShow blog-image" />
			</div>
		</div>

@endif