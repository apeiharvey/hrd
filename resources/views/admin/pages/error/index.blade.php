<!DOCTYPE html>
<html>
<head>
    <title>404 | ERROR</title>
    @include($view_path.'.includes.header')
</head>
<body class="four-zero-four">
    @include($view_path.'.includes.loader')
    @include($view_path.'.includes.navbar')
    <div class="four-zero-four-container">
        <div class="error-code">404</div>
        <div class="error-message">This page doesn't exist</div>
        <div class="button-place">
            <a href="{{url($view_path.'/preferences/settings')}}" class="btn btn-default btn-lg waves-effect">GO TO HOMEPAGE</a>
        </div>
    </div>
    @include($view_path.'.includes.footer')
</body>
</html>
