@extends($view_path.'.layout.master')
@section('content')
<div class="min-body container m-b-24">
	<div class="padding-24">
		<div class="row">
			<h1 class="main-title">{{trans('general.search')}} : {{Request::get('keyword')}}</h1>
		</div>
		@if(count($vacancypost) == 0)
			<div class="row m-t-24 m-b-24">
				<em>"{{Request::get('keyword')}}" is not found</em>
			</div>
		@else
			<div class="row m-t-24 m-b-24">
				<em>{{$vacancypost->count()}} available jobs are found</em>
			</div>
			<div class="row detail-vacancy">
			@foreach($vacancypost as $key)
			<div class="cat-job-content col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="padding-16">
					<div class="cat-job-title">
						<a class="category-job" href="{{url('career/'.$key->category_alias.'/'.$key->post_alias)}}">
							<h4 class="job-desk-title">{{$key->title}}</h4>
						</a>
					</div>
					<p>{{$key->description}}</p>
					<a class="font-red link-jobdetail" href="{{url('career/'.$key->category_alias.'/'.$key->post_alias)}}">Read More</a>
				</div>
			</div> 

			@endforeach
			</div>
		@endif
		
	</div>
</div>
@endsection