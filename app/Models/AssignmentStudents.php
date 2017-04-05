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


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function assignments()
    {
        return $this->belongsTo(Assignments::class, 'assignment_id');
    }


}







