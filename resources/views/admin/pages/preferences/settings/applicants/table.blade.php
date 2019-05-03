<div class="container-fluid">
    <table class="table table-striped table-hover">
        <thead>
            <tr> 
                <th>No</th>
                <th>Name
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
                <th>Phone
                    @if(Request::input('order') == 'desc')
                        <a href="{{ Request::fullUrlWithQuery(['sort' => 'phone','order' => 'asc']) }}"> <i class="fa fa-angle-up"></i>
                        </a>
                    @else
                        <a href="{{ Request::fullUrlWithQuery(['sort' => 'phone','order' => 'desc']) }}"> <i class="fa fa-angle-down"></i>
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
            @foreach($category as $key)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$key->firstname.' '.$key->lastname}}</td>
                    <td>{{$key->email}}</td>
                    <td>{{$key->phone}}</td>
                    <td>
                        @if($key->title != 'Free') 
                            {{$key->title}}
                        @else
                            {{"-"}}
                        @endif
                    </td>
                    <td>{{$key->created_at->diffForHumans()}}</td>
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
                    <td>
                        <a><button class="open-detail btn btn-info" data-id="{{$key->id}}">Details</button></a>
                        {{ method_field('get') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-xs-offset-5 col-sm-offset-5 col-md-offset-5 col-lg-offset-5">
        {{$category->links()}}
    </div>
</div>