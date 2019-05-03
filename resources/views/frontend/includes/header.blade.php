<header>
	<nav class="nav background-red font-white">
		<div class="container-fluid">
			<div class="navbar-header">
					<div>
						<a class="home" href="{{url('/')}}">
							<img class="nav-img" src="{{asset('images/'.$view_path.'/web/'.$logo_header)}}">
						</a>
					</div>
					<!-- <ol class="lang">
						<li><a class="{{request()->cookie('language') == 'id' ? 'active' : '' }}" href="{{url('change-language/id')}}">ID</a></li>
						<li><a data-lang="{{request()->cookie('language')}}" class="{{request()->cookie('language') == 'en' ? 'active' : '' }}" href="{{url('change-language/en')}}">EN</a></li>
					</ol> -->
					<div class="dropdown">
						@if(request()->cookie('language') == 'id')
						<button class="dropbtn">
							<img src="{{asset('images/'.$view_path.'/indonesia-flag.png')}}">
							<span> ID </span>
							<i class="fa fa-caret-down" aria-hidden="true"></i>
						</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="{{url('change-language/en')}}">
								<img src="{{asset('images/'.$view_path.'/english-flag.png')}}">
								<span> EN</span>
							</a>
						</div>
						@else
						<button class="dropbtn">
							<img src="{{asset('images/'.$view_path.'/english-flag.png')}}">
							<span> EN </span>
							<i class="fa fa-caret-down" aria-hidden="true"></i>
						</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="{{url('change-language/id')}}">
								<img src="{{asset('images/'.$view_path.'/indonesia-flag.png')}}">
								<span> ID</span>
							</a>
						</div>
						@endif
					</div>
				<div class="burger-menu">
				  <div class="bar1"></div>
				  <div class="bar2"></div>
				  <div class="bar3"></div>
				</div>
			</div>
			<div class="nav-width">
				<ul class="nav navbar-nav">
					<li><a class="{{Request::path() == 'about-us' ? 'active' : ''}}" href="{{url('about-us')}}">{{trans('general.about-us')}}</a></li>
					<li><a class="{{Request::path() == '/' ? 'active' : (strpos(Request::path(),'career') !== false ? 'active' : '')}}" href="{{url('/')}}">{{trans('general.career')}}</a></li>
					<li><a class="{{strpos(Request::path(),'blog') !== false ? 'active' : ''}}" href="{{url('blog')}}">{{trans('general.news')}}</a></li>
					<li><a class="{{Request::path() == 'employee-activity' ? 'active' : ''}}" href="{{url('employee-activity')}}">{{trans('general.employee-activity')}}</a></li>
					<li><a class="{{Request::path() == 'contact-us' ? 'active' : ''}}" href="{{url('contact-us')}}">{{trans('general.contact-us')}}</a></li>
				</ul>
			</div>
		</div>
	</nav> 
</header>
@if(Request::path() == 'contact-us' )
	<div class="text-center background-head" style="background-image:url('{{asset('images/'.$view_path.'/contents/'.$contents->value)}}')">
	</div>
@endif
@if(Request::path() == 'employee-activity')
	<div class="testimonial-background">
		<div id="testimonial" class="owl-carousel owl-theme">
		    @foreach($testimonial as $key)
		    	<div class="item">
			    		<div class="text-center ">
					    	<div class="testimonial-text">
						    	{!!$key->testimony!!}
							</div>
					    	<h5 class="testimonial-name">{{$key->name}}</h5>
					    	<h5 class="testimonial-position">{{$key->position}}</h5>
				    	</div>
		    	</div>
		    @endforeach
		</div>
	</div>

@endif
@if(Request::path() != '/')
	<ul class="padding-8 breadcrumbs">
	@foreach($breadcrumbs as $key => $value)
		<li><a href="{{$value}}">{{$key}}</a></li>
	@endforeach
	</ul> 
@endif
