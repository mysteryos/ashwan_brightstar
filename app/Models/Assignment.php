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

    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }
}