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

    protected function getView()
    {
        return $this->user->hasAccess('lecturer.view');
    }

    protected function postUpdate()
    {
        return $this->user->hasAccess('lecturer.update');
    }

    protected function getList()
    {
        return $this->user->hasAccess('lecturer.list.view') ;
    }

    protected function getUnlinkUser()
    {
        return false;
    }

    protected function postLinkUser()
    {
        return false;
    }
}