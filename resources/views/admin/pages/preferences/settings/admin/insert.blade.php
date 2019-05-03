@extends($view_path.'.layout.master')
@section('content')
<form class="insert" action="{{url($view_path.'/privilege')}}" method="post" enctype="multipart/form-data">
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
        @if(Session::has("message_failed"))
            <div class="body">
                <div class="alert alert-danger">
                    {{Session("message_failed")}}
                </div>
            </div>
        @endif
        @if ($errors->any())
            {!!view($view_path.'.builder.error',[])!!}
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class=".col-xs-12 .col-sm-6 .col-md-8">
                    <div class="card">
                        <div class="header">
                            <a href="{{url($view_path.'/privilege/')}}">
                                <div class="pull-right" style="margin-bottom: 10px;">
                                    <button type="Button" class="btn btn-danger btn-lg waves-effect">Back</button>
                                </div>
                            </a>
                            <h2>
                                Insert User
                                <small>You Can Insert New User Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="tab-content">
                                {!!view($view_path.'.builder.text',['label' => 'Privilege','name' => 'name','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12'])!!}
                                {!!view($view_path.'.builder.checkbox',['label' => 'Active','name' => 'active','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value' => ''])!!}
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
    </section>
</form>
@endsection
