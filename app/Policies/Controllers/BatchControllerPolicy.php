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

    protected function getViewStudent($batch_id)
    {
        return true;
    }

    protected function postCreateStudent($batch_id)
    {
        return $this->user->hasAccess('batch.update');
    }

    protected function postDeleteStudent($batch_id)
    {
        return $this->user->hasAccess('batch.delete');
    }

}