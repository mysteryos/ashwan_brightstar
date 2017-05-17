<div class="container">
    <div class="block-header">
        <h2>Assignment - Create Assignment</h2>
    </div>
    <div class="card">
        <form class="form-horizontal" method="POST" action="{{action('AssignmentController@postCreate')}}" id="assignment_create_form">
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
                    <label class="col-sm-2 control-label" for="inputName">Lecture*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <div class="select">
                                <select name="lecture_id" class="form-control" id="inputLectureId">
                                    <option disabled @if(!old('lecture_id',null)){{"selected"}}@endif>Select a lecture</option>
                                    @foreach($lecture_list as $lecture_row)
                                        <option value="{{$lecture_row->id}}" @if(old('lecture_id') === $lecture_row->id){{"selected"}}@endif >{{$lecture_row->name}}</option>
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
                            <textarea name="description" id="inputDescription" style="min-height:500px;">{{old('description')}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputSubmissionDate">Submission Date*</label>
                    <div class="col-sm-10">
                        <div class="fg-line dtp-container">
                            <input name="submission_date" type="text" placeholder="Submission Date" id="inputSubmissionDate" class="form-control input-sm" value="{{old('submission_date')}}">
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