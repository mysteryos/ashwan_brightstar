<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 13/11/2015
 * Time: 15:26
 */

namespace App\Services;

use Sentinel;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Exceptions\HttpExceptionWithError;
use Symfony\Component\HttpFoundation\Response;
class Role extends Service
{
    /**
     * Add Role to user
     *
     * @param $current_user
     * @param int $user_id
     * @param string $role_slug
     * @return bool
     */
    public function addUserRole($current_user,$user_id,$role_slug)
    {
        //Fetch user
        $user = Sentinel::findById($user_id);
        if ($user) {
            //Fetch role
            $role = Sentinel::findRoleBySlug($role_slug);
            if($role) {
                //Superadmin check
                if($role_slug === $this->repository->role->getSuperAdminSlug() && !$this->service->permission->isSuperAdmin($current_user)) {
                    throw new HttpException(Response::HTTP_BAD_REQUEST,"Only a superadmin can add another superadmin.");
                }

                //integrity check
                if($this->repository->role->checkUserHasRole($role->id,$user_id)) {
                    throw new HttpException(Response::HTTP_BAD_REQUEST,"User already has that role.");
                }

                $role->users()->attach($user);
                return true;
            } else {
                throw new HttpException(Response::HTTP_BAD_REQUEST,"Role was not found on the system.");
            }
        } else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,"User was not found on the system.");
        }
    }

    /**
     * Remove role from user
     *
     * @param $current_user
     * @param int $user_id
     * @param string $role_slug
     * @return bool
     */
    public function removeUserRole($current_user,$user_id,$role_slug)
    {
        //Fetch user
        $user = Sentinel::findById($user_id);
        if ($user) {
            //Fetch role
            $role = Sentinel::findRoleBySlug($role_slug);
            if($role) {
                //Superadmin check
                if($role_slug === $this->repository->role->getSuperAdminSlug() && !$this->service->permission->isSuperAdmin($current_user)) {
                    throw new HttpException(Response::HTTP_BAD_REQUEST,"Only a superadmin can remove another superadmin.");
                }

                $role->users()->detach($user);
                return true;
            } else {
                throw new HttpException(Response::HTTP_BAD_REQUEST,"Role was not found on the system.");
            }
        } else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,"User was not found on the system.");
        }
    }
}