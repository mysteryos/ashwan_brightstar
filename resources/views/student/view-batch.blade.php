<div class="container">

    @include('student.view-header')

    <div class="card" id="profile-main">
        @include('student.view-overview')
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                <li class="waves-effect"><a href="{{action('StudentController@getView',['student_id'=>$student->id])}}">About</a></li>
                <li class="active waves-effect"><a href="{{action('StudentController@getViewBatch',['student_id'=>$student->id])}}">Batch</a></li>
            </ul>

            <!-- Add Batch to student -->
            @if($hasStudentUpdateAccess)
                <div class="pmb-block">
                    <div class="pmbb-body">
                        <form class="form-horizontal row" method="POST" action="{{action('StudentController@postCreateBatch')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{\Crypt::encrypt($student->id)}}" />
                            <div class="col-xs-10">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <div class="select">
                                            <select name="batch_id" class="form-control">
                                                <option value="" disabled selected>Select a batch</option>
                                                @foreach($batch_list as $batch_row)
                                                    <option value="{{\Crypt::encrypt($batch_row->id)}}">
                                                        {{$batch_row->name}} -
                                                        @if($batch_row->start_date)
                                                            {{$batch_row->start_date->format('Y-m-d')}}
                                                        @else
                                                            {{"(No Start Date"}}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <input type="submit" name="submit" class="btn btn-block btn-xs" value="Add Batch" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            @if(count($student->batch) > 0)
                <table id="data-table" class="table table-striped table-vmiddle">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric" data-order="desc">ID</th>
                            <th data-column-id="student">Batch</th>
                            <th data-column-id="start_date">Start Date</th>
                            @if($isSuperAdmin)
                                <th data-column-id="created_at">Created at</th>
                                <th data-column-id="updated_at">Updated At</th>
                            @endif
                            @if($hasStudentDeleteAccess)
                                <th data-column-id="commands" data-formatter="commands" data-sortable="false">&nbsp;</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($student->batch as $row)
                        <tr class="delegate-row">
                            <td><a href="{{action('BatchController@getView',['batch_id'=>$row->id])}}">{{$row->id}}</a></td>
                            <td>
                                {{$row->name}}
                            </td>
                            <td>
                                @if($row->start_date){{$row->start_date->format('Y-m-d')}}@endif
                            </td>
                            @if($isSuperAdmin)
                                <td>{{$row->pivot->created_at}}</td>
                                <td>{{$row->pivot->updated_at}}</td>
                            @endif
                            @if($hasStudentUpdateAccess)
                                <td data-html="allow">
                                    <form name="delete_student_form" action="{{action('StudentController@postDeleteBatch')}}" method="POST" class="form-horizontal" id="delete_student_form_{{$row->id}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$student->id}}" />
                                        <input type="hidden" name="batch_id" value="{{$row->id}}" />
                                        <button class="btn btn-sm btn-danger btn-delete-batch col-xs-12" type="submit" title="Delete Batch" data-id="{{$row->id}}">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
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
                        <i class="zmdi zmdi-alert-triangle"></i> No batch linked to this student.
                    </h3>
                </div>
            @endif
        </div>
    </div>

    @include('student.link-user-modal')
</div>