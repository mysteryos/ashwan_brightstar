<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 5/20/2017
 * Time: 11:16 AM
 */

namespace App\Policies\Controllers;


class QuizControllerPolicy extends BaseControllerPolicy
{
    public function __construct($user)
    {
        parent::__construct($user);
        $this->lecturerService = app('App\Services\Lecturer');
        $this->studentService = app('App\Services\Student');
        $this->permissionService = app('App\Services\Permission');
    }

    protected function getViewStudent(\App\Models\Quiz $quiz)
    {
        if($this->studentService->isStudent($this->user)) {
            return $quiz->lecture->whereHas('course', function($q) {
                    return $q->whereHas('batch', function($q) {
                        return $q->whereHas('student', function($q) {
                            return $q->whereHas('user', function($q) {
                                return $q->where('id','=',$this->user->id);
                            });
                        });
                    });
                })->count() > 0;
        }

        return false;
    }

    protected function getList()
    {
        return $this->user->hasAccess('quiz.list.view');
    }

    protected function postStudentResult(\App\Models\Quiz $quiz)
    {
        return $this->getViewStudent($quiz);
    }

    protected function getViewStudentResult(\App\Models\QuizStudentResult $quizStudentResult)
    {
        if($this->studentService->isStudent($this->user)) {
            $this->user->load('student');

            if($this->user->student && $quizStudentResult->student_id === $this->user->student->id) {
                return true;
            } else {
                return false;
            }
        }

        return $this->user->hasAccess('quiz.result.view');
    }
}