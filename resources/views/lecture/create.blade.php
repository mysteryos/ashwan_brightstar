<div class="container">
    <div class="block-header">
        <h2>Lecture - Create Lecture</h2>
    </div>
    <div class="card">
        <form class="form-horizontal" method="POST" action="{{action('LectureController@postCreate')}}" id="lecture_create_form">
            {{csrf_field()}}
            <div class="card-body card-padding">
                <h3><i class="zmdi zmdi-account m-r-5"></i> Info</h3>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">Name*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input autofocus name="name" type="text" placeholder="Name" id="inputName" class="form-control input-sm" value="{{old('name')}}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputCourseId">Course*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <div class="select">
                                <select name="course_id" class="form-control" id="inputCourseId">
                                    <option disabled @if(!old('course_id',null)){{"selected"}}@endif>Select a course</option>
                                    @foreach($course_list as $course_row)
                                        <option value="{{$course_row->id}}" @if(old('course_id') === $course_row->id){{"selected"}}@endif>{{$course_row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputDescription">Description*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <textarea name="description" id="inputDescription">{{old('description')}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="row">
                            <button class="btn col-xs-offset-1 col-xs-3 btn-primary" type="submit">Create</button>
                            <button class="btn col-xs-offset-2 col-xs-3 btn-default" type="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>