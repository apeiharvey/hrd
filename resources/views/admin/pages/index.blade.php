@extends($view_path.'.layout.master')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Applicant Data</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="info-box-4 hover-expand-effect">
                                                <div class="icon">
                                                    <i class="material-icons col-teal">person_add</i>
                                                </div>
                                                <div class="content">
                                                    <div class="text">NEW APPLICANT</div>
                                                    <div class="timer number count-to" data-from="0" data-to="{{count($today_unread)}}" data-speed="500" data-fresh-interval="20">
                                                        {{count($today_unread)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="info-box-4 hover-expand-effect">
                                                <div class="icon">
                                                    <i class="material-icons col-green">markunread</i>
                                                </div>
                                                <div class="content">
                                                    <div class="text">TOTAL UNREAD</div>
                                                    <div class="timer number count-to" data-from="0" data-to="{{count($unread)}}" data-speed="500" data-fresh-interval="20">
                                                        {{count($unread)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="info-box-4 hover-expand-effect">
                                                <div class="icon">
                                                    <i class="material-icons col-green">person</i>
                                                </div>
                                                <div class="content">
                                                    <div class="text">TOTAL APPLICANT</div>
                                                    <div class="timer number count-to" data-from="0" data-to="{{count($total)}}" data-speed="500" data-fresh-interval="20">
                                                        {{count($total)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4>Applicant Data Filter</h4>
                                    <select id="time" class="form-control show-tick">
                                        <option value="1">Daily</option>
                                        <option value="2">Weekly</option>
                                        <option value="3">Monthly</option>
                                        <option value="4">All of Time</option>
                                    </select>
                                </div>
                                <div class="col-xs-12">
                                    <div id="piechart_3d" style="width: 100%;height: 400px"></div>
                                </div>
                                <div class="col-xs-12">
                                    <h4>Applicant Data Total/Year</h4>
                                    <div id="columnchart_material" style="width: 100%; height: 550px;"></div>
                                    <br/>
                                </div>
                                <div class="container-fluid">
                                    <div class="col-xs-6">
                                        <h4>Recent Applied Applicants</h4>
                                    </div>
                                    <div class="col-xs-12">
                                         <table id="table" class="table table-striped table-hover">
                                            <thead>
                                                <tr> 
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Job Proposed</th>
                                                    <th>Created At</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recent as $key)
                                                    <tr>
                                                        <td>{{$no++}}</td>
                                                        <td>{{$key->firstname.' '.$key->lastname}}</td>
                                                        <td>{{$key->email}}</td>
                                                        <td>{{$key->phone}}</td>
                                                        <td>{{$key->title}}</td>
                                                        <td>{{$key->created_at->diffForHumans()}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection