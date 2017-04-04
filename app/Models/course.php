<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02/04/2017
 * Time: 19:08
 */

namespace App\Models;


class Course extends \Eloquent
{
    protected $table = 'course';

    /*
     * Relationships
     */

    /**
     * Lectures: One-To-Many
     *
     * @return mixed
     */
    public function lectures()
    {
        return $this->hasMany(Lecture::class,'course_id');
    }
}