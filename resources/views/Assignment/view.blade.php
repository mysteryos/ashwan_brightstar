<div class="container">

    @include('assignment.view-header')

    <div class="card" id="profile-main">
        @include('assignment.view-overview')
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                <li class="active waves-effect"><a href="{{action('AssignmentController@getView',['assignment_id'=>$assignment->id])}}">About</a></li>
                <li class="waves-effect"><a href="{{action('AssignmentController@getViewSubmission',['assignment_id'=>$assignment->id])}}">Submissions</a></li>
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
                    <form action="{{action('AssignmentController@postUpdate')}}" method="post" name="assignment_info_form" id="assignment_info_form">
                        <input type="hidden" name="id" value="{{$assignment->id}}" />
                        {{csrf_field()}}
                        <div class="pmbb-view">
                            <dl class="dl-horizontal">
                                <dt>ID</dt>
                                <dd>{{$assignment->id}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Name</dt>
                                <dd>{{$assignment->name}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Description</dt>
                                <dd>{{$assignment->description}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Submission date</dt>
                                <dd>@if($assignment->submission_date){{$assignment->submission_date->format('Y-m-d')}}@endif</dd>
                            </dl>

                        </div>

                        <div class="pmbb-edit">
                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">ID</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="ID" name="ID" value="{{$assignment->id}}">
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Name</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{$assignment->name}}">
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Description</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Description" name="description" value="{{$assignment->description}}">
                                    </div>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt class="p-t-10 form-label">Submission Date</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" placeholder="Submission Date" name="submission_date" value="{{$assignment->submission_date}}">
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
            @if($assignment->isActive() && $isStudent)
                <div class="pmb-block">
                    <div class="pmbb-header">
                        <h2><i class="zmdi zmdi-upload m-r-5"></i> @if(!$hasSubmitted)Submit your assignment:@else You have already submitted your assigment: @endif</h2>
                    </div>
                    <div class="pmbb-body p-l-30">
                        <form class="form-horizontal" action="{{action('AssignmentController@postUpload')}}" method="post" name="assignment_upload_form" id="assignment_upload_form" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$assignment->id}}" />
                            {{csrf_field()}}
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-primary btn-file m-r-10 waves-effect">
                                    <span class="fileinput-new">Select file</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="hidden" value="" name="..."><input type="file" name="file" id="assignmentUploadFile">
                                </span>
                                <span class="fileinput-filename"></span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput">×</a>
                            </div>
                            <button class="btn btn-success m-l-10" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>