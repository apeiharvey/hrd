@extends($view_path.'.layout.master')
@section('content')
<form action="{{url($view_path.'/manage-account/'.$users->id)}}" method="post" enctype="multipart/form-data">
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
                            <h2>
                                Manage Your Account
                                <small>You Can Change Your Personal Data Here.</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="container-fluid">
                                <div class="tab-content">
                                    {!!view($view_path.'.builder.input',['type' => 'hidden', 'name' => 'id', 'value' => $users->id])!!}
                                    {!!view($view_path.'.builder.label',['label' => 'Name'])!!}
                                    {!!view($view_path.'.builder.text',['name' => 'name','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value' => $users->name])!!}
                                    {!!view($view_path.'.builder.label',['label' => 'Email'])!!}
                                    {!!view($view_path.'.builder.text',['name' => 'email','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value' => $users->email,'disabled' => 'disabled'])!!}
                                    {!!view($view_path.'.builder.label',['label' => 'Password'])!!}
                                    {!!view($view_path.'.builder.text',['name' => 'password','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value'=>'', 'type' => 'password'])!!}
                                    {!!view($view_path.'.builder.label',['label' => 'Password Confirmation'])!!}
                                    {!!view($view_path.'.builder.text',['name' => 'password_confirmation','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value'=>'', 'type' => 'password'])!!}
                                    {{ method_field('put') }}
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="Submit" class="btn btn-success btn-lg waves-effect">Submit</button>
                                    </div>
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
