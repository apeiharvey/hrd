<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{url($view_path)}}">ADMIN - KAWAN LAMA</a>
        </div>
    </div>
</nav>
<section>
    <aside id="leftsidebar" class="sidebar">
        @include($view_path.'.includes.user-info')
        @include($view_path.'.includes.menu')
        <div class="legal">
            <div class="copyright">
                &copy; {{date('Y')}} <a href="javascript:void(0);">{{auth()->user()->name}} - Karir Kawan Lama</a>.
            </div>
        </div>
    </aside>
</section>