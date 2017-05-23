<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 18:48
 */

namespace App\Policies\Controllers;


class CourseControllerPolicy extends BaseControllerPolicy
{
    public function __construct($user)
    {
        parent::__construct($user);
        $this->lecturerService = app('App\Services\Lecturer');
        $this->studentService = app('App\Services\Student');
        $this->permissionService = app('App\Services\Permission');
    }

    protected function getCreate()
    {
        return $this->user->hasAccess('course.create');
    }

    protected function postCreate()
    {
        return $this->user->hasAccess('course.create');
    }

    protected function getList()
    {
        return $this->user->hasAccess('course.list.view');
    }
    protected function postUpdate()
    {
        return $this->user->hasAccess('course.update');
    }

    protected function getView(\App\Models\Course $course)
    {
        if($this->studentService->isStudent($this->user)) {
            return $course->whereHas('batch', function($q) {
                return $q->whereHas('student', function($q) {
                    return $q->whereHas('user', function($q) {
                        return $this->where('id','=',$this->user);
                    });
                });
            });
        } else {
            return $this->user->hasAccess('course.view');
        }
    }

}