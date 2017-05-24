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
        //Is Student
        if($this->studentService->isStudent($this->user)) {

            $studentCanView = \App\Models\Lecture::orderBy('updated_at', 'DESC')
                                ->whereHas('course',function($q){
                                    return $q->whereHas('batch', function($q) {
                                        return $q->whereHas('student', function($q){
                                            return $q->whereHas('user', function($q){
                                                return $q->where('id','=',$this->user->id);
                                            });
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

    protected function postDelete()
    {
        return $this->user->hasAccess('lecture.delete');
    }
}

