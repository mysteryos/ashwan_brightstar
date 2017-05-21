<div class="container">
    <div class="block-header">
        <h2>@if($studentResult->quiz && $studentResult->quiz->lecture){{$studentResult->quiz->lecture->name}} - @endif @if($studentResult->quiz){{$studentResult->quiz->name}}@endif</h2>
    </div>

    <div class="card">
        <div class="card-header">
            Overview
        </div>
        <div class="card-body card-padding">
            <div class="row">
                <div class="col-xs-12">
                    <div class="progress m-b-10">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$studentProgress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$studentProgress."%"}} "></div>
                    </div>
                    <h3>
                        @if($studentProgress === 100){{'Congratulations! '}}@endif You have answered {{$studentResult->progress}} out of {{count($studentResult->quiz->question)}}  questions correctly.
                    </h3>
                </div>
            </div>
            @if($studentProgress < 100)
                <div class="row m-t-20">
                    <div class="col-xs-12 text-center">
                        <a class="btn btn-primary btn-lg" href="{{action('QuizController@getViewStudent',['quiz_id'=>$studentResult->quiz->id])}}">Give it another shot!</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Results
        </div>
        <div class="card-body card-padding">
            @foreach($studentResult->studentAnswer as $key => $studentAnswer)
                <div class="row">
                    <div class="col-xs-12">
                        @if($studentAnswer->question->correctAnswer->id === $studentAnswer->answer->id)
                            <i class="zmdi zmdi-check-circle c-green m-r-10"></i>
                        @else
                            <i class="zmdi zmdi-close-circle c-red m-r-10"></i>
                        @endif
                            {{($key+1).". "}}{{$studentAnswer->question->description}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>