<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 18:48
 */

namespace app\Policies\Controllers;


class CourseControllerPolicy extends BaseControllerPolicy
{
    protected function getCreate()
    {
        return $this->user->hasAccess('course.create');
    }

    protected function postCreate()
    {
        return $this->user->hasAccess('course.create');
    }

    protected function postUpdate()
    {
        return $this->user->hasAccess('course.update');
    }

    protected function getView($course_id)
    {
        return true;
    }

    protected function getViewCourse($course_id)
    {
        return true;
    }

    protected function postCreateCourse($course_id)
    {
        return $this->user->hasAccess('course.update');
    }

    protected function postDeleteCourse($course_id)
    {
        return $this->user->hasAccess('course.delete');
    }



}