@extends($view_path.'.layout.master-login')
@section('content')
    @if(Session::has("message"))
        <div class="body">
            <div class="alert alert-danger">
                <strong>Oh snap!</strong> - {{Session("message")}}
            </div>
        </div>
    @endif
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Sign In<b> - Recruitment</b></a>
            <small>Recruitment - Kawan Lama</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="{{url($view_path.'/home')}}">
                    {!!csrf_field()!!}
                    <div class="msg">Sign In</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-offset-4 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
