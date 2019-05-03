<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs tab-nav-right" role="tablist">
        <li role="presentation" class="active" style="text-align: center;"><a href="#Category" data-toggle="tab">Position</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active in active" id="Category">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;">
                <ul class="demo-choose-skin">
                    @foreach($vacancypost as $key)
                        <a style="color: #000;" href="{{url($view_path.'/applicants/'.$key->post_alias)}}">
                            <li class="category" data-id="{{$key->id}}">
                                <span>
                                    {{$key->title}}
                                </span>
                                <span>{{"(".$key->total_applicant->count().")"}}</span>
                                <input type="hidden" name="id" value="{{$key->id}}">
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</aside>