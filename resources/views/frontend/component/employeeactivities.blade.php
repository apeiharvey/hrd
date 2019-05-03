@foreach($galleries as $key)
<div class="card">
	<img src="{{asset('images/'.$view_path.'/gallery/'.$key->thumbnail)}}">
	<div class="curtain">
		<div align="center" class="center-text-absolute"><h3>{{$key->title}}</h3></div>
	</div>
</div>
@endforeach