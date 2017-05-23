<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 5/20/2017
 * Time: 11:14 AM
 */

namespace App\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    use VendorLibraries;

    protected $policy = '\App\Policies\Controllers\QuizControllerPolicy';

    /**
     * GET: Student view to attempt quiz
     *
     * @param $quiz_id
     * @return \Illuminate\View\View
     */
    public function getViewStudent($quiz_id)
    {
        $quiz = \App\Models\Quiz::with([                                                                
            'question'=>function($q) {
                return $q->orderBy('id');
            },
            'question.answer',
            'lecture'
        ])->findOrFail($quiz_id);

        $this->verifyAccess($quiz);

        $this->data['quiz'] = $quiz;
        $this->data['pageTitle'] = "Quiz - {$quiz->name}";

        //Assets
        $this->addJqueryValidate();
        $this->addJs('/js/el/quiz.view_student.js');
        $this->addCss('/css/el/quiz.view_student.css');

        return $this->renderView('quiz.view-student');
    }

    /**
     * Save student's result
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postStudentResult(Request $request)
    {
        $quiz = \App\Models\Quiz::with('question','question.correctAnswer')->findOrFail(\Crypt::decrypt($request->input('quiz_id')));

        $this->verifyAccess($quiz);

        if($request->has('question')) {
            $this->user->load('student');
            $student = $this->user->student;

            $totalQuestions = count($quiz->question);
            $totalGoodAnswers = 0;
            $quizStudentResult = new \App\Models\QuizStudentResult([
                'student_id' => $student->id,
                'quiz_id' => $quiz->id
            ]);

            $quizStudentResult->save();

            foreach($request->input('question') as $question) {
                $answer = \App\Models\QuizAnswer::findOrFail($question['answer_id']);
                $questionFromDb = $quiz->question->first(function($key, $row) use ($question) {
                    return $row->id === (int)$question['id'];
                });

                if($questionFromDb) {
                    $studentResultAnswer = new \App\Models\QuizStudentResultAnswer([
                        'answer_id' => $answer->id,
                        'question_id' => $questionFromDb->id,
                        'student_result_id' => $quizStudentResult->id
                    ]);

                    $studentResultAnswer->save();

                    if($questionFromDb->correctAnswer && $questionFromDb->correctAnswer->id === $answer->id) {
                        $totalGoodAnswers++;
                    }
                } else {
                    return redirect()->back()->withErrors([
                        "No question with ID {$question['id']} in this quiz"
                    ]);
                }
            }

            $quizStudentResult->progress = $totalGoodAnswers;
            $quizStudentResult->save();

            return redirect()->action('QuizController@getViewStudentResult',['result_id'=>$quizStudentResult->id]);
        } else {
            return redirect()->back()->withErrors([
                'No questions have been answered'
            ]);
        }
    }

    /**
     * GET: View student's result
     *
     * @param $student_result_id
     * @return \Illuminate\View\View
     */
    public function getViewStudentResult($student_result_id)
    {
        $studentResult = \App\Models\QuizStudentResult::with([
            'studentAnswer',
            'studentAnswer.answer',
            'studentAnswer.question.correctAnswer',
            'studentAnswer.question',
            'quiz',
            'quiz.lecture',
            'quiz.question'
        ])->findOrFail($student_result_id);

        $this->verifyAccess($studentResult);

        $this->data['studentResult'] = $studentResult;
        $this->data['pageTitle'] = 'Quiz - View Result - '.$studentResult->quiz->name;
        $this->data['studentProgress'] = $studentResult->progress === 0 ? $studentResult->progress : ($studentResult->progress/count($studentResult->quiz->question))*100;

        return $this->renderView('quiz.view-student-result');
    }

    /**
     * GET: List of quizzes
     *
     * @return \Illuminate\View\View
     */
    public function getList()
    {
        $this->verifyAccess();
        $this->data['isStudent'] = $this->studentService->isStudent($this->user);
        $this->data['pageTitle'] = 'Quiz - List';
        //Is student
        if($this->data['isStudent']) {
            //Filter list of quiz
            $this->data['quiz_list'] = \App\Models\Quiz::with(['lecture','result'=>function($q){
                                            return $q->whereHas('student',function($q) {
                                                return $q->whereHas('user', function($q) {
                                                    return $q->where('id','=',$this->user->id);
                                                });
                                            });
                                        }])
                                        ->orderBy('updated_at','DESC')
                                        ->whereHas('lecture', function($q) {
                                            return $q->whereHas('course', function($q) {
                                                return $q->whereHas('batch', function($q) {
                                                    return $q->whereHas('student', function($q) {
                                                        return $q->whereHas('user', function($q) {
                                                            return $q->where('id','=',$this->user->id);
                                                        });
                                                    });
                                                });
                                            });
                                        })
                                        ->get();
        } else {
            //Show all quiz to date
            $this->data['quiz_list'] = \App\Models\Quiz::with('lecture')->orderBy('updated_at','DESC')->get();
        }

        //Assets
        $this->addjQueryBootgrid();

        $this->addJs('/js/el/quiz.list.js');

        return $this->renderView('quiz.list');
    }

}