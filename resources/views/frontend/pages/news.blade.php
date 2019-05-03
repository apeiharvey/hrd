@extends($view_path.'.layout.master')
@section('content')
	<div class="min-body container m-b-24">
		<div class="row m-t-16 padding-left8">
			<div class="col-xs-12">
				<h1 class="main-title">{{trans('general.news')}}{{$categorytitle}}</h1>
			</div>
		</div>
		<div class="row m-t-16">
			<div class="col-xs-12">
				<div class="news-dropdown">
					<button class="news-dropbtn">
						Choose Category
						<i class="fa fa-caret-down font-red" aria-hidden="true"></i>
					</button>
					<div id="newsDropdown" class="news-dropdown-content">
						<a href="{{url('blog')}}">
							<div class="news-item">All</div>
						</a>
						@foreach($blogpostcategory as $key)
						<a href="{{url('blog/'.$key->name_alias)}}">
							<div class="news-item">{{$key->name}}</div>
						</a>
						@endforeach
						
					</div>
				</div>
			</div>
		</div>
		<div class="blogpost-container">
			<div class="row m-b-16">
				@if($blogpost->count() == 0)
					<div class="col-xs-12 m-t-24">
						<em>No articles available in this category at this time.</em>
					</div>
				@else
					@foreach($blogpost as $key)
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 m-t-24">
							<div class="news-card">
								<div class="thumbnail">
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
			<div class="row">
				<div class="col-xs-12 text-center">
					{{$blogpost->links()}}
				</div>
			</div>
		</div>
	</div>
@endsection