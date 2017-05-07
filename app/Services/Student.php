<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 5/7/2017
 * Time: 9:06 AM
 */

namespace App\Services;

use App\Models\Student as StudentModel;
class Student extends Service
{
    public function isStudent(\App\Models\User $user)
    {
        $studentCount = StudentModel::where('user_id','=',$user->id)->count();
        if($studentCount > 0) {
            return true;
        }

        return false;
    }
}