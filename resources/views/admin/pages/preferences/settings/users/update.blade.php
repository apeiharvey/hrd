@extends($view_path.'.layout.master')
@section('content')

<form class="update" action="{{url($view_path.'/users/'.$users->id)}}" method="post" enctype="multipart/form-data">
    {!!csrf_field()!!}
    <section class="content">
        @if(Session::has("message"))
            <div class="body">
                <div class="alert alert-success">
                    {{Session("message")}}
                </div>
            </div>
        @endif
        @if(Session::has("message_password"))
            <div class="body">
                <div class="alert alert-danger">
                    {{Session("message_password")}}
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class=".col-xs-12 .col-sm-6 .col-md-8">
                    <div class="card">
                        <div class="header">
                            <a href="{{url($view_path.'/users/')}}">
                                <div class="pull-right" style="margin-bottom: 10px;">
                                    <button type="Button" class="btn btn-danger btn-lg waves-effect">Back</button>
                                </div>
                            </a>
                            <h2>
                                Update User
                                <small>You Can Update User Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="tab-content">
                                    {!!view($view_path.'.builder.input',['type' => 'hidden', 'name' => 'id', 'value' => $users->id])!!}
                                    {!!view($view_path.'.builder.text',['label' => 'Nama User','name' => 'name','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value' => $users->name])!!}
                                    {!!view($view_path.'.builder.text',['label' => 'Email User','name' => 'email','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value' => $users->email,'disabled' => 'disabled'])!!}
                                    {!!view($view_path.'.builder.text',['label' => 'New Password','name' => 'password','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value'=>'', 'type' => 'password'])!!}
                                    {!!view($view_path.'.builder.text',['label' => 'Password Confirmation','name' => 'password_confirmation','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value'=>'', 'type' => 'password'])!!}
                                    <div class="col-md-3">
                                        <p>
                                            <b>Privilege</b>
                                        </p>
                                        <select name="user_access" class="form-control show-tick">
                                            <option value="0">Choose...</option>
                                            @foreach($useraccess as $key)
                                                <option value="{{$key->id}}" @if($users->user_access == $key->id) {{"selected=selected"}}@endif>{{$key->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{ method_field('put') }}
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="Submit" class="btn btn-success btn-lg waves-effect">Submit</button>
                                    {{ method_field('put') }}
                                    {!!csrf_field()!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection
