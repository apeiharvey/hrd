@if(isset($form_class))
	<div class="{{$form_class}}">
@endif
    <div class="form-group form-float">
        <div class="form-line">
            <input {{isset($disabled) ? $disabled : ''}} {{isset($id) ? $id : ''}} type="{{isset($type) ? $type : 'text'}}" name="{{$name}}" class="form-control {{isset($class) ? $class : ''}}" placeholder="{{isset($placeholder) ? $placeholder : ''}}" value="{{isset($value) ? $value : ''}}" {{isset($disabled) ? $disabled : ''}}>
            <label class="form-label">{{isset($label) ? $label : ''}}</label>
        </div>
        <small>{{isset($notes) ? $notes : ''}}</small>
    </div>
@if(isset($form_class))
	</div>
@endif