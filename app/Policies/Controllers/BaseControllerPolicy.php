<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 22/10/2015
 * Time: 14:10
 */

namespace App\Policies\Controllers;

use App\Exceptions\NotLoggedInException;
use App\Services\DependencyResolver;
Use Sentinel;
class BaseControllerPolicy
{
    protected $user;
    protected $service;
    protected $repository;
    protected $permissionService;

    public function __construct($user)
    {
        $this->user = $user;
        $this->service = new DependencyResolver('service');
        $this->repository = new DependencyResolver('repository');
        $this->permissionService = app('\App\Services\Permission');
        $this->permissionRepository = app('\App\Repositories\Permission');
    }

    public function __call($method,$args)
    {
        /*
         * Check if guest
         * Is guest, then deny access
         */
        if($this->isGuest() === true)
        {
            throw new NotLoggedInException("Please log in to access this resource");
        }

        /*
         * Super Admin Override
         */

        if($this->permissionService->isSuperAdmin($this->user))
        {
            return true;
        }

        /*
         * Finally Call class method
         */
        return call_user_func_array(array($this, $method), $args);
    }

    /*
     * Check if user is guest
     */
    private function isGuest()
    {
        if($this->user === false)
        {
            return true;
        }

        return false;
    }
}