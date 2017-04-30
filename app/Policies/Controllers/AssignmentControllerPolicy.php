<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 18:48
 */

namespace app\Policies\Controllers;


class AssignmentControllerPolicy extends BaseControllerPolicy
{
    protected function getCreate()
    {
        return $this->user->hasAccess('assignment.create');
    }

    protected function postCreate()
    {
        return $this->user->hasAccess('assignment.create');
    }



}