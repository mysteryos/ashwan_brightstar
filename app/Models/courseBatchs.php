<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02/04/2017
 * Time: 19:26
 */

namespace App\Models;


class CourseBatchs extends \Eloquent
{
    protected $table = 'course_batchs';

    public function creator() {
        return $this->belongsTo(User::class,'creator_user_id');
    }

    public function batch() {
        return $this->belongsTo(Batch::class,'batch_id');
    }


}