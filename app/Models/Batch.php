<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02/04/2017
 * Time: 12:37
 */

namespace App\Models;


class Batch extends \Eloquent
{
    protected $table = 'batch';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'start_date',
        'course_id',
        'lecturer_id'
    ];

    protected $dates = ['start_date'];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');

    }
}


