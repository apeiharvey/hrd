@extends($view_path.'.layout.master')
@section('content')

<form method="post" id="applyForm" action="{{url($view_path.'/applicants/mailTo')}}" class="form-horizontal insert">
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
        @if ($errors->any())
            {!!view($view_path.'.builder.error',[])!!}
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class=".col-xs-12 .col-sm-6 .col-md-8">
                    <div class="card">
                        <div class="header">
                            <a href="{{url($view_path.'/applicants')}}">
                                <div class="pull-right" style="margin-bottom: 10px;">
                                    <button type="Button" class="btn btn-danger btn-lg waves-effect">Back</button>
                                </div>
                            </a>
                            <h2>
                                Email
                                <small>You Can Send Email To The Applicants Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="tab-content">
                                <div class="row clearfix">
                                    {!!view($view_path.'.builder.label',['label' => 'To:'])!!}
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="form-line">
                                                <textarea rows="1" name="to" class="form-control no-resize auto-growth">@foreach ($mail as $key){{$key->email.";"}}@endforeach</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {!!view($view_path.'.builder.label',['label' => 'Subject:'])!!}
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="template" class="form-control show-tick template">
                                                    <option value="0">Choose Template..</option>
                                                    @foreach($template as $key)
                                                      @if($key->id != 0)
                                                        <option value="{{$key->id}}">{{$key->name}}</option>
                                                      @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {!!view($view_path.'.builder.label',['label' => 'Content'])!!}
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="form-line">
                                                <textarea id="content" rows="5" name="content" class="form-control no-resize auto-growth editor"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <p>*<strong>Note</strong>:</p>
                                        <p>{name} is Applicant's Name.</p>
                                        <p>{job_title} is Applicant's Job Proposed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="id" value="<?php foreach ($mail as $key): echo $key->id.';'; endforeach ?>">
                                <input type="hidden" name="name" value="<?php foreach ($mail as $key): echo $key->firstname.' '.$key->lastname.';'; endforeach ?>">
                                <button type="Submit" class="btn btn-success btn-lg waves-effect">Submit</button>
                                {!!csrf_field()!!}
                            </div>
                        </div>
                    </div>
                    <div id="myModal" class="modal" style="width:460px;height:300px;top:100px;left:450px;">
                        <div class="modal-content">
                            <div class="modals-headers text-center">
                                <span class="close">&times;</span>
                                <h2 style="text-align: center"></h2>
                            </div>
                            <div class="modals-body text-center font-16">
                                <p style="text-align: center"></p>
                                <p class="p2" style="text-align: center"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection
