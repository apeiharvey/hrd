@extends($view_path.'.layout.master')
@section('content')
	<!-- Banner -->
	<div class="text-center background-head" style="background-image:url('{{asset('images/'.$view_path.'/contents/'.$home_header)}}')">
			<div class="banner-head text-center">
				<!-- <div class="detail-title font-white  m-t-24">
					<span class="padding-8 f-head background-halfblack">{{$home_search_word_title}}</span>
				</div> -->
				<!-- <div class="detail-head font-white m-t-24">
					<span class="f-head-desc background-halfblack padding-8" >{{$home_search_word_description}}</span>
				</div> -->
					<div class="custom-search-input m-t-24">
						<form action="{{url('search')}}" method="get">
							<input class="input-search" type="text" name="keyword" placeholder="Search Your Jobs Here">
							<button class="btn-search">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
						</form>
					</div>

			</div>
	</div>
	<!-- Company Value -->
	<div class="container-fluid text-center">
		<div class="row">
			<div class="col-sm-12 m-t-32">
				<iframe src="{{$video_url}}"></iframe>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-12 m-t-16">
					<h1 class="main-title">Corporate Values</h1>
				</div>
			</div>
			<div class="row m-t-32">
				<div class="col-12 text-center">
					@foreach($companyvalue as $key)

					<div class="cor-value col-lg-24 col-md-4 col-sm-6 col-xs-12">
						<div class="cor-value-img">
							<img src="{{asset('images/'.$view_path.'/company-value/'.$key->thumbnail)}}">
							<div class="overlay">
								<div class="text-overlay">
									{!!$key->content!!}
								</div>
							</div>
						</div>
						<h3 class="cor-value-title">{{$key->name}}</h3>
						<em class="font-16 font-grey">{{$key->description}}</em>
					</div>

					@endforeach
				</div>

			</div>
		</div>
	</div>
	<!-- Quote-->
	<div class="text-center padding-16 background-red font-white m-t-32">
		<div class="container">
			<h1 class="wisdom-title">What is Success For Us ? </h1>

			<div class="padding-8">
				<em class="wisdom-words font-24">{!!$what_success!!}</em>
			</div>
			<br>
			<div class="m-b-8">
				<em class="font-16">- {{$what_success_author}} -</em>
				<br>
				<em class="font-16">{{$what_success_author_department}}</em>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="container m-t-32">
			<div class="row">
				<div class="col-xs-12 text-center">
					<h1 class="main-title">Want To Be a Part of Elite ?</h1>
				</div>
			</div>
			<div class="row m-t-32">
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
			<div class="m-t-8 padding-24">
				<a class="category-job-link" href=""><h2 class="category-title main-title font-red"></h2></a>
				<div class="row detail-vacancy">

				</div>
				<div class="row">
					<div class="col-xs-12 wrapper-find-more">
						<a href="{{url('career')}}" class="btn-find-more">FIND MORE JOBS</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection