<div class="container">
    <div class="block-header">
        <h2>Assignment - Create Assignment</h2>
    </div>
    <div class="card">
        <form class="form-horizontal" method="POST" action="{{action('AssignmentController@postCreate')}}" id="assignment_create_form">
            {{csrf_field()}}
            <div class="card-body card-padding">
                <h3><i class="zmdi zmdi-account m-r-5"></i>  Info</h3>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">ID*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input name="id" type="text" placeholder="ID" id="inputName" class="form-control input-sm" value="{{old('id')}}">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">Name*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input name="name" type="text" placeholder="Name" id="inputName" class="form-control input-sm" value="{{old('name')}}">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">LectureID*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input name="ID" type="text" placeholder="Lecture_ID" id="inputLectureID" class="form-control input-sm" value="{{old('lecture_id')}}">
                        </div>
                    </div>
                </div>







                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputDescription">Description*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input name="description" type="text" placeholder="Description" id="inputDescription" class="form-control input-sm" value="{{old('description')}}">
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
                    <label class="col-sm-2 control-label" for="inputAssignmentId">Assignment*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <div class="select">
                                <select name="assignment_id" class="form-control" id="inputAssignmentId">
                                    <option disabled @if(!old('assignment_id',null)){{"selected"}}@endif> assignment details </option>
                                    @foreach($assignment_list as $assignment_row)
                                        <option value="{{$assignment_row->id}}" @if(old('assignment_id') === $assignment_row->id){{"selected"}}@endif>{{$assignment_row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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