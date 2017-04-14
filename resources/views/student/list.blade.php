<div class="container">
    <!-- Header: START -->
    <div class="block-header">
        <h2 class="pull-left">Student - List</h2>
        <div class="pull-right">
            @if($can_create_student)
                <a href="{{action('StudentController@getCreate')}}" class="btn btn-link">
                    <i class="zmdi zmdi-plus"></i> Create
                </a>
            @endif
        </div>
    </div>
    <!-- Header: END -->
    <div class="card">
        <div class="card-header">
            <h2>Students <small>Sorted by date updated</small></h2>
        </div>
        <!-- List: START -->
        @if(count($student_list) > 0)
            <table id="data-table" class="table table-striped table-vmiddle">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="first_name" >First Name</th>
                        <th data-column-id="last_name">Last Name</th>
                        <th data-column-id="email">Email</th>
                        <th data-column-id="mobile_number">Mobile Number</th>
                        @if($isSuperAdmin)
                            <th data-column-id="created_at" data-order="desc">Created at</th>
                            <th data-column-id="updated_at">Updated At</th>
                        @endif
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($student_list as $student_row)
                    <tr class="student-row">
                        <td>{{$student_row->id}}</td>
                        <td>{{$student_row->first_name}}</td>
                        <td>{{$student_row->last_name}}</td>
                        <td>{{$student_row->email}}</td>
                        <td>{{$student_row->mobile_number}}</td>
                        @if($isSuperAdmin)
                            <td>{{$student_row->created_at}}</td>
                            <td>{{$student_row->updated_at}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="card-body card-padding text-center">
                <h3>
                    <i class="zmdi zmdi-alert-triangle"></i> No students in the system
                </h3>
            </div>
        @endif
        <!-- List: END -->
    </div>
</div>