@extends($view_path.'.layout.master')
@section('content')
	<div class="container m-b-24">
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<h1 class="main-title">{{trans('general.contact-us')}}</h1>
				<div class="font-16 m-t-24 ">
					<p>{{$place_name}}</p>
					<p>{{$address}}</p>
					<p><strong>We are online :</strong></p>
					<div>
						@foreach($socialmedia as $key)
						<a class="social-media-logo" target="_blank" href="{{$key->url}}"><img src="{{asset('images/'.$view_path.'/social-media/'.$key->thumbnail)}}"></a>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 m-t-24">
				<div id="map"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<h1 class="main-title">{{trans('general.visit-us-in')}}</h1>
			</div>
		</div>
		<div class="row m-t-24 font-16">
			<div class="col-xs-12 col-sm-6">
				<ul class="list-link">
					@for($i = 0; $i < $urlcompany->count() / 2; $i++)
					@if(strpos($urlcompany[$i]->url,'http') !== false)
					<li>
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
						<a class="has" target="_blank" href="{{$urlcompany[$i]->url}}">{{$urlcompany[$i]->title}}</a>
					</li>
					@else
					<li>
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
						<a>{{$urlcompany[$i]->title}}</a>
					</li>
					@endif
					@endfor
				</ul>	
			</div>
			<div class="col-xs-12 col-sm-6">
				<ul class="list-link">
					@for($i = ceil($urlcompany->count() / 2); $i < $urlcompany->count() ; $i++)
					@if(strpos($urlcompany[$i]->url,'http') !== false)
					<li>
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
						<a class="has" target="_blank" href="{{$urlcompany[$i]->url}}">{{$urlcompany[$i]->title}}</a>
					</li>
					@else
					<li>
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
						<a>{{$urlcompany[$i]->title}}</a>
					</li>
					@endif
					@endfor
				</ul>
			</div>
		</div>
	</div>
@endsection
@include($view_path.'.includes.scriptmap')