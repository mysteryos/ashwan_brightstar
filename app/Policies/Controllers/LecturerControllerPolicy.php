<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 18:48
 */

namespace App\Policies\Controllers;


class LecturerControllerPolicy extends BaseControllerPolicy
{
    protected function getCreate()
    {
        return $this->user->hasAccess('lecturer.create');
    }

    protected function postCreate()
    {
        return $this->user->hasAccess('lecturer.create');
    }



}