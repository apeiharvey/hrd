@extends($view_path.'.layout.master')
@section('content')

<form class="update" action="{{url($view_path.'/company-post/'.$companypost->id)}}" method="post" enctype="multipart/form-data">
    {!!csrf_field()!!}
    <section class="content">
        @if(Session::has("message"))
            <div class="body">
                <div class="alert alert-success">
                    {{Session("message")}}
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
                                Update Company Post
                                <small>You Can Update Company Post Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="tab-content">
                                {!!view($view_path.'.builder.input',['type' => 'hidden', 'name' => 'id', 'value' => $companypost->id])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Title','name' => 'title','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $companypost->title])!!}
                                <div class="col-md-3">
                                    <p>
                                        <b>Category</b>
                                    </p>
                                    <select name="category" class="form-control show-tick">
                                        @foreach($companycategory as $key)
                                            <option value="{{$key->id}}" @if($companypost->category_id == $key->id) {{"selected='selected'"}} @endif>{{$key->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!!view($view_path.'.builder.text',['label' => 'URL / Link','name' => 'url','form_class' => 'col-sm-12','value' => $companypost->url])!!}
                                {!!view($view_path.'.builder.label',['label'=> 'Description (Max. 450 Characters)'])!!}
                                {!!view($view_path.'.builder.textarea',['name' => 'description','form_class' => 'col-sm-12','value' => $companypost->description, 'placeholder' => 'Description', 'class' => 'height', 'maxlength' => '450'])!!}
                                {!!view($view_path.'.builder.label',['label'=> 'English Description (Max. 450 Characters)'])!!}
                                {!!view($view_path.'.builder.textarea',['name' => 'description_eng','form_class' => 'col-sm-12','value' => $companypost->description_eng, 'placeholder' => 'Description', 'maxlength' => '450', 'rows' => '4'])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Order (Must Be a Number)','name' => 'order','form_class' => 'col-sm-12','value' => $companypost->order])!!}
                                {!!view($view_path.'.builder.input',['label' => 'Created By','name' => 'created_by','type' => 'hidden', 'value' => $companypost->created_by])!!}
                                {!!view($view_path.'.builder.input',['label' => 'Updated By','name' => 'updated_by','type' => 'hidden', 'value' => $companypost->updated_by])!!}
                                {!!view($view_path.'.builder.checkbox',['label' => 'Active','name' => 'active','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value' => $companypost->active])!!}
                                {!!view($view_path.'.builder.fileinput',['types' => 'image','label' => 'Thumbnail','name' => 'thumbnail', 'fileopt' => '/public/images/admin/index.png', 'value' => asset('images/frontend/company-post/'.$companypost->thumbnail)])!!}
                                {!!view($view_path.'.builder.label',['label' => 'Image Must Be 250x200 Pixels', 'class' => 'col-md-offset-7'])!!}
                                {{ method_field('put') }}
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="Submit" class="btn btn-success btn-lg waves-effect">Submit</button>
                                    {{ method_field('put') }}
                                    {!!csrf_field()!!}
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
