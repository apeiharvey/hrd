<div class="form-group">
	<div class="row">
		@if(isset($types) && $types == 'image')
			<div class="col-md-6">
				<label>{{isset($label) ? $label : ''}}</label>
				<div>
					@if(!isset($disabled) || $disabled == false)
						<label class="btn bg-blue-grey waves-effect input-file-label-{{$name}}">
							<input type="file"  class="form-control upload-image {{isset($class) ? $class : ''}} {{isset($multiple) ? $multiple : 'single'}}" name="{{isset($name) ? $name : ''}}" data-size="{{isset($file_opt['size']) ? $file_opt['size'] : 99999999}}"> Choose file
						</label>
						<button type="button" class="btn bg-red waves-effect remove-single-image" data-id="{{isset($multiple) ? $multiple : 'single'}}" data-name="{{$name}}">Remove</button>
					@endif
					<input type="hidden" name="remove-{{isset($multiple) ? $multiple : 'single'}}-{{$name}}" value="n">
				</div>
			</div>
			<div class="col-md-6 {{isset($multiple) ? $multiple : 'single'}}-{{$name}}">
				@if(isset($value) && $value != '')
					<img src="{{asset($value) ? $value : ''}}" class="img-responsive thumbnail image-thumbnail">
				@else
					<img src="{{asset('images/frontend/index.png')}}" class="img-responsive thumbnail image-thumbnail">
				@endif
			</div>
		@endif
	</div>
	<div class="clearfix"></div>
</div>