@extends($view_path.'.layout.master')
@section('content')
<form class="update" action="{{url($view_path.'/blog-category/'.$blogcategory->id)}}" method="post">
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
                            <a href="{{url($view_path.'/blog-category/')}}">
                                <div class="pull-right" style="margin-bottom: 10px;">
                                    <button type="Button" class="btn btn-danger btn-lg waves-effect">Back</button>
                                </div>
                            </a>
                            <h2>
                                Update Blog Category
                                <small>You Can Update the Blog Category Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="tab-content">
                                {!!view($view_path.'.builder.input',['type' => 'hidden', 'name' => 'id', 'value' => $blogcategory->id])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Name','name' => 'name','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $blogcategory->name])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Alias','name' => 'name_alias','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $blogcategory->name_alias])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Order (Must Be a Number)','name' => 'order','form_class' => 'col-sm-12','value' => $blogcategory->order])!!}
                                {!!view($view_path.'.builder.input',['label' => 'Created By','name' => 'created_by','type' => 'hidden', 'value' => $blogcategory->created_by])!!}
                                {!!view($view_path.'.builder.input',['label' => 'Updated By','name' => 'updated_by','type' => 'hidden', 'value' => ''])!!}
                                {!!view($view_path.'.builder.checkbox',['label' => 'Active','name' => 'active','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value' => $blogcategory->active])!!}
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success btn-lg waves-effect">Update</button>
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