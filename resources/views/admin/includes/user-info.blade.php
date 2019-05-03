<div class="user-info" style="background:url('{{asset('images/admin/user-img-background.jpg')}}') no-repeat no-repeat;">
    <div class="image">
        <img src="{{asset('images/admin/index.png')}}" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}</div>
        <div class="email">{{auth()->user()->email}}</div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li><a href="{{url($view_path.'/sign-out')}}"><i class="material-icons">input</i>Sign Out</a></li>
            </ul>
        </div>
    </div>
</div>