
@if(strpos(URL::current(),'career'))

	@foreach($vacancypost as $key)

	<div class="cat-job-content col-xs-12 col-sm-6 col-md-4 col-lg-3">
		<div class="padding-16">
			<div class="cat-job-title">
				<a class="category-job" href="{{url('career/'.$key->category_alias.'/'.$key->post_alias)}}">
					<h3 class="job-desk-title">{{$key->title}}</h3>
				</a>
			</div>
			<p>{!!$key->responsibilities!!}</p>
			<a class="font-red link-jobdetail" href="{{url('career/'.$key->category_alias.'/'.$key->post_alias)}}">Read More</a>
		</div>
	</div> 

	@endforeach

@else
	@if($vacancypost->count() > 8)
		@for($i = 0; $i < 8; $i++)

		<div class="cat-job-content col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<div class="padding-16">
				<div class="cat-job-title">
					<a class="category-job" href="{{url('career/'.$vacancypost[$i]->category_alias.'/'.$vacancypost[$i]->post_alias)}}">
						<h3 class="job-desk-title">{{$vacancypost[$i]->title}}</h3>
					</a>
				</div>
				<p>{!!$vacancypost[$i]->responsibilities!!}</p>
				<a class="font-red link-jobdetail" href="{{url('career/'.$vacancypost[$i]->category_alias.'/'.$vacancypost[$i]->post_alias)}}">Read More</a>
			</div>
		</div> 

		@endfor

		<div class="row">
			<div class="col-xs-12 view-all-container">
				<a class="more-link-vacancy" href="{{url('career/'.$vacancypost[1]->category_alias)}}">
				<button class="btn-view-all">VIEW ALL {{strtoupper($vacancypost[0]->name)}}</button></a>
			</div>
		</div>
	@else
		@foreach($vacancypost as $key)
		<div class="cat-job-content col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<div class="padding-16">
				<div class="cat-job-title">
					<a class="category-job" href="{{url('career/'.$key->category_alias.'/'.$key->post_alias)}}">
						<h3 class="job-desk-title">{{$key->title}}</h3>
					</a>
						<div class="vacancy-description">{!!$key->responsibilities!!}</div>
				</div>
				
				<a class="font-red link-jobdetail" href="{{url('career/'.$key->category_alias.'/'.$key->post_alias)}}">Read More</a>
			</div>
		</div> 

		@endforeach
	@endif

@endif