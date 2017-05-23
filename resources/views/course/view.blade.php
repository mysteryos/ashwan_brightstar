<div class="container">

    @include('course.view-header')

    <div class="card" id="profile-main">
        @include('course.view-overview')
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                <li class="active waves-effect"><a href="{{action('CourseController@getView',['student_id'=>$course->id])}}">About</a></li>
                <li class="waves-effect"><a href="{{action('CourseController@getViewStudent',['student_id'=>$course->id])}}">Students</a></li>
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
                    <form action="{{action('CourseController@postUpdate')}}" method="post" name="course_basic_info_form" id="course_basic_info_form">
                        <input type="hidden" name="id" value="{{$course->id}}" />
                        {{csrf_field()}}
                        <div class="pmbb-view">
                            <dl class="dl-horizontal">
                                <dt>Name*</dt>
                                <dd>{{$course->name}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Start Date*</dt>
                                <dd>@if($course->start_date){{$course->start_date->format('Y-m-d')}}@endif</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Course*</dt>
                                <dd>@if($course->course)<a href="{{action('CourseController@getView',$course->course->id)}}">{{$course->course->name}}</a>@endif</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>lecture*</dt>
                                <dd>
                                    @if($course->lecture)
                                        <a href="{{action('lectureController@getView',$course->lecture->id)}}" target="_blank">{{$course->lecture->name}}</a>
                                    @endif
                                </dd>
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
                                <dt class="p-t-10 form-label">Start Date</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Start Date" name="start_date" id="inputStartDate" value="{{$course->start_date->format('Y-m-d')}}" />
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Course</dt>
                                <dd>
                                    <div class="fg-line">
                                        <div class="select">
                                            <select name="course_id" class="form-control" id="inputCourseId">
                                                @foreach($course_list as $course_row)
                                                    <option value="{{$course_row->id}}" @if(old('course_id') === $course_row->id || $course->course_id === $course_row->id){{"selected"}}@endif>{{$course_row->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">lecture</dt>
                                <dd>
                                    <div class="fg-line">
                                        <div class="select">
                                            <select name="lecture_id" class="form-control" id="inputlectureId">
                                                @foreach($lecture_list as $lecture_row)
                                                    <option value="{{$lecture_row->id}}" @if(old('lecture_id') === $lecture_row->id ||  $course->lecture_id === $lecture_row->id){{"selected"}}@endif>{{$lecture_row->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
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