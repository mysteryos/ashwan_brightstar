<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 4/2/2017
 * Time: 12:07 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Collection;

class Assignment extends \Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'assignment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'submission_date',
        'lecture_id'
    ];

    protected $dates = [
        'submission_date'
    ];

    /**
     * Relationships
     *
     */

    /**
     * Creator
     *
     * @return User
     */
    public function creator()
    {
        return $this->belongsTo(User::class,'creator_user_id');
    }

    /**
     * Students that submitted their assignments
     *
     * @return Student
     */
    public function students()
    {
        return $this->hasManyThrough(Student::class,AssignmentStudents::class,'assignment_id','id','student_id');
    }

    /**
     * Submissions
     *
     * @return Collection
     */
    public function submissions()
    {
        return $this->hasMany(AssignmentStudents::class, 'assignment_id');
    }

    /**
     * Lecture
     *
     * @return Lecture
     */
    public function lecture()
    {
        return $this->belongsTo(Lecture::class,'lecture_id');
    }

    /**
     * Utility function: Is active.
     *
     * @return bool
     */
    public function isActive()
    {
        if($this->submission_date) {
            return \Carbon\Carbon::now()->diffInDays($this->submission_date,false) >= 0;
        }

        return false;
    }

}