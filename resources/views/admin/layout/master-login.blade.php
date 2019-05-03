<!DOCTYPE html>
<html>
<head>
	@include($view_path.'.includes.head')
	<title>Login - Page</title>
	@include($view_path.'.includes.header')
</head>
<body class="login-page">
	@yield('content')
	@include($view_path.'.includes.footer')
</body>
</html>
