@extends($view_path.'.layout.master')
@section('content')
	<div class="container-fluid m-b-24">
			<div class="employee-container">
				@foreach($gallery as $key)
					<div class="card">
						<img src="{{asset('images/'.$view_path.'/gallery/'.$key->thumbnail)}}">
						<div class="curtain">
							<div align="center" class="center-text-absolute"><h3>{{$key->title}}</h3></div>
						</div>
					</div>
					@endforeach
				<div class="new-activities"></div>
			</div>
		@if($gallery->hasMorePages())
		<div class="col-xs-12 m-t-16 text-center">
			<div class="button-center">
				<button class="btn-more button button--nina button--round-l button--text-thick button--inverted" data-text="MORE">
					<span>M</span><span>O</span><span>R</span><span>E</span>
				</button>
			</div>
		</div>
		@endif
	</div>
@endsection