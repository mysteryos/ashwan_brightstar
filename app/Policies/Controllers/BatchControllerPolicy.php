<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 18:48
 */

namespace App\Policies\Controllers;


class BatchControllerPolicy extends BaseControllerPolicy
{
    protected function getCreate()
    {
        return $this->user->hasAccess('batch.create');
    }

    protected function postCreate()
    {
        return $this->user->hasAccess('batch.create');
    }

    protected function postUpdate()
    {
        return $this->user->hasAccess('batch.update');
    }

    protected function getView($batch_id)
    {
        return true;
    }

}