<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02/04/2017
 * Time: 22:57
 */

namespace App\Models;


class Lecture extends \Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'lecture';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'course_id'

    ];

    /**
     * Relationships
     *
     */

    /**
     * Course
     *
     * @return Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Creator
     *
     * @return User
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

    /**
     * Quiz
     *
     * @return Quiz
     */
    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'lecture_id');
    }

}