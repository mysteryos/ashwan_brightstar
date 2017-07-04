<div class="container">

    @include('course.view-header')

    <div class="card" id="profile-main">
        @include('course.view-overview')
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                <li class="active waves-effect"><a href="{{action('CourseController@getView',['student_id'=>$course->id])}}">About</a></li>
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
                    <form action="{{action('CourseController@postUpdate')}}" method="POST" name="course_basic_info_form" id="course_basic_info_form">
                        <input type="hidden" name="id" value="{{$course->id}}" />
                        {{csrf_field()}}
                        <div class="pmbb-view">
                            <dl class="dl-horizontal">
                                <dt>Name*</dt>
                                <dd>{{$course->name}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Duration(months)*</dt>
                                <dd>{{$course->duration_months}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Description*</dt>
                                <dd>{{$course->description}}</dd>
                            </dl>
                        </div>

                        <div class="pmbb-edit">
                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Name</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{$course->name}}" />
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Duration(months)*</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Duration(months)" name="duration_months" value="{{$course->duration_months}}" />
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Description*</dt>
                                <dd>
                                    <div class="fg-line">
                                        <textarea class="form-control" name="description">{{$course->description}}</textarea>
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