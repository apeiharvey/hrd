@extends($view_path.'.layout.master')
@section('content')

<form class="update" action="{{url($view_path.'/testimonial/'.$testimonial->id)}}" method="post" enctype="multipart/form-data">
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
                            <a href="{{url($view_path.'/testimonial/')}}">
                                <div class="pull-right" style="margin-bottom: 10px;">
                                    <button type="Button" class="btn btn-danger btn-lg waves-effect">Back</button>
                                </div>
                            </a>
                            <h2>
                                Update Testimonial
                                <small>You Can Update a Testimonial of Employees' Activty Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="tab-content">
                                {!!view($view_path.'.builder.input',['type' => 'hidden', 'name' => 'id', 'value' => $testimonial->id])!!}
                                {!!view($view_path.'.builder.text',['label' => "Employee's Name",'name' => 'name','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $testimonial->name])!!}
                                {!!view($view_path.'.builder.text',['label' => "Employee's Position",'name' => 'position','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $testimonial->position])!!}
                                {!!view($view_path.'.builder.label',['label' => "Employee's Testimony"])!!}
                                {!!view($view_path.'.builder.textarea',['name' => 'testimony','form_class' => 'col-sm-12','value' => $testimonial->testimony, 'placeholder' => 'Testimony', 'class' => 'editor'])!!}
                                {!!view($view_path.'.builder.text',['label' => 'Order (Must Be a Number)','name' => 'order','form_class' => 'col-sm-12','value' => $testimonial->order])!!}
                                {!!view($view_path.'.builder.checkbox',['label' => 'Active','name' => 'active','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12', 'value' => $testimonial->active])!!}
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
