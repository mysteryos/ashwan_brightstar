<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 22/10/2015
 * Time: 14:09
 */

namespace App\Policies\Controllers\Admin;

use App\Policies\Controllers\BaseControllerPolicy;

class UsersControllerPolicy extends BaseControllerPolicy
{
    /*
     * Overview
     * @return bool
     */
    protected function getOverview()
    {
        return $this->user->hasAccess('admin.users.view');
    }

    /*
     * Get list
     * @return bool
     */
    protected function getList()
    {
        return $this->user->hasAccess('admin.users.view');
    }

    /*
     * Get View
     * @return bool
     */
    protected function getView()
    {
        return $this->user->hasAccess('admin.users.view');
    }

    /**
     * Post Save User Basic info
     */

    protected function postSaveUser()
    {
        return $this->user->hasAccess('admin.users.update');
    }

    /**
     * Post activate user
     */

    protected function postActivateUser()
    {
        return $this->user->hasAccess('admin.users.update');
    }

    /**
     * Post deactivate user
     */

    protected function postDeactivateUser()
    {
        return $this->user->hasAccess('admin.users.update');
    }

    /**
     * Get Permission User
     */

    protected function getUserPermissions()
    {
        return $this->user->hasAccess('admin.users.view');
    }


    /**
     * POST Add User Permission
     *
     * @return bool
     */
    protected function postAddUserPermission()
    {
        return $this->user->hasAccess('admin.permissions.create');
    }


    /**
     * POST Remove User Permission
     *
     * @return bool
     */
    protected function postRemoveUserPermission()
    {
        return $this->user->hasAccess('admin.permissions.delete');
    }

    /**
     * POST Add User Role
     *
     * @return bool
     */
    protected function postAddUserRole()
    {
        return $this->user->hasAccess('admin.roles.create');
    }

    /**
     * POST Remove User Role
     *
     * @return bool
     */
    protected function postRemoveUserRole()
    {
        return $this->user->hasAccess('admin.roles.remove');
    }

    /**
     * GET Login As
     *
     * @return bool
     */
    protected function getLoginAs()
    {
        return $this->service->permission->isSuperAdmin($this->user);
    }

}