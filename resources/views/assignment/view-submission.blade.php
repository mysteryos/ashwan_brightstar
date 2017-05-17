<div class="container">

    @include('assignment.view-header')

    <div class="card" id="profile-main">
        @include('assignment.view-overview')
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                <li class="waves-effect"><a href="{{action('AssignmentController@getView',['assignment_id'=>$assignment->id])}}">About</a></li>
                <li class="active waves-effect"><a href="{{action('AssignmentController@getViewSubmission',['assignment_id'=>$assignment->id])}}">Submissions</a></li>
            </ul>

            <div class="pmb-block">
                <div class="pmbb-body p-l-30">
                    @if(count($assignment->subsmissions))
                        <table id="data-table" class="table table-striped table-vmiddle">
                            <thead>
                                <th>ID</th>
                                <th>Student</th>
                                <th>File</th>
                                <th>Date Submitted</th>
                            </thead>
                            <tbody>
                                @foreach($assignment->submissions as $row)
                                    <tr>
                                        <td>
                                            {{$row->id}}
                                        </td>
                                        <td>
                                            @if($row->student){{$row->student->name}}@else{{"(Student Profile Missing)"}}}@endif
                                        </td>
                                        <td>
                                            @if($row->file){{$row->file>name}}@else{{"(File Missing)"}}@endif
                                        </td>
                                        <td>
                                            @if($row->created_at){{$row->created_at->format('Y-m-d')}}@endif
                                        </td>
                                        @if($hasDeleteAccess)
                                            <td>
                                                <form action="{{action('AssignmentController@postDeleteSubmission')}}" class="delete_form">
                                                    <input type="hidden" name="id" value="{{\Crypt::encrypt($assignment->id)}}" />
                                                    <input type="hidden" name="submission_id"  value="{{\Crypt::encrypt($row->id)}}" />
                                                    <button class="btn btn-sm btn-danger btn-delete-submission col-xs-12" type="submit" title="Delete Submission" data-id="{{$row->id}}"><i class="zmdi zmdi-delete"></i></button>
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
                                <i class="zmdi zmdi-alert-triangle"></i> No submissions yet.
                            </h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>