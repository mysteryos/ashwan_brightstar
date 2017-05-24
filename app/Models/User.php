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


    /**
     * Utility function to get full name of user
     *
     * @return string
     */
    public function getName()
    {
        return $this->first_name." ".$this->last_name;
    }

    /*
     *  Relationships
     */
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }

    public function lecturer()
    {
        return $this->hasOne(Lecturer::class, 'user_id');
    }

}