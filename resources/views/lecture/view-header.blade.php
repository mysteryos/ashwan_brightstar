<div class="block-header">
    <h2 class="pull-left">{{$lecture->name}}</h2>
    @if($hasDeleteAccess)
        <form action="{{action('LectureController@postDelete')}}" method="post" name="lecture_delete_form" class="delete_form pull-right">
            <input type="hidden" value="{{Crypt::encrypt($lecture->id)}}" name="id" />
            {{csrf_field()}}
            <button class="btn btn-link" type="submit" id="btn_delete_main"><i class="zmdi zmdi-delete m-r-5"></i>Delete</button>
        </form>
    @endif
</div>