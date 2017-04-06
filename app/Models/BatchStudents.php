<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03/04/2017
 * Time: 07:21
 */

namespace App\Models;


class BatchStudents extends \Eloquent
{
    protected $table = 'batch_students';

    public function creator() {
        return $this->belongsTo(User::class,'creator_user_id');
    }


    public function batch() {
        return $this->belongsTo(Batch::class,'batch_id');
    }

    public function student() {
        return $this->belongsTo(Student::class,'student_id');
    }


}