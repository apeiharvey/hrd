@extends($view_path.'.layout.master')
@section('content')
    {!!csrf_field()!!}
    <section class="content">
        @if(Session::has("message_delete"))
        <div class="body">
            <div class="alert alert-danger">
                {{Session("message_delete")}}
            </div>
        </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class=".col-xs-12 .col-sm-6 .col-md-8">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Gallery Settings
                                <small>You Can Insert / Input, Update, and Delete the Gallery for Employees' Activty Here</small>
                            </h2>
                            <div class="col-xs-offset-8 col-sm-offset-8 col-md-offset-8 col-lg-offset-8">
                                <div style="margin-bottom: -10px" class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">search</i>
                                    </span>
                                    <div class="form-line">
                                    <form method="get" action="{{url($view_path.'/gallery')}}">
                                        <input type="text" class="form-control" name="search" placeholder="Search.." value="{{Request::input('search')}}" autofocus>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="container-fluid">
                                <a href="{{url($view_path.'/gallery/create')}}">
                                    <button style="margin-left: 10px;" class="btn btn-primary pull-right">Insert Image</button>
                                </a>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr> 
                                                <th>No</th>
                                                <th>Title
                                                    @if(Request::input('order') == 'desc')
                                                        <a href="{{ Request::fullUrlWithQuery(['sort' => 'title','order' => 'asc']) }}"> <i class="fa fa-angle-up"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ Request::fullUrlWithQuery(['sort' => 'title','order' => 'desc']) }}"> <i class="fa fa-angle-down"></i>
                                                        </a>
                                                    @endif
                                                </th>
                                                <th>Thumbnail</th>
                                                <th>Created At
                                                    @if(Request::input('order') == 'desc')
                                                        <a href="{{ Request::fullUrlWithQuery(['sort' => 'created_at','order' => 'asc']) }}"> <i class="fa fa-angle-up"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ Request::fullUrlWithQuery(['sort' => 'created_at','order' => 'desc']) }}"> <i class="fa fa-angle-down"></i>
                                                        </a>
                                                    @endif
                                                </th>
                                                <th>Status
                                                    @if(Request::input('order') == 'desc')
                                                        <a href="{{ Request::fullUrlWithQuery(['sort' => 'active','order' => 'asc']) }}"> <i class="fa fa-angle-up"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ Request::fullUrlWithQuery(['sort' => 'active','order' => 'desc']) }}"> <i class="fa fa-angle-down"></i>
                                                        </a>
                                                    @endif
                                                </th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($gallery as $key)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$key->title}}</td>
                                                <td>{{$key->thumbnail}}</td>
                                                <td>{{$key->created_at->diffForHumans()}}</td>
                                                <td>
                                                    @if($key->active == 1) {{"Active"}}
                                                    @else {{"InActive"}}
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{url($view_path.'/gallery/'.$key->id)}}" method="post">
                                                        <button class="btn btn-info">Update</button>
                                                        {{ method_field('get') }}
                                                    </form>
                                                </td>
                                                <td>
                                                    <form class="delete" action="{{url($view_path.'/gallery/'.$key->id)}}" method="post">
                                                        <a><button class="btn btn-danger">Delete</button></a>
                                                        {{ method_field('delete') }}
                                                        {!!csrf_field()!!}
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="col-md-offset-5">
                                        {{$gallery->appends(Request::query())->links()}}
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