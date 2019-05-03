@extends($view_path.'.layout.master')
@section('content')
<div class="min-body container m-b-24">
	<div class="padding-24">
		<div class="row">
			<div class="col-xs-12">
				<h3 class="category-title main-title font-red">{{$vacancycategory->name}}</h3>
			</div>		
		</div>
		<div class="row">
		@if($vacancypost->count() == 0)
			<div class="col-xs-12 m-t-24 m-b-24">
				<em>"{{$vacancycategory->name}}" doesn't have available jobs</em>
			</div>
		@else
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

		@endif
		
		</div>
		<div class="row">
			<div class="col-xs-12 text-center">
				{{$vacancypost->links()}}
			</div>
		</div>
		
	</div>
</div>


@endsection