@extends($view_path.'.layout.master')
@section('content')

<form class="insert" action="{{url($view_path.'/settings/addSettings')}}" method="post" enctype="multipart/form-data">
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
                            <h2>
                                Settings
                                <small>You Can Set The General Settings Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#general" data-toggle="tab">General Settings</a></li>
                                <li role="presentation"><a href="#technical" data-toggle="tab">Technical Settings</a></li>
                                <li role="presentation"><a href="#seo" data-toggle="tab">SEO Settings</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="general">
                                    <div class="row clearfix">
                                        {!!view($view_path.'.builder.text',['label' => 'Web Name','name' => 'web_name','form_class' => 'col-sm-6 col-md-6 col-lg-6 col-xs-6','value' => $web_name])!!}
                                        {!!view($view_path.'.builder.text',['label' => 'Email','name' => 'web_email','form_class' => 'col-sm-6 col-md-6 col-lg-6 col-xs-6','value' => $web_email])!!}
                                        {!!view($view_path.'.builder.text',['label' => 'Place Name','name' => 'place_name','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $place_name])!!}
                                        {!!view($view_path.'.builder.text',['label' => 'Address','name' => 'address','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $address])!!}
                                        <h4 class="card-inside-title" style="padding-left: 15px;">Google Maps</h4>
                                        {!!view($view_path.'.builder.text',['label' => 'Latitude','name' => 'latitude','form_class' => 'col-sm-6 col-md-6 col-lg-6 col-xs-6','value' => $latitude])!!}
                                        {!!view($view_path.'.builder.text',['label' => 'Longitude','name' => 'longitude','form_class' => 'col-sm-6 col-md-6 col-lg-6 col-xs-6','value' => $longitude])!!}
                                        {!!view($view_path.'.builder.fileinput',['types' => 'image','label' => 'Logo Header','name' => 'logo_header', 'fileopt' => '/public/images/admin/index.png', 'value' => asset('images/frontend/web/'.$logo_header)])!!}
                                        {!!view($view_path.'.builder.label',['label' => 'Image Must Be 300x80 Pixels', 'class' => 'col-md-offset-8'])!!}
                                        {!!view($view_path.'.builder.fileinput',['types' => 'image','label' => 'Logo Footer','name' => 'logo_footer', 'fileopt' => '/public/images/admin/index.png', 'value' => asset('images/frontend/web/'.$logo_footer)])!!}
                                        {!!view($view_path.'.builder.label',['label' => 'Image Must Be 200x60 Pixels', 'class' => 'col-md-offset-8'])!!}
                                        {!!view($view_path.'.builder.fileinput',['types' => 'image','label' => 'Fav Icon','name' => 'fav_icon', 'fileopt' => '/public/images/admin/index.png', 'value' => asset('images/frontend/web/'.$fav_icon)])!!}
                                        {!!view($view_path.'.builder.label',['label' => 'Image Must Be 30x30 Pixels', 'class' => 'col-md-offset-6'])!!}
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="technical">
                                    <div class="demo-masked-input">
                                        <div class="row clearfix">
                                            {!!view($view_path.'.builder.checkbox',['label' => 'Maintenance Mode','name' => 'maintenance','form_class' => 'col-sm-6 col-md-6 col-lg-6 col-xs-6', 'value' => $maintenance])!!}
                                            {!!view($view_path.'.builder.textip',['label' => 'WhiteList IP','name' => 'whitelist_ip','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $whitelist_ip])!!}
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="seo">
                                    <div class="row clearfix">
                                    {!!view($view_path.'.builder.text',['label' => 'Meta Title','name' => 'meta_title','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $meta_title])!!}
                                    {!!view($view_path.'.builder.text',['label' => 'Meta Description','name' => 'meta_description','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $meta_description])!!}
                                    {!!view($view_path.'.builder.label',['label' => 'Meta Keywords'])!!}
                                    {!!view($view_path.'.builder.textarea',['label' => 'Meta Keywords','name' => 'meta_keywords','form_class' => 'col-sm-12 col-md-12 col-lg-12 col-xs-12','value' => $meta_keywords, 'placeholder' => 'Meta Keywords'])!!}
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
        </div>
    </section>
</form>
@endsection
