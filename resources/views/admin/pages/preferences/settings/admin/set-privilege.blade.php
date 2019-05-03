@extends($view_path.'.layout.master')
@section('content')

<form class="update" action="{{url($view_path.'/privilege/'.$id)}}" method="post" enctype="multipart/form-data">
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
                            <a href="{{url($view_path.'/privilege/')}}">
                                <div class="pull-right" style="margin-bottom: 10px;">
                                    <button type="Button" class="btn btn-danger btn-lg waves-effect">Back</button>
                                </div>
                            </a>
                            <h2>
                                Privilege Settings
                                <small>You Can Set User Privilege Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="container-fluid">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr> 
                                                <th>No</th>
                                                <th>Menu</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($menu_privilege as $key)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$key->menu}}</td>
                                                <td>
                                                    <input class="cb" type="checkbox" name="id[]" @if($key->active == 1) {{"checked"}} @endif @if($key->menu == 'Dashboard') {{"checked"}} @endif @if($key->menu == 'Preferences') {{"checked"}} @endif @if($key->alias == 'manage_account') {{"checked"}} @endif value="{{$key->id}}">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <input type="hidden" name="user_access" value="{{$id}}">
                                    <button type="Submit" class="btn btn-success btn-lg waves-effect">Submit</button>
                                    {!!csrf_field()!!}
                                    {{ method_field('put') }}
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
