@if(isset($form_class))
<div class="$form_class">
@endif
	<div class="form-group">
		<div class="col-md-12">
			<div class="{{isset($class) ? '' : 'form-line'}}">
			<textarea id="{{isset($id) ? $id : ''}}" {{isset($disabled) ? $disabled : ''}} rows="{{isset($rows) ? $rows : '1'}}" name="{{$name}}" class="form-control no-resize auto-growth {{isset($class) ? $class : ''}}" placeholder="{{isset($placeholder) ? $placeholder : ''}}" maxlength="{{isset($maxlength) ? $maxlength :''}}">{{$value}}</textarea>
			</div>
		</div>
		
	</div>
@if(isset($form_class))
</div>
@endif