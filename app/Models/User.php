<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 08/10/2015
 * Time: 16:07
 */

namespace App\Models;

use \Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
    protected $guarded = ['permissions'];

    /*
     *  Relationships
     */

    public function getName()
    {
        return $this->first_name." ".$this->last_name;
    }

}