<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 22/10/2015
 * Time: 09:05
 */

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\VendorLibraries;

class UsersController extends Controller
{
    use VendorLibraries;

    protected $policy = '\App\Policies\Controllers\Admin\UsersControllerPolicy';

    public function __construct(\App\Services\User $service,
                                \App\Services\Permission $permissionService,
                                \App\Services\Role $roleService,
                                \App\Repositories\User $userRepository)
    {
        parent::__construct();

        $this->middleware('auth');

        $this->service->user = $service;
        $this->service->permission = $permissionService;
        $this->service->role = $roleService;
        $this->repository->user = $userRepository;
        $this->domainService = app('\App\Services\Domain\Admin\Users');
    }

    public function getOverview(Request $request)
    {
        $this->verifyAccess();


    }

    /**
     * GET: List of users
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function getList(Request $request)
    {
        $this->verifyAccess();

        //Domain Service
        $this->data = $this->domainService->getList();

        //JQuery BootGrid
        $this->addjQueryBootgrid();

        //Page JS
        $this->addJs('/js/el/admin.users.list.js');

        return $this->renderView('admin.users.list');
    }

    /**
     * GET: View of user profile
     *
     * @param Request $request
     * @param int $user_id
     * @return \Illuminate\View\View
     */
    public function getView(Request $request,$user_id)
    {
        $this->verifyAccess();

        /*
         * Domain Logic
         */
        $this->data = $this->domainService->getView($user_id);

        /*
         * Assets
         */
        $this->addMoment();
        $this->addBootstrapDatetimePicker();
        $this->addJqueryValidate();
        $this->addChosen();
        $this->addJs('/js/el/admin.users.view.js');
        $this->addCss('/css/el/admin.users.view.css');

        return $this->renderView('admin.users.view');

    }

    /**
     * Save user basic information
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function postSaveUser(Request $request)
    {
        $this->verifyAccess();

        $id = \Crypt::decrypt($request->input('id'));
        $this->service->user->save($id,$request->input());

        return redirect()->back()->with(['messages'=>'Save Successful']);
    }

    /**
     * Activate User
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function postActivateUser(Request $request)
    {
        $this->verifyAccess();

        $this->domainService->postActivateUser($this->user,$request->input('user_id'));

        return redirect()->back()->with(['messages'=>'Activation Successful']);
    }

    /**
     * Deactivate User
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeactivateUser(Request $request)
    {
        $this->verifyAccess();

        $this->domainService->postDeactivateUser($this->user,$request->input('user_id'));

        return redirect()->back()->with(['messages'=>'Deactivation Successful']);

    }

    /*
     * Create User
     * @TODO: Create user
     */
    public function getCreate(Request $request)
    {

    }

    /**
     * GET: User permissions
     *
     * @param Request $request
     * @param int $user_id
     */
    public function getUserPermissions(Request $request,$user_id)
    {
        $this->verifyAccess();

        //Domain Service
        $this->data = $this->domainService->getViewPermissions($user_id);

        /*
         * Assets
         */
        $this->addJqueryValidate();
        $this->addJs('/js/el/admin.users.permissions.js');

        /*
         * View
         */

        return $this->renderView('admin.users.permissions');
    }

    /**
     * POST: Add permission to user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddUserPermission(Request $request)
    {
        $this->verifyAccess();

        $user_id = \Crypt::decrypt($request->input('user_id'));
        $this->service->permission->addUserPermission($this->user,$user_id,$request->input('permission_slug'),boolval($request->input('permission_value')));
        return redirect()->back()->with([
            'messages' => 'Permission "'.$request->input('permission_slug').'" has been sucessfully added.'
        ]);
    }

    /**
     * POST: Remove permission from user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRemoveUserPermission(Request $request)
    {
        $this->verifyAccess();

        $user_id = \Crypt::decrypt($request->input('user_id'));
        $this->service->permission->removeUserPermission($this->user,$user_id,$request->input('permission_slug'));
        return redirect()->back()->with([
            'messages' => 'Permission '.$request->input('permission_slug').' has been sucessfully removed.'
        ]);

    }

    /**
     * POST: Add role to user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function postAddUserRole(Request $request)
    {
        $this->verifyAccess();

        $user_id = \Crypt::decrypt($request->input('user_id'));
        $this->service->role->addUserRole($this->user,$user_id,$request->input('role_slug'));
        return redirect()->back()->with([
            'messages' => 'Role '.$request->input('role_slug').' has been sucessfully added.'
        ]);
    }

    /**
     * POST: Remove role from user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function postRemoveUserRole(Request $request)
    {
        $this->verifyAccess();

        $user_id = \Crypt::decrypt($request->input('user_id'));
        $this->service->role->removeUserRole($this->user,$user_id,$request->input('role_slug'));
        return redirect()->back()->with([
            'messages' => 'Role '.$request->input('role_slug').' has been sucessfully removed.'
        ]);
    }

    /**
     * GET: Login as Specific User
     */

    public function getLoginAs(Request $request,$user_id)
    {
        $this->verifyAccess();
        $result = $this->domainService->getLoginAs($user_id,$request,$this->user);
        return redirect()->action('IndexController@getIndex')->with([
            'messages' => 'You have been logged in as '.$result['user']->getName()
        ]);
    }

    public function getLoginBack(Request $request)
    {
        $result = $this->domainService->getLoginBack($request,$this->user);
        return redirect()->action('IndexController@getIndex')->with([
            'messages' => 'You have been logged back in as '.$result['user']->getName()
        ]);
    }
}