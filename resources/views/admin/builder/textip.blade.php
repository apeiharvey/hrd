@if(isset($form_class))
<div class="{{$form_class}}">
@endif
    <div class="form-group">
    <div class="demo-masked-input">
        <div class="col-md-6">
            <b>{{$label}}</b>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="material-icons">computer</i>
                    <div class="form-line">
                        <input type="text" name="{{$name}}" class="form-control ip_address" value='{{isset($value) ? $value : ''}}' placeholder="Ex: 255.255.255.255">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@if(isset($form_class))
</div>
@endif