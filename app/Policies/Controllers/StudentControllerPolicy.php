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
    protected function getCreate()
    {
        return $this->user->hasAccess('student.create');
    }

    protected function postCreate()
    {
        return $this->user->hasAccess('student.create');
    }
}