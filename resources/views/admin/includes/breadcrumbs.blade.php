<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <ol class="breadcrumb">
                    <li class="<?php if(Request::path() == $view_path) echo "active";?>">
                        <a href="{{url($view_path)}}">
                            <i class="material-icons">home</i> Dashboard
                        </a>
                    </li>
                    <li class="<?php if(Request::path() == $view_path.'/preferences/contents') echo "active";?>">
                        <a href="javascript:void(0);">
                            <i class="material-icons">widgets</i> Contents
                        </a>
                    </li>
                    <li class="">
                        <i class="material-icons">widgets</i> Data
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>


