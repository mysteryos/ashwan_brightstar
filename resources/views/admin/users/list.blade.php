<div class="container">
    <div class="block-header">
        <h2>Users - List</h2>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Users <small>Sorted by date registered</small></h2>
        </div>

        <table id="data-table" class="table table-striped table-vmiddle">
            <thead>
                <tr>
                    <th data-column-id="id" data-type="numeric">ID</th>
                    <th data-column-id="email">Email</th>
                    <th data-column-id="first_name" >First Name</th>
                    <th data-column-id="last_name">Last Name</th>
                    <th data-column-id="created_at" data-order="desc">Registered at</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $list_item)
                    <tr>
                        <td>
                            {{$list_item->id}}
                        </td>
                        <td>
                            {{$list_item->email}}
                        </td>
                        <td>
                            {{$list_item->first_name}}
                        </td>
                        <td>
                            {{$list_item->last_name}}
                        </td>
                        <td>
                            {{$list_item->created_at}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>