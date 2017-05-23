<div class="container">

    @include('lecturer.view-header')

    <div class="card" id="profile-main">
        @include('lecturer.view-overview')
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                <li class="active waves-effect"><a href="{{action('LecturerController@getView',['lecturer_id'=>$lecturer->id])}}">About</a></li>
                {{--<li class="waves-effect"><a href="{{action('LecturerController@getViewBatch',['lecturer_id'=>$lecturer->id])}}">Batch</a></li>--}}
            </ul>

            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-account m-r-5"></i> Personal Information</h2>

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
                    <form action="{{action('LecturerController@postUpdate')}}" method="post" name="lecturer_personal_info_form" id="lecturer_personal_info_form">
                        <input type="hidden" name="id" value="{{$lecturer->id}}" />
                        {{csrf_field()}}
                        <div class="pmbb-view">
                            <dl class="dl-horizontal">
                                <dt>First Name</dt>
                                <dd>{{$lecturer->first_name}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Last Name</dt>
                                <dd>{{$lecturer->last_name}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Email</dt>
                                <dd>{{$lecturer->email}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Mobile Number</dt>
                                <dd>{{$lecturer->mobile_number}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Address</dt>
                                <dd>{{$lecturer->address}}</dd>
                            </dl>
                        </div>

                        <div class="pmbb-edit">
                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">First Name</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{$lecturer->first_name}}">
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Last Name</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{$lecturer->last_name}}">
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Email</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Email" name="email" value="{{$lecturer->email}}">
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Mobile Number</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" value="{{$lecturer->mobile_number}}">
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Address</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Address" name="address" value="{{$lecturer->address}}">
                                    </div>
                                </dd>
                            </dl>

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