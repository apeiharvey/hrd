@extends($view_path.'.layout.master')
@section('content')

<form class="update" action="{{url($view_path.'/company-value/'.$companyvalue->id)}}" method="post" enctype="multipart/form-data">
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
                            <a href="{{url($view_path.'/company-value/')}}">
                                <div class="pull-right" style="margin-bottom: 10px;">
                                    <button type="Button" class="btn btn-danger btn-lg waves-effect">Back</button>
                                </div>
                            </a>
                            <h2>
                                Update Company Value
                                <small>You Can Update the Company Value Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="tab-content">
                                {!!view($view_path.'.builder.input',['type' => 'hidden', 'name' => 'id', 'value' => $companyvalue->id])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Name','name' => 'name','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $companyvalue->name])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Description','name' => 'description','form_class' => 'col-sm-12','value' => $companyvalue->description])!!}
                                {!!view($view_path.'.builder.label',['label' => 'Content'])!!}
                                {!!view($view_path.'.builder.textarea',['name' => 'content','form_class' => 'col-sm-12','value' => $companyvalue->content, 'placeholder' => 'Content', 'class' => 'editor'])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Order (Must Be a Number)','name' => 'order','form_class' => 'col-sm-12','value' => $companyvalue->order])!!}
                                {!!view($view_path.'.builder.input',['label' => 'Created By','name' => 'created_by','type' => 'hidden', 'value' => $companyvalue->created_by])!!}
                                {!!view($view_path.'.builder.input',['label' => 'Updated By','name' => 'updated_by','type' => 'hidden', 'value' => $companyvalue->updated_by])!!}
                                {!!view($view_path.'.builder.checkbox',['label' => 'Active','name' => 'active','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value' => $companyvalue->active])!!}
                                {!!view($view_path.'.builder.fileinput',['types' => 'image','label' => 'Thumbnail','name' => 'thumbnail', 'fileopt' => '/public/images/admin/index.png', 'value' => asset('images/frontend/company-value/'.$companyvalue->thumbnail)])!!}
                                {!!view($view_path.'.builder.label',['label' => 'Image Must Be 250x150 Pixels', 'class' => 'col-md-offset-6'])!!}
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
