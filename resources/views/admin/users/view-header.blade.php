<div class="block-header">
    <h2>{{$user->first_name." ".$user->last_name}}</h2>

    <ul class="actions hidden-xs">
        <li class="dropdown">
            <a href="" data-toggle="dropdown">
                <i class="zmdi zmdi-more-vert"></i>
            </a>

            <ul class="dropdown-menu dropdown-menu-right">
                @if($isSuperAdmin)
                    <li>
                        <a href="{{action('Admin\UsersController@getLoginAs',$user->id)}}">Login as {{$user->first_name." ".$user->last_name}}</a>
                    </li>
                @endif
                <li>
                    <a href="">Other Settings</a>
                </li>
            </ul>
        </li>
    </ul>
</div>