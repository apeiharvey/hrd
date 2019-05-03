@if(isset($label))
<div class="form-group">
	<div class="{{isset($class) ? $class : 'col-md-12'}}">
		<label>{{$label}}</label>
	</div>
</div>
@endif