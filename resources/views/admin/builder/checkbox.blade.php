@if(isset($form_class))
<div class="{{$form_class}}">
@endif
    <div class="form-group">
        <div class="col-md-6">
            <b>{{$label}}</b>
            <div class="demo-switch">
                <div class="demo-radio-button">
                <input name="{{$name}}" value="<?php if($value==0){echo"0";} else{echo"0";}?>" type="radio" id="off" <?php if($value==0) echo "checked"; ?>/>
                    <label for="off">Off</label>
                    <input name="{{$name}}" value="<?php if($value==1){echo"1";} else{echo"1";}?>" type="radio" id="on" <?php if($value==1) echo "checked"; ?> />
                    <label for="on">On</label>
                </div>
            </div>
        </div>
    </div>    
@if(isset($form_class))
</div>
@endif