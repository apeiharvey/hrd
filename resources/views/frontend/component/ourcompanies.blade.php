@foreach($ourcompanies as $key)
<div class="company-logo col-xs-12 col-sm-6 col-md-4 col-lg-3">
	<div class="thumbnail tooltip-toggle">
		<img src="{{asset('images/'.$view_path.'/company-post/'.$key->thumbnail)}}">
		<div class="tooltiptext">
			@if(request()->cookie('language') == 'id')
			{!!$key->description!!}
			@else
			{!!$key->description_eng!!}
			@endif
		</div>
	</div>
</div>
@endforeach
