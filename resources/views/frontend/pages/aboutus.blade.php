@extends($view_path.'.layout.master')
@section('content')
	<div class="container text-center m-b-24">
		<div class="row">
			<div class="col-xs-12 m-t-24">
				<h1 class="main-title" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">{{trans('general.about-us')}}</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 m-t-24">
				<div class="about-us-desc padding-8 font-16">{!!$contents->value!!}</div>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 m-t-8 m-b-16">
				<h1 class="main-title">{{trans('general.our-companies')}}</h1>
			</div>
		</div>

		<div class="row m-t-32">
			<div id="category" class="owl-carousel owl-theme">
				
			    @foreach($companycategory as $key)	

		    	<div class="item category-logo-company" data-id="{{$key->id}}">
		    		<img src="{{asset('images/'.$view_path.'/company-category/'.$key->thumbnail)}}">
		    		<h4>{{$key->name}}</h4>
		    	</div>

			    @endforeach
			</div>

		</div>
		<hr>
		<div class="row padding-24">
			<div class="company-posts">
			</div>
		</div>
	</div>
@endsection