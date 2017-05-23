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
                    @if($hasUpdateAccess)
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
                    @endif
                </div>
                <div class="pmbb-body p-l-30">
                    <form action="{{action('LectureController@postUpdate')}}" method="post" name="lecture_info_form" id="lecture_info_form">
                        <input type="hidden" name="id" value="{{$lecture->id}}" />
                        {{csrf_field()}}
                        <div class="pmbb-view">
                            <dl class="dl-horizontal">
                                <dt>Name</dt>
                                <dd>{{$lecture->name}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Course</dt>
                                <dd>@if($lecture->course)<a href="{{action('CourseController@getView',['course_id'=>$lecture->course->id])}}" target="_blank">{{$lecture->course->name}}</a>@endif</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Quiz</dt>
                                <dd>
                                    @if($lecture->quiz)
                                        @foreach($lecture->quiz as $quiz)
                                            <a href='{{action('QuizController@getViewStudent',['quiz_id'=>$quiz->id])}}' target='_blank' class="m-r-10">{{$quiz->name}}</a>
                                        @endforeach
                                    @endif
                                </dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Description</dt>
                                <dd>{!! $lecture->description !!}</dd>
                            </dl>
                        </div>
                        @if($hasUpdateAccess)
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
                                    <dt class="p-t-10 form-label">Course</dt>
                                    <dd>
                                        <div class="fg-line">
                                            <div class="select">
                                                <select name="course_id" class="form-control" id="inputCourseId">
                                                    @foreach($course_list as $course_row)
                                                        <option value="{{$course_row->id}}" @if(old('course_id') === $course_row->id || $lecture->course_id === $course_row->id){{"selected"}}@endif>{{$course_row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </dd>
                                </dl>

                                <dl class="dl-horizontal">
                                    <dt class="p-t-10 form-label">Description</dt>
                                    <dd>
                                        <div class="fg-line">
                                            <textarea name="description" id="inputDescription">{{$lecture->description}}</textarea>
                                        </div>
                                    </dd>
                                </dl>

                                <div class="m-t-30">
                                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                    <button data-pmb-action="reset" class="btn btn-link btn-sm" type="reset">Cancel</button>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>