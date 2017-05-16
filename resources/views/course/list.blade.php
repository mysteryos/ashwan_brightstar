<div class="container">
    <!-- Header: START -->
    <div class="block-header">
        <h2 class="pull-left">Course - List</h2>
        <div class="pull-right">
            @if($can_create_course)
                <a href="{{action('CourseController@getCreate')}}" class="btn btn-link">
                    <i class="zmdi zmdi-plus"></i> Create
                </a>
            @endif
        </div>
    </div>
    <!-- Header: END -->
    <div class="card">
        <div class="card-header">
            <h2>Course <small>Sorted by date updated</small></h2>
        </div>
        <!-- List: START -->
        @if(count($course_list) > 0)
            <table id="data-table" class="table table-striped table-vmiddle">
                <thead>
                    <tr>
                        <th data-column-id="course_id" data-type="numeric">ID</th>
                        <th data-column-id="name" > Name</th>
                        <th data-column-id="duration_months" > Duration Months</th>
                        <th data-column-id="description">Description</th>

                        @if($isSuperAdmin)
                            <th data-column-id="created_at" data-order="desc">Created at</th>
                            <th data-column-id="updated_at">Updated At</th>
                        @endif
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($course_list as $course_row)
                    <tr class="course-row">
                        <td>{{$course_row->id}}</td>
                        <td>{{$course_row->name}}</td>
                        <td>{{$course_row->duration_months}}</td>
                        <td>{{$course_row->description}}</td>

                        @if($isSuperAdmin)
                            <td>{{$course_row->created_at}}</td>
                            <td>{{$course_row->updated_at}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="card-body card-padding text-center">
                <h3>
                    <i class="zmdi zmdi-alert-triangle"></i> No course in the system
                </h3>
            </div>
        @endif
        <!-- List: END -->
    </div>
</div>