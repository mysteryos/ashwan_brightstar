<div class="pm-overview c-overflow">
    <div class="col-xs-12 p-t-30 p-b-30 text-center c-white f-100 t-uppercase bgm-cyan pull-left">{{$batch->id}}</div>
    <div class="m-t-20 pull-left pmo-contact">
        <ul class="list-unstyled">
            <li class="m-l-20"><i class="zmdi zmdi-time-restore m-r-5"></i> Last Update: <span title="{{$batch->updated_at}}">{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$batch->updated_at)->diffForHumans(\Carbon\Carbon::now())}}</span></li>
        </ul>
    </div>
</div>