<div class="container">
    <!-- Header: START -->
    <div class="block-header">
        <h2 class="pull-left">Lecture - List</h2>
        <div class="pull-right">
            @if($hasCreateAccess)
                <a href="{{action('LectureController@getCreate')}}" class="btn btn-link">
                    <i class="zmdi zmdi-plus"></i> Create
                </a>
            @endif
        </div>
    </div>
    <!-- Header: END -->
    <div class="card">
        <div class="card-header">
            <h2>Lecture <small>Sorted by date updated</small></h2>
        </div>
        <!-- List: START -->
        @if(count($lecture_list) > 0)
            <table id="data-table" class="table table-striped table-vmiddle">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="name" > Name</th>
                        <th data-column-id="course">Course</th>

                        @if($isSuperAdmin)
                            <th data-column-id="created_at" data-order="desc">Created at</th>
                            <th data-column-id="updated_at">Updated At</th>
                        @endif
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($lecture_list as $lecture_row)
                    <tr class="lecture-row">
                        <td>{{$lecture_row->id}}</td>
                        <td>{{$lecture_row->name}}</td>
                        <td>@if($lecture_row->course){{$lecture_row->course->name}}@endif</td>

                        @if($isSuperAdmin)
                            <td>{{$lecture_row->created_at}}</td>
                            <td>{{$lecture_row->updated_at}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="card-body card-padding text-center">
                <h3>
                    <i class="zmdi zmdi-alert-triangle"></i> No lectures in the system
                </h3>
            </div>
        @endif
        <!-- List: END -->
    </div>
</div>