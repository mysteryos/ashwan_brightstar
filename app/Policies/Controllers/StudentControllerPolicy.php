<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 18/11/2015
 * Time: 08:48
 */

namespace App\Policies\Controllers;


class StudentControllerPolicy extends BaseControllerPolicy
{
    public function __construct($user)
    {
        parent::__construct($user);
        $this->lecturerService = app('App\Services\Lecturer');

    }
    protected function getCreate()
    {
        return $this->user->hasAccess('student.create');
    }

    protected function postCreate()
    {
        return $this->user->hasAccess('student.create');
    }

    protected function postUpdate()
    {
        return $this->user->hasAccess('student.update');
    }

    protected function getView($student)
    {
        $studentViewSelfProfile = false;

        $student->load('user');
        if($student->user) {
            $studentViewSelfProfile = $student->user->id === $this->user->id;
        }

        return $this->user->hasAccess('student.view') || $this->lecturerService->isLecturer($this->user) || $studentViewSelfProfile;
    }

    protected function getList()
    {
        return $this->lecturerService->isLecturer($this->user) || $this->user->hasAccess('student.list.view');
    }
}