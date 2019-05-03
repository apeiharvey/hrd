@extends($view_path.'.layout.master')
@section('content')

<form class="insert" action="{{url($view_path.'/company-category')}}" method="post" enctype="multipart/form-data">
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
                            <a href="{{url($view_path.'/company-category/')}}">
                                <div class="pull-right" style="margin-bottom: 10px;">
                                    <button type="Button" class="btn btn-danger btn-lg waves-effect">Back</button>
                                </div>
                            </a>
                            <h2>
                                Insert Company Category
                                <small>You Can Insert / Input Company Category Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="tab-content">
                                <div class="row clearfix">
                                    {!!view($view_path.'.builder.text',['label' => 'Name','name' => 'name','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => ''])!!}
                                    {!!view($view_path.'.builder.text',['name' => 'name_alias','form_class' => 'col-sm-12','value' => '', 'placeholder' => 'Alias'])!!}
                                    {!!view($view_path.'.builder.text',['label' => 'Order','name' => 'order','form_class' => 'col-sm-12','value' => ''])!!}
                                    {!!view($view_path.'.builder.checkbox',['label' => 'Active','name' => 'active','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value' => ''])!!}
                                    {!!view($view_path.'.builder.fileinput',['types' => 'image','label' => 'Thumbnail','name' => 'thumbnail', 'fileopt' => '/public/images/admin/index.png', 'value' => ''])!!}
                                    {!!view($view_path.'.builder.label',['label' => 'Image Must Be 100x100 Pixels', 'class' => 'col-md-offset-7'])!!}
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
