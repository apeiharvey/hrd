<!-- The Modal -->
<div id="myModal" class="modal-detail">
  <div class="modal-content-detail">
    <div class="modal-header-detail">
      <span class="close-detail">&times;</span>
        <h2 class="modal-title">Applicant</h2>
        <small>You Can See Applicant Details Here.</small>
        
    </div>
    <div class="modal-body-detail">
      <a class="btn btn-success btn-lg pull-right" href="{{asset('uploads/'.$applicant->resume)}}" download> Download the Resume Here</a>
      <ul class="nav nav-tabs tab-nav-right" role="tablist">
          <li role="presentation" class="active"><a href="#form" data-toggle="tab">Form</a></li>
          <li role="presentation"><a href="#email" data-toggle="tab">Email</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="form">
          <form class="update" action="{{url($view_path.'/applicants/'.$applicant->id)}}" method="post" enctype="multipart/form-data">
          <div class="col-sm-6">
            {!!view($view_path.'.builder.label',['label' => 'Firstname'])!!}
            {!!view($view_path.'.builder.text',['name' => '', 'value' => $applicant->firstname, 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
            {!!view($view_path.'.builder.label',['label' => 'Email'])!!}
            {!!view($view_path.'.builder.text',['name' => '', 'value' => $applicant->email, 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
            {!!view($view_path.'.builder.label',['label' => 'Job Proposed'])!!}
            {!!view($view_path.'.builder.text',['name' => '', 'value' => "$applicant->title", 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
            {!!view($view_path.'.builder.label',['label' => 'Work Experience'])!!}
            <div class="col-md-12">
              <div class="form-group">
                <div class="col-md-12">
                  <div class="form-line">
                  <textarea disabled="disabled" rows="6" name="" class="form-control no-resize auto-growth">{{$applicant->pengalaman}}</textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-top: 10px; margin-left: -16px;">
                      <p>
                          <b>Status</b>
                      </p>
                      <select name="status_id" class="form-control show-tick">
                          <option value="0">Choose Status..</option>
                          @foreach($applicantstatus as $key)
                              <option value="{{$key->id}}">
                                @if($key->status == "Interview_Process") {{"Interview Process"}}
                                @elseif($key->status == "Short_Listed") {{"Short Listed"}}
                                @elseif($key->status == "Failed_Interview") {{"Failed Interview"}}
                                @elseif($key->status == "Active_File") {{"Active File"}}
                                @elseif($key->status == "Refuse_Offering") {{"Refuse Offering"}}
                                @elseif($key->status == "Cancel_Join") {{"Cancel Join"}}
                                @elseif($key->status == "Not_Show") {{"Not Show"}}
                                @else {{$key->status}}
                                @endif
                              </option>
                          @endforeach
                      </select>
                  </div>
              </div>
          </div>
          <div class="col-sm-6">
            {!!view($view_path.'.builder.label',['label' => 'Lastname'])!!}
            {!!view($view_path.'.builder.text',['name' => '', 'value' => $applicant->lastname,'form_class' => 'col-sm-12', 'type' => '','disabled' => 'disabled'])!!}
            {!!view($view_path.'.builder.label',['label' => 'Phone'])!!}
            {!!view($view_path.'.builder.text',['name' => '', 'value' => $applicant->phone, 'type' => '','form_class' => 'col-sm-12','disabled' => 'disabled'])!!}
            {!!view($view_path.'.builder.label',['label' => 'Website / LinkedIn URL'])!!}
            {!!view($view_path.'.builder.text',['name' => '', 'value' => $applicant->url, 'type' => '', 'form_class' => 'col-md-12', 'disabled' => 'disabled'])!!}
            {!!view($view_path.'.builder.label',['label' => 'Log'])!!}
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Position</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($log as $key)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$key->title}}</td>
                  <td>{{$key->status}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="row">
            <div class="col-md-12 text-center" style="padding-bottom: 30px;">
                {!!view($view_path.'.builder.input',['type' => 'hidden', 'name' => 'id', 'value' => $applicant->id])!!}
                <button type="Submit" class="btn btn-success btn-lg waves-effect update" style="padding-top: 10px; padding-bottom: 10px;">Submit</button>
                {{ method_field('put') }}
                {!!csrf_field()!!}
            </div>
          </div>
        </form> 
        </div>
        <div role="tabpanel" class="tab-pane fade in" id="email">
          <form method="post" id="applyForm" action="{{url($view_path.'/applicants/mailTo')}}" class="form-horizontal insert">
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="email_address_2">To:</label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" id="to" name="to" disabled class="form-control to" value="{{$applicant->email}}" placeholder="Enter the email address">
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row clearfix">
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label for="subject">Subject:</label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
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
              </div>
              <div class="row clearfix">
                  <div class="col-lg-offset-2 col-lg-7 col-md-offset-2 col-md-7 col-sm-offset-4 col-sm-7 col-xs-offset-5 col-xs-7">
                      <div class="form-group">
                          <div class="form-line" >
                            <textarea style="width: 100%;" rows="3" name="content" class="form-control" id="content"></textarea>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row clearfix">
                  <div class="col-lg-offset-8 col-md-offset-8 col-sm-offset-8 col-xs-offset-8">
                    <input type="hidden" name="id" value="{{$applicant->id}}"> 
                    <button type="submit" id="" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                  </div>
              </div>
              {!!csrf_field()!!}
          </form>
        </div>
      </div> 
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