<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 4/4/2017
 * Time: 3:08 PM
 */

namespace App\Models;


class AssignmentStudents extends \Eloquent
{
    protected $table = 'assignment_students';

    /**
     * Relationships
     */

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
     * Student
     *
     * @return Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Assignment
     *
     * @return Assignment
     */
    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    /**
     * File
     *
     * @return File
     */
    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }
}







