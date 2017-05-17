
<div class="container">
    <!-- Header: START -->
    <div class="block-header">
        <h2 class="pull-left">Batch - List</h2>
        <div class="pull-right">
            @if($can_create_batch)
                <a href="{{action('BatchController@getCreate')}}" class="btn btn-link">
                    <i class="zmdi zmdi-plus"></i> Create
                </a>
            @endif
        </div>
    </div>
    <!-- Header: END -->
    <div class="card">
        <div class="card-header">
            <h2>Batch <small>Sorted by date updated</small></h2>
        </div>
        <!-- List: START -->
        @if(count($batch_list) > 0)
            <table id="data-table" class="table table-striped table-vmiddle">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="name" >Name</th>
                        <th data-column-id="course">Course</th>
                        <th data-column-id="start_date">Start Date</th>

                        @if($isSuperAdmin)
                            <th data-column-id="created_at" data-order="desc">Created at</th>
                            <th data-column-id="updated_at">Updated At</th>
                        @endif
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($batch_list as $batch_row)
                    <tr class="batch-row">
                        <td>{{$batch_row->id}}</td>
                        <td>{{$batch_row->name}}</td>
                        <td>@if($batch_row->course){{$batch_row->course->name}}@endif</td>
                        <td>{{$batch_row->start_date}}</td>

                        @if($isSuperAdmin)
                            <td>{{$batch_row->created_at}}</td>
                            <td>{{$batch_row->updated_at}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="card-body card-padding text-center">
                <h3>
                    <i class="zmdi zmdi-alert-triangle"></i> No batch in the system
                </h3>
            </div>
        @endif
        <!-- List: END -->
    </div>
</div>