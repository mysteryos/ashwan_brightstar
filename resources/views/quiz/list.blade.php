<div class="container">
    <!-- Header: START -->
    <div class="block-header">
        <h2 class="pull-left">Quiz - List</h2>
    </div>
    <!-- Header: END -->
    <div class="card">
        <div class="card-header">
            <h2>Quiz <small>Sorted by date updated</small></h2>
        </div>
        <!-- List: START -->
        @if(count($quiz_list) > 0)
            <table id="data-table" class="table table-striped table-vmiddle">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="name" >Name</th>
                        <th data-column-id="lecture_id" >Lecture</th>
                        @if($isStudent)
                            <th data-column-id="attempted">Attempted</th>
                        @endif
                        @if($isSuperAdmin)
                            <th data-column-id="created_at" data-order="desc">Created at</th>
                            <th data-column-id="updated_at">Updated At</th>
                        @endif
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($quiz_list as $row)
                    <tr class="quiz-row">
                        <td>{{$row->id}}</td>
                        <td>{{$row->name}}</td>
                        <td>@if($row->lecture){{$row->lecture->name}}@else{{('N/A')}}@endif</td>
                        @if($isStudent)
                            <td data-html="allow">
                                @if(count($row->result))
                                    <span class="c-green">Yes</span>
                                @else
                                    <span class="c-red">No</span>
                                @endif
                            </td>
                        @endif
                        @if($isSuperAdmin)
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->updated_at}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="card-body card-padding text-center">
                <h3>
                    <i class="zmdi zmdi-alert-triangle"></i> No quiz in the system
                </h3>
            </div>
        @endif
        <!-- List: END -->
    </div>
</div>