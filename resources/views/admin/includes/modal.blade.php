<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 90%; height: 100%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Applicant</h2>
          <small>You Can See Applicant Details Here.</small>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="row">
            <div class=".col-xs-12 .col-sm-12 .col-md-12">
              <div class="header">
                  <div class="col-xs-offset-10 col-sm-offset-10 col-md-offset-10 col-lg-offset-10">
                      <a href="{{asset('uploads/')}}" download>
                          <button class="btn btn-info btn-md waves-effect">Download the Resume Here</button>
                      </a> 
                  </div>
              </div>
              <div class="body">
                  <div class="container-fluid">
                    <div class="tab-content">
                      {!!view($view_path.'.builder.text',['label' => 'First Name','name' => '', 'value' => {{$applicant->}}, 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
                      {!!view($view_path.'.builder.text',['label' => 'Last Name','name' => '', 'value' => '','form_class' => 'col-sm-12', 'type' => '','disabled' => 'disabled'])!!}
                      {!!view($view_path.'.builder.text',['label' => 'Email','name' => '', 'value' => '', 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
                      {!!view($view_path.'.builder.text',['label' => 'Phone','name' => '', 'value' => '', 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
                      {!!view($view_path.'.builder.text',['label' => 'Job Proposed','name' => '', 'value' => "", 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
                      {!!view($view_path.'.builder.text',['label' => 'URL','name' => '', 'value' => '', 'type' => '', 'form_class' => 'col-sm-12', 'disabled' => 'disabled'])!!}
                      {!!view($view_path.'.builder.label',['label' => 'Work Experience'])!!}
                      {!!view($view_path.'.builder.textArea',['name' => '','form_class' => 'col-sm-12','value' => '','id' => 'mceNoEditor'])!!}
                      <form class="insert" action="{{url($view_path.'/preferences/applicants/')}}" method="post" enctype="multipart/form-data">
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
                        <div class="row">
                          <div class="col-sm-6 text-center">
                              <!-- {!!view($view_path.'.builder.input',['type' => 'hidden', 'name' => 'id', 'value' => ''])!!} -->
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>