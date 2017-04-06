<div class="container">

    @include('admin.users.view-header')

    <div class="card" id="profile-main">
        @include('admin.users.view-overview')
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                <li class="waves-effect"><a href="{{action('Admin\UsersController@getView',['user_id'=>$user->id])}}">About</a></li>
                <li class="waves-effect active"><a href="{{action('Admin\UsersController@getUserPermissions',['user_id'=>$user->id])}}">Roles/Permissions</a></li>
                <li class="waves-effect"><a href="profile-photos.html">Photos</a></li>
                <li class="waves-effect"><a href="profile-connections.html">Connections</a></li>
            </ul>

            <div class="pmb-block">
                <!-- Permissions Card: START -->
                <div class="card">
                    <div class="card-header">
                        <h2>Permissions</h2>
                    </div>
                    <div class="card-body card-padding">
                        @if($isSuperAdmin)
                            <div class="row">
                                <form method="POST" action="{{action('Admin\UsersController@postAddUserPermission')}}" name="add_permission_form" id="add_permission_form">
                                    {{csrf_field()}}
                                    <input type="hidden" name="user_id" value="{{\Crypt::encrypt($user->id)}}" />
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <div class="select">
                                                    <select name="permission_slug" class="form-control">
                                                        <option value="" disabled selected>Select a permission</option>
                                                        @foreach($permissions_list as $perf_row)
                                                            <option value="{{$perf_row->slug}}">{{$perf_row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <div class="select">
                                                    <select name="permission_value" class="form-control">
                                                        <option value="1" selected>Allow</option>
                                                        <option value="0">Deny</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <input type="submit" name="submit" class="btn btn-block btn-xs" value="Add Permission" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                        @if(count($user_permissions))
                            <table id="permission-table" class="table table-striped table-vmiddle">
                                <thead>
                                    <tr>
                                        <th data-column-id="id" data-type="numeric">id</th>
                                        <th data-column-id="name">Name</th>
                                        <th data-column-id="slug">Value</th>
                                        <th data-column-id="commands">Commands</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $perf_count = 1 ?>
                                    @foreach($user_permissions as $perm_key => $perm_val)
                                        <tr>
                                            <td>{{$perf_count}}.</td>
                                            <td>{{$perm_key}}</td>
                                            <td>@if($perm_val){{"Allow"}}@else{{"Deny"}}@endif</td>
                                            <td>
                                                <form method="POST" action="{{action('Admin\UsersController@postRemoveUserPermission')}}" class="delete_permission_form">
                                                    <input type="hidden" value="{{\Crypt::encrypt($user->id)}}" name="user_id" />
                                                    <input type="hidden" value="{{$perm_key}}" name="permission_slug" class="delete_permission_slug" />
                                                    {{csrf_field()}}
                                                    <button class="btn btn-icon command-permission-delete"><span class="zmdi zmdi-delete"></span></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $perf_count++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center h4">No permissions assigned to user.</p>
                        @endif
                    </div>
                </div>
                <!-- Permissions Card: END -->

                <!-- Roles Card: START -->
                <div class="card">
                    <div class="card-header">
                        <h2>Roles</h2>
                    </div>
                    <div class="card-body card-padding">
                        <div class="row">
                            <form action="{{action('Admin\UsersController@postAddUserRole')}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="user_id" value="{{\Crypt::encrypt($user->id)}}" />
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="fg-line">
                                            <div class="select">
                                                <select name="role_slug" class="form-control">
                                                    <option value="" disabled selected>Select a role</option>
                                                    @foreach($roles_list as $role_row)
                                                        <option value="{{$role_row->slug}}">{{$role_row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="fg-line">
                                            <input type="submit" name="submit" class="btn btn-block btn-xs" value="Add Role" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if(count($user_roles))
                            <table id="permission-table" class="table table-striped table-vmiddle">
                                <thead>
                                    <tr>
                                        <th data-column-id="id" data-type="numeric">id</th>
                                        <th data-column-id="name">Name</th>
                                        <th data-column-id="permissions">Permissions</th>
                                        <th data-column-id="commands">Commands</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $role_count = 1 ?>
                                    @foreach($user_roles as $user_role_row)
                                        <tr>
                                            <td>{{$role_count}}.</td>
                                            <td>{{$user_role_row->name}}</td>
                                            <td><?php
                                                echo implode(",",array_map(function($key,$val){
                                                    return $key." : ".($val? "true":"false");
                                                },array_keys($user_role_row->permissions),$user_role_row->permissions));
                                                ?>
                                            </td>
                                            <td>
                                                <form method="POST" action="{{action('Admin\UsersController@postRemoveUserRole')}}" class="delete_role_form">
                                                    <input type="hidden" value="{{\Crypt::encrypt($user->id)}}" name="user_id" />
                                                    <input type="hidden" value="{{$user_role_row->slug}}" name="role_slug" class="delete_role_slug" />
                                                    {{csrf_field()}}
                                                    <button class="btn btn-icon command-role-delete"><span class="zmdi zmdi-delete"></span></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $role_count++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center h3">No roles assigned to user.</p>
                        @endif
                    </div>
                </div>
                <!-- Roles Card: END -->
            </div>
        </div>
    </div>
</div>