<footer>
	<div class="col-12 m-t-32">
	<div style="background-image:url('{{asset('images/'.$view_path.'/contents/'.$footer->value)}}')" class="footer-background container-fluid text-center padding-16">
		<img class="foot-img" src="{{asset('images/'.$view_path.'/web/'.$logo_footer)}}">
		<p class="m-t-10">{{$address}}</p>
		@foreach($socialmedia as $key)
		<a class="social-media-logo" target="_blank" href="{{$key->url}}"><img src="{{asset('images/'.$view_path.'/social-media/'.$key->thumbnail)}}"></a>
		@endforeach
	</div>
	</div>
	<div class="text-center padding-16">
		Copyright @IT Kawanlama {{date('Y')}}
	</div>
	@include($view_path.'.includes.foot')
	
</footer>