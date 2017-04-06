<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 10/11/2015
 * Time: 14:43
 */

namespace App\Services;

use Sentinel;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Exceptions\HttpExceptionWithError;
use Symfony\Component\HttpFoundation\Response;
class Permission extends Service
{
    /**
     * Add permission to user
     *
     * @param obj $current_user
     * @param int $user_id
     * @param string $permission_slug
     * @param bool $permission_value
     * @return bool
     * @throws HttpException
     */
    public function addUserPermission($current_user,$user_id,$permission_slug,$permission_value)
    {
        $user = Sentinel::findById($user_id);
        if ($user) {
            $this->validate([
                'permission_slug' => $permission_slug,
                'permission_value' => $permission_value
            ],$this->repository->permission->getAddPermissionValidationRules());

            if($permission_slug===$this->repository->permission->getSuperAdminSlug() && !$this->isSuperAdmin($current_user)) {
                throw new HttpException(Response::HTTP_BAD_REQUEST,"Only a superadmin can add another superadmin.");
            }

            //Add permission
            $user->addPermission($permission_slug,$permission_value)
                ->save();

            return true;

        } else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,"User was not found on the system.");
        }
    }

    /**
     * Remove permission from user
     *
     * @param obj $current_user
     * @param int $user_id
     * @param string $permission_slug
     * @return bool
     * @throws HttpException
     */
    public function removeUserPermission($current_user,$user_id,$permission_slug)
    {
        $user = Sentinel::findById($user_id);
        if ($user) {
            if($permission_slug===$this->repository->permission->getSuperAdminSlug() && !$this->isSuperAdmin($current_user)) {
                throw new HttpException(Response::HTTP_BAD_REQUEST,"Only a superadmin can remove another superadmin");
            }

            //Remove Permission
            $user->removePermission($permission_slug)
                ->save();

            return true;
        } else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,"User was not found on the system.");
        }
    }

    /**
     * Check if user is superadmin
     *
     * @param $user
     * @return bool
     */
    public function isSuperAdmin($user)
    {
        if($user) {
            return $user->hasAccess($this->repository->permission->getSuperAdminSlug());
        } else {
            return false;
        }
    }

    /**
     * Check if user is human resources
     *
     * @param $user
     * @return bool
     */
    public function isHumanResource($user)
    {
        if($user) {
            return $user->hasAccess($this->repository->permission->getHumanResourcesSlug());
        } else {
            return false;
        }
    }
}