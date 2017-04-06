<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02/04/2017
 * Time: 23:04
 */

namespace App\Models;


class LectureAssignments extends \Eloquent
{
    protected $table = 'lecture_assignments';


    public function creator() {
        return $this->belongsTo(User::class,'creator_user_id');
    }

    public function lecture() {
        return $this->belongsTo(Lecture::class,'lecture_id');
    }


    public function assignment() {
        return $this->belongsTo(Assignment::class,'assignment_id');
    }


}