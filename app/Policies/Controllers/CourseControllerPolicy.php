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

}