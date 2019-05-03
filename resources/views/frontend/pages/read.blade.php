@extends($view_path.'.layout.master')
@section('content')
	<div class="container-fluid padding-16 m-b-24">
		

			<div class="col-sm-12 col-md-7 col-md-offset-1">
				<h1 class="main-title">{{$read->title}}</h1>
			</div>

		<div class="col-xs-12 col-sm-12 col-md-7 col-md-offset-1 read-container">
		<div class="row m-b-24">
			<div class="col-xs-12 m-t-24">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<i class="fa fa-clock-o" aria-hidden="true"></i><span class="font-grey"> {{$read->datetime}}</span> /
						<i class="fa fa-eye" aria-hidden="true"></i><span class="font-grey"> {{$read->view}} Views</span>
					</div>
					<div class="col-xs-12 col-md-6 social-media-news">
						@foreach($socialmediaread as $key)
						<a class="social-media-logo" href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}"><img src="{{asset('images/'.$view_path.'/social-media/'.$key->thumbnail)}}"></a>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		
			<div class="read-content m-t-16">
				{!!$read->content!!}
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3">
			<div class="row">
				<div class="news-latest-title col-xs-12 m-t-24">
					<h1>Latest News</h1>
				</div>
			</div>
			<div class="row">
			@foreach($latest as $key)
				<div class="centering-latest-news col-xs-12 col-sm-12 col-md-12 m-t-24">
					<div class="latest-news-card">
						
							<a href="{{url('blog/'.$key->name_alias.'/'.$key->title_alias)}}">
								<img src="{{asset('images/'.$view_path.'/blog-post/'.$key->thumbnail)}}">
							</a>
							<div class="latest-news-content">
								<div class="latest-news-content-title">
									<a href="{{url('blog/'.$key->name_alias.'/'.$key->title_alias)}}">
										<h4>{{$key->title}}</h4>
									</a>
								</div>
								<div class="news-view"><i class="fa fa-eye" aria-hidden="true"></i><span class="font-grey"> {{$read->view}} Views</span></div>
								<div class="news-time"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$key->datetime}}</div>
							</div>
						
					</div>
				</div>
			@endforeach
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
			<div class="related-news-title col-xs-12 m-t-24">
				<h1 class="main-title">Related News</h1>
			</div>
			<div class="related-news-container col-xs-12">
				@if($related->count() == 0)
						<div class="col-xs-12 m-t-24">
							<em>No articles available in this category at this time.</em>
						</div>
					@else
						@foreach($related as $key)
							<div class="col-xs-12 col-sm-12 col-md-4 m-t-24">
								<div class="related-news-card">
									<div class="related-news-content">
										<a href="{{url('blog/'.$key->name_alias.'/'.$key->title_alias)}}">
											<img src="{{asset('images/'.$view_path.'/blog-post/'.$key->thumbnail)}}">
										</a>
										<div class="news-content">
											<div class="news-title">
												<a href="{{url('blog/'.$key->name_alias.'/'.$key->title_alias)}}">
													<h4>{{$key->title}}</h4>
												</a>
											</div>
											<div class="news-view"><i class="fa fa-eye" aria-hidden="true"></i><span class="font-grey"> {{$key->view}} Views</span></div>
											<div class="news-time"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="font-grey"> {{$key->datetime}}</span></div>
										</div>	
									</div>
								</div>
							</div>
						@endforeach
					@endif
			</div>
		</div>
	</div>
@endsection