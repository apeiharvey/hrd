@extends($view_path.'.layout.master')
@section('content')
<div class="min-body container m-t-24 m-b-24">
	<div class="row">
		<div class="col-xs-12 text-center">
			<h1 class="main-title">Want To Be Part Of Elites?</h1>
		</div>
	</div>
	<div class="row m-t-24">
		<div id="category" class="owl-carousel owl-theme">
		    @foreach ($vacancycategory as $key)	

	    	<div class="item text-center category-logo-job" data-alias="{{$key->category_alias}}" data-name="{{$key->name}}" data-id="{{$key->id}}">
    			<img src="{{asset('images/'.$view_path.'/vacancy-category/'.$key->thumbnail)}}">
	    		<h4>{{$key->name}}</h4>
	    	</div>

		    @endforeach
		</div>
	</div>
	<hr>
	<div class="padding-24">
		<div class="row">
			<div class="col-xs-12">
				<a class="category-job-link" href=""><h2 class="category-title main-title font-red"></h2></a>
			</div>		
		</div>
		<div class="row detail-vacancy">

		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-8 m-t-8"><h1 class="main-title">Are you interested working with us ?</h1></div>
		<div class="col-xs-12 col-sm-4 wrapper-find-more">
			<a href="{{url('career/apply')}}" class="btn-find-more">Apply Now</a>
		</div>
	</div>
</div>
@endsection