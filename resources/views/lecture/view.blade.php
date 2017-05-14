<div class="container">

    @include('lecture.view-header')

    <div class="card" id="profile-main">
        @include('lecture.view-overview')
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                <li class="active waves-effect"><a href="{{action('LectureController@getView',['lecture_id'=>$lecture->id])}}">About</a></li>
            </ul>

            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-account m-r-5"></i> Information</h2>

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
                    <form action="{{action('LectureController@postUpdate')}}" method="post" name="lecture_info_form" id="lecture_info_form">
                        <input type="hidden" name="id" value="{{$lecture->id}}" />
                        {{csrf_field()}}
                            <dl class="dl-horizontal">
                                <dt>Name</dt>
                                <dd>{{$lecture->name}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Description</dt>
                                <dd>{{$lecture->description}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Course</dt>
                                <dd>@if($lecture->course){{$lecture->course->name}}@endif</dd>
                            </dl>
                        </div>

                        <div class="pmbb-edit">
                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Name</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{$lecture->name}}">
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Description</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Description" name="description" value="{{$lecture->description}}">
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">CourseID</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="CourseID" name="course_id" value="{{$lecture->course_id}}">
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