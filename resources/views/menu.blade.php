<aside id="sidebar">
    <div class="sidebar-inner c-overflow">
        <div class="profile-menu">
            <a href="">
                <div class="profile-pic">
                    @if($current_user !== false) <?php echo $DIService->user->getAvatarHTML($current_user); ?> @endif
                </div>

                <div class="profile-info" title="#{{$current_user->id}}">
                    @if($current_user !== false)
                        {{$current_user->first_name." ".$current_user->last_name}}
                    @else
                        (Guest)
                    @endif
                </div>
            </a>

            <ul class="main-menu">
                <li>
                    <a href="{{$view_profile_url}}"><i class="zmdi zmdi-account"></i> View Profile</a>
                </li>
                @if(session('login_as',false))
                    <li>
                        <a href="{{action('Admin\UsersController@getLoginBack')}}"><i class="zmdi zmdi-refresh-sync"></i> Login Back</a>
                    </li>
                @endif
                <li>
                    <a href="{{action('UserController@logout')}}" title="Logout"><i class="zmdi zmdi-square-right"></i> Logout</a>
                </li>
            </ul>
        </div>

        <ul class="main-menu">
            @foreach($menu as $topMenuItem)
                @if($topMenuItem->hasPermission())
                    @include('menu-item',['topMenuItem' => $topMenuItem])
                @endif
            @endforeach
        </ul>
    </div>
</aside>