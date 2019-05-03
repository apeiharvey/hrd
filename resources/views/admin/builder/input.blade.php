@if(isset($type))
<input type="{{$type}}" name="{{isset($name) ? $name : ''}}" value="{{isset($value) ? $value : ''}}">
@endif