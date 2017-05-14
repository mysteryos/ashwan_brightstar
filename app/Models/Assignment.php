<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 4/2/2017
 * Time: 12:07 PM
 */

namespace App\Models;


class Assignment extends \Eloquent
{
    protected $table = 'assignment';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'submission_date'
    ];

    protected $dates = [
        'submission_date'
    ];

    /**
     * Relationships
     *
     */

    public function creator()
    {
        return $this->belongsTo(User::class,'creator_user_id');
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class,AssignmentStudents::class,'assignment_id','id','student_id');
        //return $this->hasMany(AssignmentStudents::class, 'assignment_id');
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class,'lecture_id');
    }

    public function lecture_assignments()
    {
        return $this->belongsTo(LectureAssignments::class,'id');
    }

    public function isActive()
    {
        if($this->submission_date) {
            return \Carbon\Carbon::now()->diffInDays($this->submission_date,false) >= 0;
        }

        return false;
    }

}