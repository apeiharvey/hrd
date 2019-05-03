<!DOCTYPE html>
<html>
<head>
	<title>{{$title}}</title>
	@include($view_path.'.includes.head')
	<div class="loader-container">
		<div class="loader"></div>
	</div>
	@include($view_path.'.includes.header')
</head>
<body>
	@yield('content')
	@include($view_path.'.includes.footer')
</body>
</html>