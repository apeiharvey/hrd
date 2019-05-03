@extends($view_path.'.layout.master')
@section('content')
<form class="insert" action="{{url($view_path.'/contents/addContents')}}" method="post" enctype="multipart/form-data">
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
                                Contents
                                <small>You Can Insert / Input and Update the Website's Contents Here</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="container-fluid">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active">
                                        <div class="row clearfix">
                                            {!!view($view_path.'.builder.label',['label' => 'About us ID'])!!}
                                            {!!view($view_path.'.builder.textarea',['name' => 'about_us','form_class' => 'col-sm-12','value' => $about_us, 'placeholder' => 'About Us', 'class' => 'editor'])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'About us EN'])!!}
                                            {!!view($view_path.'.builder.textarea',['name' => 'about_us_en','form_class' => 'col-sm-12','value' => $about_us_en, 'placeholder' => 'About Us', 'class' => 'editor'])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'What Success / Quote'])!!}
                                            {!!view($view_path.'.builder.textarea',['name' => 'what_success','form_class' => 'col-sm-12','value' => $what_success, 'placeholder' => 'What Success', 'class' => 'editor'])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'Quote Author'])!!}
                                            {!!view($view_path.'.builder.textarea',['name' => 'what_success_author','form_class' => 'col-sm-12','value' => $what_success_author, 'placeholder' => 'Author'])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'Author Department'])!!}
                                            {!!view($view_path.'.builder.textarea',['name' => 'what_success_author_department','form_class' => 'col-sm-12','value' => $what_success_author_department, 'placeholder' => 'Author Department'])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'URL Video'])!!}
                                            {!!view($view_path.'.builder.textarea',['name' => 'video_url','form_class' => 'col-sm-12','value' => $video_url, 'placeholder' => 'Video URL'])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'Home Search Word Title'])!!}
                                            {!!view($view_path.'.builder.textarea',['name' => 'home_search_word_title','form_class' => 'col-sm-12','value' => $home_search_word_title, 'placeholder' => 'Home Search Word Title'])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'Home Search Word Description'])!!}
                                            {!!view($view_path.'.builder.textarea',['name' => 'home_search_word_description','form_class' => 'col-sm-12','value' => $home_search_word_description, 'placeholder' => 'Home Search Word Description'])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'Email Approved'])!!}
                                            {!!view($view_path.'.builder.textarea',['name' => 'email_approve','form_class' => 'col-sm-12','value' => $email_approve, 'placeholder' => 'Email Approve'])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'Email Rejected'])!!}
                                            {!!view($view_path.'.builder.textarea',['name' => 'email_reject','form_class' => 'col-sm-12','value' => $email_reject, 'placeholder' => 'Email Reject'])!!}
                                            {!!view($view_path.'.builder.fileinput',['types' => 'image','label' => 'Home Header','name' => 'home_header', 'fileopt' => '/public/images/admin/index.png', 'value' => asset('images/frontend/contents/'.$home_header)])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'Image Must Be 1200x450 Pixels', 'class' => 'col-md-offset-8'])!!}
                                            {!!view($view_path.'.builder.fileinput',['types' => 'image','label' => 'Contact Us Header','name' => 'contact_us_header', 'fileopt' => '/public/images/admin/index.png', 'value' => asset('images/frontend/contents/'.$contact_us_header)])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'Image Must Be 1200x450 Pixels', 'class' => 'col-md-offset-8'])!!}
                                            {!!view($view_path.'.builder.fileinput',['types' => 'image','label' => 'Gallery Header','name' => 'gallery_header', 'fileopt' => '/public/images/admin/index.png', 'value' => asset('images/frontend/contents/'.$gallery_header)])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'Image Must Be 1200x450 Pixels', 'class' => 'col-md-offset-8'])!!}
                                            {!!view($view_path.'.builder.fileinput',['types' => 'image','label' => 'Footer Background','name' => 'footer_background', 'fileopt' => '/public/images/admin/index.png', 'value' => asset('images/frontend/contents/'.$footer_background)])!!}
                                            {!!view($view_path.'.builder.label',['label' => 'Image Must Be 1200x169 Pixels', 'class' => 'col-md-offset-8'])!!}
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
        </div>
    </section>
</form>
@endsection
