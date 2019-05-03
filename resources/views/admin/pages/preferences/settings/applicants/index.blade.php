@extends($view_path.'.layout.master')
@section('content')
    {!!csrf_field()!!}
    @include($view_path.'.includes.right-side-bar')
    <section class="content">
        @if(Session::has("message"))
            <div class="body">
                <div class="alert alert-success">
                    {{Session("message")}}
                </div>
            </div>
        @endif
        @if(Session::has("message-failed"))
            <div class="body">
                <div class="alert alert-danger">
                    {{Session("message-failed")}}
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class=".col-xs-12 .col-sm-6 .col-md-8">
                    <div class="card">
                        <div class="header">
                            @include($view_path.'.includes.carousel')
                            <h2>
                                Applicant <?php $array = explode('/',Request::url()); $category = end($array); if($category == 'applicants'){ echo "";} else{echo ucwords(str_replace('-', ' ', $category));} ?> {{$a}}
                                <small>You Can See Applicant List, Download Their CV/Resume and Accept/Reject Their Application Here</small>
                            </h2>
                            <div class="col-xs-offset-8 col-sm-offset-8 col-md-offset-8 col-lg-offset-8">
                                <div style="margin-bottom: -10px;" class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">search</i>
                                    </span>
                                    <div class="form-line">
                                    <form method="get" action="{{url($view_path.'/applicants')}}">
                                        <input type="text" style="padding: 5px;font-size: 16px;" class="form-control" name="search" placeholder="Search.." value="{{Request::input('search')}}" autofocus>
                                        <input type="hidden" name="filter" value="{{$filter}}">
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                        <form method="post" id="form1" action="{{url($view_path.'/applicants/mail')}}">
                            <div class="col-md-12" style="margin-bottom: 10px;">
                                <div class="col-md-4">
                                    <input type="submit" name="action" value="Email" class="btn btn-success">
                                </div>
                                <div class="col-md-8">
                                    <ul class="pull-right">
                                        <a href="javascript:void(0);" class="js-right-sidebar" data-close="true" style="padding:10px;background-color:#2196f3;color:#fff;border-radius:5px;">Position</a>
                                    </ul>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <select name="status_id" class="form-control show-tick">
                                            <option value="0">Choose Status..</option>
                                              @foreach($applicantstatus as $key)
                                                  <option value="{{$key->id}}">
                                                    {{str_replace('_',' ',$key->status)}}
                                                  </option>
                                              @endforeach
                                          </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" name="action" value="Move" class="btn btn-success">
                                    </div>
                                    <div class="table-applicant applicant">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr> 
                                                    <th>
                                                        <input type="checkbox" name="select-all" id="select-all">>
                                                    </th>
                                                    <th>No</th>
                                                    <th>Full Name
                                                        @if(Request::input('order') == 'desc')
                                                            <a href="{{ Request::fullUrlWithQuery(['sort' => 'firstname','order' => 'asc']) }}"> <i class="fa fa-angle-up"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ Request::fullUrlWithQuery(['sort' => 'firstname','order' => 'desc']) }}"> <i class="fa fa-angle-down"></i>
                                                            </a>
                                                        @endif
                                                    </th>
                                                    <th>Email
                                                        @if(Request::input('order') == 'desc')
                                                            <a href="{{ Request::fullUrlWithQuery(['sort' => 'email','order' => 'asc']) }}"> <i class="fa fa-angle-up"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ Request::fullUrlWithQuery(['sort' => 'email','order' => 'desc']) }}"> <i class="fa fa-angle-down"></i>
                                                            </a>
                                                        @endif
                                                    </th>
                                                    <th>Job Proposed
                                                        @if(Request::input('order') == 'desc')
                                                            <a href="{{ Request::fullUrlWithQuery(['sort' => 'title','order' => 'asc']) }}"> <i class="fa fa-angle-up"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ Request::fullUrlWithQuery(['sort' => 'title','order' => 'desc']) }}"> <i class="fa fa-angle-down"></i>
                                                            </a>
                                                        @endif
                                                    </th>
                                                    <th>
                                                        @if(substr(Request::server('QUERY_STRING'),7) != 'unread')
                                                            {{"Updated At"}}
                                                        @else {{"Created At"}}
                                                        @endif
                                                        @if(Request::input('order') == 'asc')
                                                            <a href="{{ Request::fullUrlWithQuery(['sort' => 'updated_at','order' => 'asc']) }}"> <i class="fa fa-angle-up"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ Request::fullUrlWithQuery(['sort' => 'updated_at','order' => 'desc']) }}"> <i class="fa fa-angle-down"></i>
                                                            </a>
                                                        @endif
                                                    </th>
                                                    <th>Status
                                                        @if(Request::input('order') == 'desc')
                                                            <a href="{{ Request::fullUrlWithQuery(['sort' => 'status_id','order' => 'asc']) }}"> <i class="fa fa-angle-up"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ Request::fullUrlWithQuery(['sort' => 'status_id','order' => 'desc']) }}"> <i class="fa fa-angle-down"></i>
                                                            </a>
                                                        @endif
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($applicant as $key)
                                                    <tr>
                                                        <td>
                                                            <input class="cb" type="checkbox" name="id[]" value="{{$key->id}}">
                                                        </td>
                                                        <td>{{$no++}}</td>
                                                        <td>{{$key->firstname.' '.$key->lastname}}</td>
                                                        <td>{{$key->email}}</td>
                                                        <td>{{$key->title}}</td>
                                                        <td>
                                                            @if(substr(Request::server('QUERY_STRING'),7) != 'unread')
                                                            {{$key->updated_at->diffForHumans()}}
                                                            @else {{$key->created_at->diffForHumans()}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($key->status_id==1){{"Unread"}}
                                                            @elseif($key->status_id==2){{"Interview Processed"}}
                                                            @elseif($key->status_id==3){{"Rejected"}}
                                                            @elseif($key->status_id==4){{"Hiring"}}
                                                            @elseif($key->status_id==5){{"Short Listed"}}
                                                            @elseif($key->status_id==6){{"Failed Interview"}}
                                                            @elseif($key->status_id==7){{"Offering"}}
                                                            @elseif($key->status_id==8){{"Active File"}}
                                                            @elseif($key->status_id==9){{"Refuse Offering"}}
                                                            @elseif($key->status_id==10){{"Trash"}}
                                                            @elseif($key->status_id==11){{"Cancel Join"}}
                                                            @else {{"Not Show"}}
                                                            @endif
                                                        </td>
                                </form>
                                                        <td>
                                                            <a><button class="open-detail btn btn-info"  data-filter=""  data-id="{{$key->id}}" data-status="{{$key->status_id}}">Details</button></a>
                                                            <input type="hidden" name="status_id_hidden" value="{{$key->status_id}}">
                                                            {{ method_field('get') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-offset-4">
                                        {{$applicant->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-t-24">
                <div class="message-applied alert">
                </div>
            </div>
        <div class="modal-container">
            
        </div>
        </div>
    </section>
@endsection