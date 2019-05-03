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
    <div class="container-fluid">
        <div class="row">
            <div class=".col-xs-12 .col-sm-6 .col-md-8">
                <div class="card">
                    <div class="header">
                        <h2>
                            Applicant
                            <small>You Can See Applicant Details Here.</small>
                        </h2>
                        <div class="col-xs-offset-9 col-sm-offset-9 col-md-offset-9 col-lg-offset-9">
                            <a href="{{asset('uploads/'.$applicant->resume)}}" download>
                                <button class="btn btn-info btn-lg waves-effect">Download the Resume Here</button>
                            </a> 
                        </div>
                    </div>
                    <div class="body">
                        <div class="container-fluid">
                            <div class="tab-content">
                                {!!view($view_path.'.builder.text',['label' => 'First Name','name' => '', 'value' => $applicant->firstname, 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Last Name','name' => '', 'value' => $applicant->lastname,'form_class' => 'col-sm-12', 'type' => '','disabled' => 'disabled'])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Email','name' => '', 'value' => $applicant->email, 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Phone','name' => '', 'value' => $applicant->phone, 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Job Proposed','name' => '', 'value' => "$applicant->title", 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
                                {!!view($view_path.'.builder.text',['label' => 'URL','name' => '', 'value' => $applicant->url, 'type' => '', 'form_class' => 'col-sm-12', 'disabled' => 'disabled'])!!}
                                {!!view($view_path.'.builder.label',['label' => 'Work Experience'])!!}
                                {!!view($view_path.'.builder.textarea',['name' => '','form_class' => 'col-sm-12','value' => $applicant->pengalaman,'id' => 'mceNoEditor'])!!}
                                <form class="insert" action="{{url($view_path.'/preferences/applicants/'.$applicant->id)}}" method="post" enctype="multipart/form-data">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <p>
                                                <b>Status</b>
                                            </p>
                                            <select name="status_id" class="form-control show-tick">
                                                @foreach($applicantstatus as $key)
                                                    <option value="{{$key->id}}">{{$key->status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 text-center">
                                        <a href="{{url($view_path.'/preferences/applicants/')}}">
                                            <button type="Button" class="btn btn-danger btn-lg waves-effect">Back</button>
                                        </a>
                                    </div>
                                    <div class="col-sm-6 text-center">
                                        {!!view($view_path.'.builder.input',['type' => 'hidden', 'name' => 'id', 'value' => $applicant->id])!!}
                                        <button type="Submit" class="btn btn-success btn-lg waves-effect update">Mark as Read</button>
                                        {{ method_field('put') }}
                                        {!!csrf_field()!!}
                                    </div>
                                </div>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</section>
@endsection