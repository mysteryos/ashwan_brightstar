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

    protected function getView($lecture_id)
    {
        return true;
    }
}

