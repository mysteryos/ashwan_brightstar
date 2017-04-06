<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 16/11/2015
 * Time: 15:13
 */

namespace App\Services\Domain\Admin;

use App\Services\Domain\BaseDomain;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Exceptions\HttpExceptionWithError;
use Symfony\Component\HttpFoundation\Response;
use Sentinel;
use Activation;
class Users extends BaseDomain
{
    /**
     * @param int $user_id
     * @return array
     * @throws HttpException
     */
    public function getViewPermissions($user_id)
    {
        if(is_numeric($user_id)) {
            $user = $this->repository->user->getModel()->find($user_id);
            if($user) {
                $this->data['user'] = $user;

                //Permissions
                $this->data['user_permissions'] = $user->permissions;
                $this->data['permissions_list'] = $this->repository->permission->getAll();

                //Roles
                $this->data['user_roles'] = $user->getRoles();
                $this->data['roles_list'] = Sentinel::getRoleRepository()->createModel()->newQuery()->get();

                //Pagetitle
                $this->data['pageTitle'] = "Users - Permissions - {$user->first_name} {$user->last_name}";

                return $this->data;

            } else {
                throw new HttpException(Response::HTTP_BAD_REQUEST,"User was not found on the system.");
            }
        } else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,"User id is not valid.");
        }
    }

    /**
     * GET: View
     *
     * @param int $user_id
     * @throws HttpException
     */
    public function getView($user_id)
    {
        if(is_numeric($user_id)) {
            $user = $this->repository->user->getModel()->find($user_id);
            if($user) {
                $user->isActivated = Activation::completed($user);
            } else {
                throw new HttpException(Response::HTTP_BAD_REQUEST,"User was not found on the system.");
            }
        } else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,"User id is not valid.");
        }

        $this->data['pageTitle'] = "Users - {$user->first_name} {$user->last_name}";
        $this->data['user'] = $user;
        return $this->data;
    }

    public function getList()
    {
        $this->data['pageTitle'] = "Users - List";
        $this->data['list'] = $this->repository->user->getAll();

        return $this->data;
    }

    /**
     * GET: Login As specific user
     * SuperAdmin utility
     *
     * @param int $user_id
     * @return array
     */
    public function getLoginAs($user_id,$request,\App\Models\User $current_user)
    {
        $user = $this->repository->user->getModel()->find($user_id);
        if($user) {
            $request->session()->put('login_as',true);
            $request->session()->put('login_as_user_id',$current_user->id);
            $this->data['user'] = $user;
            Sentinel::login($user);
        } else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,'User ID: '.$user_id.' not found.');
        }

        return $this->data;
    }

    public function getLoginBack($request,\App\Models\User $current_user)
    {
        if($request->session()->has('login_as') && $request->session()->has('login_as_user_id')) {
            $user = $this->repository->user->getModel()->find($request->session()->get('login_as_user_id'));
            if($user) {
                if(!$this->service->permission->isSuperAdmin($user)) {
                    throw new HttpException(Response::HTTP_FORBIDDEN,'Only superadmins can login back in on the system.');
                }

                $this->data['user'] = $user;
                Sentinel::login($user);

                //Remove Session data
                $request->session()->forget('login_as');
                $request->session()->forget('login_as_user_id');
            } else {
                throw new HttpException(Response::HTTP_BAD_REQUEST,'User ID: '.$request->session()->get('login_as_user_id').' not found.');
            }
        } else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,'You are not logged in as anyone else.');
        }

        return $this->data;
    }

    /*
     * Activation: START
     */

    /**
     * POST: Activate User
     *
     * @param \App\Models\User $current_user
     * @param int $user_id
     */
    public function postActivateUser(\App\Models\User $current_user,$user_id)
    {
        $id = \Crypt::decrypt($user_id);
        if($this->service->user->activate($id)) {
            //Send email
            $this->service->user->sendActivationMail($current_user,$id);
        }
    }

    /**
     * POST: Deactivate User
     *
     * @param \App\Models\User $current_user
     * @param int $user_id
     */
    public function postDeactivateUser(\App\Models\User $current_user,$user_id)
    {
        $id = \Crypt::decrypt($user_id);
        if($this->service->user->deactivate($id)) {
            $this->service->user->sendDeactivationMail($current_user,$id);
        }
    }

    /*
     * Activation: END
     */
}