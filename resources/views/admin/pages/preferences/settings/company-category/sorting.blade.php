@extends($view_path.'.layout.master')
@section('content')
<form method="post" class="update" action="{{url($view_path.'/company-category/doSorting')}}">
    {!!csrf_field()!!}
    <section class="content">
        @if(Session::has("message"))
            <div class="body">
                <div class="alert alert-success">
                    {{Session("message")}}
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class=".col-xs-12 .col-sm-6 .col-md-8">
                    <div class="card">
                        <div class="header">
                            <a href="{{url($view_path.'/company-category/')}}">
                                <div class="pull-right" style="margin-bottom: 10px;">
                                    <button type="Button" class="btn btn-danger btn-lg waves-effect">Back</button>
                                </div>
                            </a>
                            <h2>
                                Sort Company Category Order
                                <small>You Can Sort the Company Category Order Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="tab-content">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
                                    <ul id="sortable">
                                        @foreach($companycategory as $key)
                                            <li class="ui-state-default">
                                                <h6>{{$key->order}}</h6>
                                                <h5 data-toggle="tooltip" data-placement="bottom" title="{{$key->name}}" style="padding-top: 0px;">
                                                    @if(strlen($key->name)>25){{substr($key->name, 0, 25)."..."}}
                                                    @else {{$key->name}}
                                                    @endif
                                                </h5>
                                                <input type="hidden" name="id[]" value="{{$key->id}}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div style="padding-top: 50px;" class="col-md-12 text-center">
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