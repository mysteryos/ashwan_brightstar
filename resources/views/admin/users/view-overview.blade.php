<div class="pm-overview c-overflow">
    <div class="col-xs-12 p-t-30 p-b-30 text-center c-white f-100 t-uppercase bgm-cyan pull-left">{{$user->first_name[0]}} {{$user->last_name[0]}}</div>
    <div class="m-t-20 pull-left pmo-contact">
        <ul class="list-unstyled">
            <li class="m-l-20">
                <i class="zmdi @if($user->isActivated === false){{"zmdi-alert-triangle"}}@else{{"zmdi-check"}}@endif m-r-5"></i>
                Status: @if($user->isActivated === false){{"Inactive"}}@else{{"Active"}}@endif
                @if($user->isActivated === false)
                    <form action="{{action('Admin\UsersController@postActivateUser')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="user_id" value="{{\Crypt::encrypt($user->id)}}" />
                        <button class="btn btn-info btn-xs waves-effect btn-activate-now m-t-5" type="submit">Activate</button>
                    </form>
                @else
                    <form action="{{action('Admin\UsersController@postDeactivateUser')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="user_id" value="{{\Crypt::encrypt($user->id)}}" />
                        <button class="btn btn-info btn-xs waves-effect btn-deactivate-now m-t-5" type="submit">Deactivate</button>
                    </form>
                @endif
            </li>
            <li class="m-l-20"><i class="zmdi zmdi-time-restore m-r-5"></i> Last Login: <span title="@if($user->last_login){{$user->last_login}}@endif">@if($user->last_login){{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$user->last_login)->diffForHumans(\Carbon\Carbon::now())}}@else{{"Never"}}@endif</span></li>
        </ul>
    </div>
</div>