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
    /**
     * Additional attributes available on model
     *
     * @var array
     */
    protected $appends = ['name'];

    /**
     * ACCESSOR: Name
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

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



}