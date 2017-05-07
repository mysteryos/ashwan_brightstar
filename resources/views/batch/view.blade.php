<div class="container">

    @include('batch.view-header')

    <div class="card" id="profile-main">
        @include('batch.view-overview')
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                <li class="active waves-effect"><a href="{{action('BatchController@getView',['student_id'=>$batch->id])}}">About</a></li>
                <li class="waves-effect"><a href="{{action('BatchController@getViewStudent',['student_id'=>$batch->id])}}">Students</a></li>
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
                    <form action="{{action('BatchController@postUpdate')}}" method="post" name="batch_basic_info_form" id="batch_basic_info_form">
                        <input type="hidden" name="id" value="{{$batch->id}}" />
                        {{csrf_field()}}
                        <div class="pmbb-view">
                            <dl class="dl-horizontal">
                                <dt>Name*</dt>
                                <dd>{{$batch->name}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Start Date*</dt>
                                <dd>@if($batch->start_date){{$batch->start_date->format('Y-m-d')}}@endif</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Course*</dt>
                                <dd>@if($batch->course)<a href="{{action('CourseController@getView',$batch->course->id)}}">{{$batch->course->name}}</a>@endif</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Lecturer*</dt>
                                <dd>
                                    @if($batch->lecturer)
                                        <a href="{{action('LecturerController@getView',$batch->lecturer->id)}}" target="_blank">{{$batch->lecturer->name}}</a>
                                    @endif
                                </dd>
                            </dl>
                        </div>

                        <div class="pmbb-edit">
                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Name</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{$batch->name}}" />
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Start Date</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Start Date" name="start_date" id="inputStartDate" value="{{$batch->start_date->format('Y-m-d')}}" />
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
                                                    <option value="{{$course_row->id}}" @if(old('course_id') === $course_row->id || $batch->course_id === $course_row->id){{"selected"}}@endif>{{$course_row->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Lecturer</dt>
                                <dd>
                                    <div class="fg-line">
                                        <div class="select">
                                            <select name="lecturer_id" class="form-control" id="inputLecturerId">
                                                @foreach($lecturer_list as $lecturer_row)
                                                    <option value="{{$lecturer_row->id}}" @if(old('lecturer_id') === $lecturer_row->id ||  $batch->lecturer_id === $lecturer_row->id){{"selected"}}@endif>{{$lecturer_row->name}}</option>
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