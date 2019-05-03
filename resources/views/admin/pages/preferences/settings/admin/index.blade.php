@extends($view_path.'.layout.master')
@section('content')
{!!csrf_field()!!}
<section class="content">
    @if(Session::has("message"))
        <div class="body">
            <div class="alert alert-success">
                {{Session("message")}}
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
    <div class="container-fluid">
        <div class="row">
            <div class=".col-xs-12 .col-sm-6 .col-md-8">
                <div class="card">
                    <div class="header">
                        <h2>
                            Admin Settings
                            <small>You Can Insert, Update, and Delete the Registered Users Here</small>
                        </h2>
                        <div class="col-xs-offset-8 col-sm-offset-8 col-md-offset-8 col-lg-offset-8">
                            <div style="margin-bottom: -10px" class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">search</i>
                                </span>
                                <div class="form-line">
                                <form method="get" action="{{url($view_path.'/privilege')}}">
                                    <input type="text" class="form-control" name="search" placeholder="Search.." value="{{Request::input('search')}}" autofocus>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="container-fluid">
                            <a href="{{url($view_path.'/privilege/create')}}">
                                <button style="margin-left: 10px;" class="btn btn-primary pull-right">Insert Category</button>
                            </a>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr> 
                                            <th>No</th>
                                            <th>Name
                                                @if(Request::input('order') == 'desc')
                                                    <a href="{{ Request::fullUrlWithQuery(['sort' => 'name','order' => 'asc']) }}"> <i class="fa fa-angle-up"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ Request::fullUrlWithQuery(['sort' => 'name','order' => 'desc']) }}"> <i class="fa fa-angle-down"></i>
                                                    </a>
                                                @endif
                                            </th>
                                            <th style="text-align: center;">Active</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users_access as $key)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$key->name}}</td>
                                            <td>
                                                <form method="post" class="activeForm" action="{{url($view_path.'/privilege/active')}}">
                                                    <div class="col-md-8">
                                                        <select name="active" class="form-control show-tick">
                                                            <option value="0" <?php if($key->active == 0) echo 'selected="selected"'; ?>>Inactive</option>
                                                            <option value="1" <?php if($key->active == 1) echo 'selected="selected"'; ?>>Active</option>
                                                        </select>  
                                                    </div>
                                                    <input type="hidden" name="id" value="{{$key->id}}">
                                                    <button type="submit" class="btn btn-success">update</button>
                                                    {!!csrf_field()!!}
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{url($view_path.'/privilege/'.$key->id)}}" method="post">
                                                    <a><button class="btn btn-success">Set Privilege</button></a>
                                                    {{ method_field('get') }}
                                                    {!!csrf_field()!!}
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="col-md-offset-4">
                                    {{$users_access->appends(Request::query())->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection