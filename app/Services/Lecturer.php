<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 5/7/2017
 * Time: 9:13 AM
 */

namespace App\Services;

use App\Models\Lecturer as LecturerModel;
class Lecturer extends Service
{
    public function isLecturer(\App\Models\User $user)
    {
        $lecturerCount = LecturerModel::where('user_id','=',$user->id)->count();
        if($lecturerCount > 0) {
            return true;
        }

        return false;
    }
}