<!DOCTYPE html>
<html>
<head>
	@include($view_path.'.includes.head')
	@include($view_path.'.includes.loader')
</head>
<body class="theme-pink">
	@include($view_path.'.includes.header')
	@include($view_path.'.includes.navbar')
	<div class="overlay"></div>
	@yield('content')
	@include($view_path.'.includes.footer')
</body>
</html>
