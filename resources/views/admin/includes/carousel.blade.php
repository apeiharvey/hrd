<div class="owl-carousel owl-theme">
	@foreach($statuscarousel as $key)
	<div class="info-box-4">
		<div class="content">
	        <a href="{{url(url()->current().'?filter='.strtolower(str_replace('_','-',$key->status)))}}">
	        	<div class="text">
	        		{{str_replace('_',' ',$key->status)}}
	        	</div>
	            <div class="number">
	               {{$key->total_applicant->count()}}
	            </div>
		    </a>
	    </div>
	</div>
	@endforeach
</div>
