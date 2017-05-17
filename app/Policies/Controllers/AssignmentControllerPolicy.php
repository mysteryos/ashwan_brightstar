<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 18:48
 */

namespace App\Policies\Controllers;


class AssignmentControllerPolicy extends BaseControllerPolicy
{
    public function __construct($user)
    {
        parent::__construct($user);
        $this->lecturerService = app('App\Services\Lecturer');
        $this->studentService = app('App\Services\Student');
        $this->permissionService = app('App\Services\Permission');
    }

    protected function getCreate()
    {
        return $this->user->hasAccess('assignment.create') || $this->lecturerService->isLecturer($this->user);;
    }

    protected function postCreate()
    {
        return $this->user->hasAccess('assignment.create') || $this->lecturerService->isLecturer($this->user);;
    }
    protected function postUpdate()
    {
        return $this->user->hasAccess('assignment.update') || $this->lecturerService->isLecturer($this->user);;
    }

    protected function getView($assignment_id)
    {
        //Has Permission
        //Or Is a lecturer
        if($this->user->hasAccess('assignment.view') ||
            $this->lecturerService->isLecturer($this->user)) {
            return true;
        } else {
            //Is a student
            if($this->studentService->isStudent($this->user)) {
                return \App\Models\Assignment::where('id','=',$assignment_id)
                    ->whereHas('lecture',function($q){
                        return $q->whereHas('course',function($q) {
                            return $q->whereHas('batch',function($q) {
                                return $q->whereHas('student',function($q) {
                                    return $q->whereHas('user', function($q) {
                                        return $q->where('id','=',$this->user->id);
                                    });
                                });
                            });
                        });
                    })->count() > 0;
            }
        }

        return false;
    }

    protected function getViewSubmission()
    {
        return $this->user->hasAccess('assignment.view') || $this->lecturerService->isLecturer($this->user);
    }

    protected function postUpload($assignment_id)
    {
        //Is a student
        if($this->studentService->isStudent($this->user)) {
            return \App\Models\Assignment::where('id','=',$assignment_id)
                ->whereHas('lecture',function($q){
                    return $q->whereHas('course',function($q) {
                        return $q->whereHas('batch',function($q) {
                            return $q->whereHas('student',function($q) {
                                return $q->whereHas('user', function($q) {
                                    return $q->where('id','=',$this->user->id);
                                });
                            });
                        });
                    });
                })->count() > 0;
        }

        return false;
    }

    protected function postDelete()
    {
        return $this->lecturerService->isLecturer($this->user) || $this->hasAccess('assignment.delete');
    }

    protected function getFile($file)
    {
        //Lecturer or permission access
        if($this->lecturerService->isLecturer($this->user) || $this->hasAcces('assignment.file.view')) {
            return true;
        } else {
            //If is creator of file, give access
            return $file->creator_user_id === $this->user->id;
        }
    }
}