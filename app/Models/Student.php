<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02/04/2017
 * Time: 23:14
 */

namespace App\Models;


class Student extends \Eloquent
{
    protected $table = 'student';

    public function creator() {
        return $this->belongsTo(User::class,'creator_user_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}