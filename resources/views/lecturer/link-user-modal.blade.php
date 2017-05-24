<!-- Add Address Modal -->
<div tabindex="-1" role="dialog" id="link_user_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Link User</h4>
            </div>
            <div class="modal-body">
                <form id="link_user_form" name="link_user_form" class="form-horizontal" action="{{action('LecturerController@postLinkUser')}}" method="POST" >
                    {{csrf_field()}}
                    <input type="hidden" name="lecturer_id" value="{{$lecturer->id}}" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input_new_user_id">User</label>
                        <div class="col-sm-10">
                            <div class="fg-line">
                                @if(count($user_orphans) > 0)
                                    <div class="select">
                                        <select name="user_id" id="input_new_user_id" class="form-control col-xs-12">
                                            <option selected disabled>Select a user</option>
                                            @foreach($user_orphans as $user_row)
                                                <option value="{{$user_row->id}}">{{$user_row->getName()}} - {{$user_row->email}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <span class="form-control-static">No users available.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn_submit"><i class="zmdi zmdi-plus"></i> Submit</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Add Address Modal End -->