<div class="container">
    <div class="block-header">
        <h2>@if($quiz->lecture){{$quiz->lecture->name}} - @endif{{$quiz->name}}</h2>
    </div>

    @if(count($quiz->question))
        <form action="{{action('QuizController@postStudentResult')}}" method="post" id="quiz-form">
            {{ csrf_field() }}
            <input type="hidden" name="quiz_id" value="{{\Crypt::encrypt($quiz->id)}}" />
            @foreach($quiz->question as $key => $question)
                <input type="hidden" name="question[{{$key}}][id]" value="{{$question->id}}" />
                <div class="card">
                    <div class="card-header">
                        {{$key+1}}. {{$question->description}}
                    </div>
                    <div class="card-body card-padding answer-container">
                        @foreach($question->answer as $answer)
                            <div class="radio m-b-15">
                                <label>
                                    <input type="radio" name="question[{{$key}}][answer_id]" value="{{$answer->id}}">
                                    <i class="input-helper"></i>
                                    {{$answer->description}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="row">
                        <button class="btn col-xs-offset-1 col-xs-3 btn-primary" type="submit">Submit</button>
                        <button class="btn col-xs-offset-2 col-xs-3 btn-default" type="reset">Reset</button>
                    </div>
                </div>
            </div>
        </form>
    @else
        <h2 class="text-center">
            No questions present in this quiz
        </h2>
    @endif
</div>