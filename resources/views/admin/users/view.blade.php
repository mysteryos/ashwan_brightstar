<div class="container">

    @include('admin.users.view-header')

    <div class="card" id="profile-main">
        @include('admin.users.view-overview')
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                <li class="active waves-effect"><a href="{{action('Admin\UsersController@getView',['user_id'=>$user->id])}}">About</a></li>
                <li class="waves-effect"><a href="{{action('Admin\UsersController@getUserPermissions',['user_id'=>$user->id])}}">Roles/Permissions</a></li>
                <li class="waves-effect"><a href="profile-photos.html">Photos</a></li>
                <li class="waves-effect"><a href="profile-connections.html">Connections</a></li>
            </ul>

            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-account m-r-5"></i> Basic Information</h2>

                    <ul class="actions">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a data-pmb-action="edit" href="">Edit</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="pmbb-body p-l-30">
                    <form action="{{action('Admin\UsersController@postSaveUser')}}" method="post" name="user_basic_info_form" id="user_basic_info_form">
                        <input type="hidden" name="id" value="{{\Crypt::encrypt($user->id)}}" />
                        {{csrf_field()}}
                        <div class="pmbb-view">
                            <dl class="dl-horizontal">
                                <dt>First Name</dt>
                                <dd>{{$user->first_name}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Last Name</dt>
                                <dd>{{$user->last_name}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Email</dt>
                                <dd>{{$user->email}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Password</dt>
                                <dd>********</dd>
                            </dl>
                        </div>

                        <div class="pmbb-edit">
                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">First Name</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{$user->first_name}}">
                                    </div>
                                </dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Last Name</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{$user->last_name}}">
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Email</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Email" name="email" value="{{$user->email}}">
                                    </div>
                                </dd>
                            </dl>

                            @if($isSuperAdmin)
                                <dl class="dl-horizontal">
                                    <dt class="p-t-10 form-label">Password</dt>
                                    <dd>
                                        <div class="fg-line">
                                            <input type="password" class="form-control" placeholder="Password" name="password" value="" id="input_password">
                                        </div>
                                    </dd>
                                </dl>

                                <dl class="dl-horizontal">
                                    <dt class="p-t-10 form-label">Confirm Password</dt>
                                    <dd>
                                        <div class="fg-line">
                                            <input type="password" class="form-control" placeholder="Confirm password" name="password_confirm" value="">
                                        </div>
                                    </dd>
                                </dl>
                            @endif

                            <div class="m-t-30">
                                <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                <button data-pmb-action="reset" class="btn btn-link btn-sm" type="reset">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>