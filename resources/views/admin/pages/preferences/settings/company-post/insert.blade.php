@extends($view_path.'.layout.master')
@section('content')

<form class="insert" action="{{url($view_path.'/company-post')}}" method="post" enctype="multipart/form-data">
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
                            <a href="{{url($view_path.'/company-post/')}}">
                                <div class="pull-right" style="margin-bottom: 10px;">
                                    <button type="Button" class="btn btn-danger btn-lg waves-effect">Back</button>
                                </div>
                            </a>
                            <h2>
                                Insert Company Post
                                <small>You Can Insert / Input the Company Post Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="tab-content">
                                <div class="row clearfix">
                                    {!!view($view_path.'.builder.text',['label' => 'Title','name' => 'title','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => ''])!!}
                                    {!!view($view_path.'.builder.text',['label' => 'URL / Link','name' => 'url','form_class' => 'col-sm-12','value' => ''])!!}
                                    {!!view($view_path.'.builder.label',['label'=> 'Description (Max. 450 Characters)'])!!}
                                    {!!view($view_path.'.builder.textarea',['name' => 'description','form_class' => 'col-sm-12','value' => '', 'placeholder' => 'Description', 'maxlength' => '450', 'rows' => '4'])!!}
                                    {!!view($view_path.'.builder.label',['label'=> 'English Description (Max. 450 Characters)'])!!}
                                    {!!view($view_path.'.builder.textarea',['name' => 'description_eng','form_class' => 'col-sm-12','value' => '', 'placeholder' => 'Description', 'maxlength' => '450', 'rows' => '4'])!!}
                                    <div class="col-md-3">
                                        <p>
                                            <b>Category</b>
                                        </p>
                                        <select name="category" class="form-control show-tick">
                                            @foreach($companycategory as $key)
                                            <option value="{{$key->id}}">{{$key->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {!!view($view_path.'.builder.text',['label' => 'Order (Must Be a Number)','name' => 'order','form_class' => 'col-sm-12','value' => ''])!!}
                                    {!!view($view_path.'.builder.checkbox',['label' => 'Active','name' => 'active','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value' => ''])!!}
                                    {!!view($view_path.'.builder.fileinput',['types' => 'image','label' => 'Thumbnail','name' => 'thumbnail', 'fileopt' => '/public/images/admin/index.png', 'value' => ''])!!}
                                    {!!view($view_path.'.builder.label',['label' => 'Image Should Be 250x200 Pixels', 'class' => 'col-md-offset-7'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="Submit" class="btn btn-success btn-lg waves-effect">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection
