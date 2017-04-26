<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02/04/2017
 * Time: 22:57
 */

namespace app\Models;


class Lecture extends \Eloquent
{
    protected $table = 'lecture';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',

    ];




    public function course()
    {
        return $this->hasMany(Course::class, 'course_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

}