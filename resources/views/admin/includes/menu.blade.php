<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <?php 
            $temp = null;
        ?>
        @foreach($menu as $value)
        @if($value['detail']->menu == 'Dashboard')
        <li class="<?php if(str_replace('admin','',Request::path()) == "") echo"active"; ?>">
        @else
        @for($i=0;$i<count($value['url']);$i++)
        @if(in_array(str_replace('admin','',Request::path()),$value['url']) || Request::is($view_path.$value['url'][$i].'/*'))
            <li class="active">
        @endif
        @endfor
        @endif
            @if($value['detail']->menu == 'Dashboard')
            <a href="{{url($view_path.$value['detail']->menu_alias)}}">
            @else
            <a href="javascript:void(0);" class="menu-toggle">
            @endif
                <i class="material-icons">{{$value['detail']->icon}}</i>
                <span>{{$value['detail']->menu}}</span>
            </a>
            @if($value['submenu']->count() > 0)
            <ul class="ml-menu">
                @foreach($value['submenu'] as $key)
                <li class="{{Request::path() == $view_path.$key->menu_alias || Request::is($view_path.$key->menu_alias.'/*') ? 'active' : ''}}">
                    <a href="{{url($view_path.$key->menu_alias)}}">
                        <span>{{$key->menu}}</span>
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
</div>