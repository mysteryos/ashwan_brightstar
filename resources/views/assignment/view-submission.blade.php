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
                <div class="pmbb-body p-l-30">

                </div>
            </div>
        </div>
    </div>
</div>