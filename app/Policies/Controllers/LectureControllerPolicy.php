<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 18:48
 */

namespace App\Policies\Controllers;


class LectureControllerPolicy extends BaseControllerPolicy
{
    public function __construct($user)
    {
        parent::__construct($user);
        $this->lecturerService = app('App\Services\Lecturer');
        $this->studentService = app('App\Services\Student');
    }

    protected function getCreate()
    {
        return $this->user->hasAccess('lecture.create');
    }

    protected function postCreate()
    {
        return $this->user->hasAccess('lecture.create');
    }
    protected function postUpdate()
    {
        return $this->user->hasAccess('lecture.update');
    }

    protected function getView(\App\Models\Lecture $lecture)
    {
        $studentCanView = false;
        $this->user->load('student');
        //Is Student
        if($this->studentService->isStudent($this->user)) {
            //Fetch student id
            $student_id = $this->user->student->id;

            $studentCanView = \App\Models\Lecture::orderBy('updated_at', 'DESC')
                                ->whereHas('course',function($q) use($student_id){
                                    return $q->whereHas('batch', function($q) use($student_id) {
                                        return $q->whereHas('student', function($q) use ($student_id) {
                                            return $q->where('student_id','=',$student_id);
                                        });
                                    });
                                })
                                ->where('id','=',$lecture->id)
                                ->count() > 0;
        }

        //Is Lecturer | Has Permission | Student Can View
        return $this->user->hasAccess('lecture.view') || $this->lecturerService->isLecturer($this->user) || $studentCanView;
    }

    protected function getList()
    {
        return $this->user->hasAccess('lecture.list.view') || $this->lecturerService->isLecturer($this->user);
    }
}

