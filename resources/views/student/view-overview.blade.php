<div class="pm-overview c-overflow">
    <div class="col-xs-12 p-t-30 p-b-30 text-center c-white f-100 t-uppercase bgm-cyan pull-left">{{$student->first_name[0]}} {{$student->last_name[0]}}</div>
    <div class="m-t-20 pull-left pmo-contact">
        <ul class="list-unstyled">
            <li class="m-l-20">
                <i class="zmdi zmdi-time-restore m-r-5"></i> Last Update: <span title="{{$student->updated_at}}">{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$student->updated_at)->diffForHumans(\Carbon\Carbon::now())}}</span>
            </li>
            <li class="m-l-20">
                <i class="zmdi zmdi-account m-r-5"></i>
                @if($has_user_link_access)
                    @if((int)$student->user_id > 0)
                        Linked to:
                        @if($student->user)
                            <a class="m-l-5" href="{{action('Admin\UsersController@getView',['user_id'=>$student->user_id])}}" title="{{$student->user->email}}">{{$student->user->getName()}}</a>
                        @else
                            <span class="m-r-5 m-l-5">N/A</span>
                        @endif
                        <a class="btn btn-danger btn-xs m-l-5" id="btn_unlink_user" href="{{action('StudentController@getUnlinkUser',['student_id'=>$student->id])}}">Unlink</a>
                    @else
                        <a id="btn_link_user" class="btn btn-default btn-xs m-l-5">Link</a>
                    @endif
                @else
                    Linked to:
                    @if((int)$student->user_id > 0 && $student->user)
                        <span class="m-l-5" title="{{$student->user->email}}">{{$student->user->getName()}}</span>
                    @else
                        <span class="m-l-5">N/A</span>
                    @endif
                @endif
            </li>
        </ul>
    </div>
</div>