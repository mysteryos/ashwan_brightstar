<div class="pm-overview c-overflow">
    <div class="col-xs-12 p-t-30 p-b-30 text-center c-white f-100 t-uppercase bgm-cyan pull-left">{{$lecturer->first_name[0]}} {{$lecturer->last_name[0]}}</div>
    <div class="m-t-20 pull-left pmo-contact">
        <ul class="list-unstyled">
            <li class="m-l-20">
                <i class="zmdi zmdi-time-restore m-r-5"></i> Last Update: <span title="{{$lecturer->updated_at}}">{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$lecturer->updated_at)->diffForHumans(\Carbon\Carbon::now())}}</span>
            </li>
            <li class="m-l-20">
                <i class="zmdi zmdi-account m-r-5"></i>
                @if($has_user_link_access)
                    @if((int)$lecturer->user_id > 0)
                        Linked to:
                        @if($lecturer->user)
                            <a class="m-l-5" href="{{action('Admin\UsersController@getView',['user_id'=>$lecturer->user_id])}}" title="{{$lecturer->user->email}}">{{$lecturer->user->getName()}}</a>
                        @else
                            <span class="m-r-5 m-l-5">N/A</span>
                        @endif
                        <a class="btn btn-danger btn-xs m-l-5" id="btn_unlink_user" href="{{action('LecturerController@getUnlinkUser',['lecturer_id'=>$lecturer->id])}}">Unlink</a>
                    @else
                        <a id="btn_link_user" class="btn btn-default btn-xs m-l-5">Link</a>
                    @endif
                @else
                    Linked to:
                    @if((int)$lecturer->user_id > 0 && $lecturer->user)
                        <span class="m-l-5" title="{{$lecturer->user->email}}">{{$lecturer->user->getName()}}</span>
                    @else
                        <span class="m-l-5">N/A</span>
                    @endif
                @endif
            </li>
        </ul>
    </div>
</div>