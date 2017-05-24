<div class="container">
    <!-- Header: START -->
    <div class="block-header">
        <h2 class="pull-left">Assignment - List</h2>
        <div class="pull-right">
            @if($can_create_assignment)
                <a href="{{action('AssignmentController@getCreate')}}" class="btn btn-link">
                    <i class="zmdi zmdi-plus"></i> Create
                </a>
            @endif
        </div>
    </div>
    <!-- Header: END -->
    <div class="card">
        <div class="card-header">
            <h2>Assignment <small>Sorted by date updated</small></h2>
        </div>
        <!-- List: START -->
        @if(count($assignment_list) > 0)
            <table id="data-table" class="table table-striped table-vmiddle">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="name" >Name</th>
                        <th data-column-id="lecture_id" >Lecture</th>
                        <th data-column-id="is_active">Active</th>
                        @if($isStudent)
                            <th data-column-id="submitted">Submitted</th>
                        @endif
                        <th data-column-id="submission_date">Due on</th>
                        @if($isSuperAdmin)
                            <th data-column-id="created_at" data-order="desc">Created at</th>
                            <th data-column-id="updated_at">Updated At</th>
                        @endif
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($assignment_list as $assignment_row)
                    <tr class="assignment-row">
                        <td>{{$assignment_row->id}}</td>
                        <td>{{$assignment_row->name}}</td>
                        <td>@if($assignment_row->lecture){{$assignment_row->lecture->name}}@else{{('N/A')}}@endif</td>
                        <td data-html="allow">@if($assignment_row->isActive())<span class="c-green">Yes</span>@else<span class="c-red">No</span>@endif</td>
                        @if($isStudent)
                            <td data-html="allow">@if($assignment_row->isSubmitted)<span class="c-green">Yes</span>@else<span class="c-red">No</span>@endif</td>
                        @endif
                        <td>@if($assignment_row->submission_date){{$assignment_row->submission_date->format('Y-m-d')}}@endif</td>
                        @if($isSuperAdmin)
                            <td>{{$assignment_row->created_at}}</td>
                            <td>{{$assignment_row->updated_at}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="card-body card-padding text-center">
                <h3>
                    <i class="zmdi zmdi-alert-triangle"></i> No assignment in the system
                </h3>
            </div>
        @endif
        <!-- List: END -->
    </div>
</div>