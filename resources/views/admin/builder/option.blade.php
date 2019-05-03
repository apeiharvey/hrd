
@if(isset($form_class))
<div class="{{$form_class}}">
@endif
    <div class="form-group">
        <div class="col-md-6">
            <b>{{$label}}</b>
            <select class="form-control show-tick">
			   <!--  @foreach($db -> $key)
			    <option value="{{$key->idCategory}}">{{$key->idCategory}}</option>
			    @endforeach -->
			</select>
        </div>
    </div>    
@if(isset($form_class))
</div>
@endif
