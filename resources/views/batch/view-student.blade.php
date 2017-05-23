<div class="container">

    @include('batch.view-header')

    <div class="card" id="profile-main">
        @include('batch.view-overview')
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                <li class="waves-effect"><a href="{{action('BatchController@getView',['student_id'=>$batch->id])}}">About</a></li>
                <li class="active waves-effect"><a href="{{action('BatchController@getViewStudent',['student_id'=>$batch->id])}}">Students</a></li>
            </ul>

            <!-- Add Student to batch -->
            @if($hasBatchUpdateAccess)
                <div class="pmb-block">
                    <div class="pmbb-body">
                        <form class="form-horizontal row" method="POST" action="{{action('BatchController@postCreateStudent')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{\Crypt::encrypt($batch->id)}}" />
                            <div class="col-xs-10">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <div class="select">
                                            <select name="student_id" class="form-control">
                                                <option value="" disabled selected>Select a student</option>
                                                @foreach($student_list as $student_row)
                                                    <option value="{{\Crypt::encrypt($student_row->id)}}">{{$student_row->name.'('.$student_row->email.')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <input type="submit" name="submit" class="btn btn-block btn-xs" value="Add Student" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            @if(count($batch->student) > 0)
                <table id="data-table" class="table table-striped table-vmiddle">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric" data-order="desc">ID</th>
                            <th data-column-id="student" >Student</th>
                            <th data-column-id="email">Email</th>
                            @if($isSuperAdmin)
                                <th data-column-id="created_at">Created at</th>
                                <th data-column-id="updated_at">Updated At</th>
                            @endif
                            @if($hasBatchDeleteAccess)
                                <th data-column-id="commands" data-formatter="commands" data-sortable="false">&nbsp;</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($batch->student as $student_row)
                        <tr class="delegate-row">
                            <td><a href="{{action('StudentController@getView',['student_id'=>$student_row->id])}}">{{$student_row->id}}<a/></td>
                            <td>
                                {{$student_row->name}}
                            </td>
                            <td>
                                {{$student_row->email}}
                            </td>
                            @if($isSuperAdmin)
                                <td>{{$student_row->pivot->created_at}}</td>
                                <td>{{$student_row->pivot->updated_at}}</td>
                            @endif
                            @if($hasBatchDeleteAccess)
                                <td data-html="allow">
                                    <form name="delete_student_form" action="{{action('BatchController@postDeleteStudent')}}" method="POST" class="form-horizontal" id="delete_student_form_{{$student_row->id}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$batch->id}}" />
                                        <input type="hidden" name="student_id" value="{{$student_row->id}}" />
                                        <button class="btn btn-sm btn-danger btn-delete-student col-xs-12" type="submit" title="Delete Student" data-id="{{$student_row->id}}"><i class="zmdi zmdi-delete"></i></button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="card-body card-padding text-center">
                    <h3>
                        <i class="zmdi zmdi-alert-triangle"></i> No students available for display.
                    </h3>
                </div>
            @endif
        </div>
    </div>
</div>