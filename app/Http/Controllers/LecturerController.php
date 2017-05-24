<?php
/**
 * Created by PhpStorm.
 * User: Shift
 * Date: 4/14/2017
 * Time: 3:33 PM
 */

namespace App\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;
class LecturerController extends Controller
{
    use VendorLibraries;

    protected $policy = '\App\Policies\Controllers\LecturerControllerPolicy';

    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        /*
         * Register Middleware
         */

        $this->middleware('auth');
    }

    /**
     * GET: List of lecturers
     *
     * @return \Illuminate\View\View
     */
    public function getList()
    {
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Lecturer - List';

        //Set Data
        $this->data['lecturer_list'] = \App\Models\Lecturer::orderBy('updated_at','DESC')->get();

        //Permissions
        $this->data['can_create_lecturer'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/lecturer.list.js');
        $this->addCss('/css/el/lecturer.list.css');

        return $this->renderView('lecturer.list');
    }

    /**
     * GET: Create Lecturer Profile
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        //Verify User Access
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Lecturer - Create';

        //Permissions
        $this->data['can_create_lecturer'] = true;

        //Assets
        $this->addJqueryValidate();

        $this->addJs('/js/el/lecturer.create.js');

        return $this->renderView('lecturer.create');
    }

    /**
     * POST: Create Lecturer Profile
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        //Verify User Access
        $this->verifyAccess();

        //Validate Data from request
        $this->validateData($request->all(),[
            'first_name' => 'required|max:255|alpha',
            'last_name' => 'required|max:255|alpha',
            'email' => 'email|max:254',
            'mobile_number' => 'numeric|digits_between:4,15'
        ]);

        //Create New Lecturer
        $lecturer = new \App\Models\Lecturer();
        //Fill in information from request
        $lecturer->fill($request->all());
        //Set creator user id to user currently logged in
        $lecturer->creator()->associate($this->user);
        //Save to database
        $lecturer->save();

        return redirect()->action('LecturerController@getView',['lecturer_id' => $lecturer->id]);
    }

    /**
     * POST: Update Lecturer Profile
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdate(Request $request)
    {
        //Verify User Access
        $this->verifyAccess();

        //Validate Data from request
        $this->validateData($request->all(),[
            'first_name' => 'required|max:255|alpha_spaces',
            'last_name' => 'required|max:255|alpha_spaces',
            'email' => 'email|max:254',
            'mobile_number' => 'numeric|digits_between:4,15'
        ]);

        $lecturer = \App\Models\Lecturer::findOrFail((int)$request->input('id'));
        $lecturer->fill($request->all());
        $lecturer->save();

        return redirect()->action('LecturerController@getView',['lecturer_id' => $lecturer->id]);
    }

    /**
     * GET: View Lecturer Profile
     *
     * @param Request $request
     * @param int $lecturer_id
     * @return \Illuminate\View\View
     */
    public function getView(Request $request, $lecturer_id)
    {
        $lecturer = \App\Models\Lecturer::findOrFail((int)$lecturer_id);

        //Verify User Access
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Lecturer - View - '.$lecturer->name;

        $this->data['lecturer'] = $lecturer;

        $this->data['user_orphans'] = \App\Models\User::doesntHave('student')->doesntHave('lecturer')->get();
        $this->data['has_user_link_access'] = $this->isSuperAdmin;

        /*
         * Assets
         */
        $this->addJqueryValidate();
        $this->addChosen();
        $this->addJs('/js/el/lecturer.view.link_user.js');
        $this->addJs('/js/el/lecturer.view.js');
        $this->addCss('/css/el/lecturer.view.css');

        return $this->renderView('lecturer.view');
    }

    /**
     * GET: Unlink user from lecturer
     *
     * @param Request $request
     * @param int $lecturer_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getUnlinkUser(Request $request, $lecturer_id)
    {
        $this->verifyAccess();

        $lecturer = \App\Models\Lecturer::with('user')->findOrFail($lecturer_id);
        $user = $lecturer->user;
        $lecturer->user()->dissociate();
        $lecturer->save();

        if($user) {
            //Remove user role
            $roleService = app('App\Services\Role');
            $roleService->removeUserRole($this->user,$user->id,"lecturer");
        } else {
            return redirect()->back()->withErrors([
                'User Profile doesn\'t exist on the system'
            ]);
        }

        return redirect()
            ->back()
            ->with([
                'messages' => 'User profile was successfully unlinked from lecturer.'
            ]);

    }

    /**
     * POST: Link user to lecturer
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLinkUser(Request $request)
    {
        $this->verifyAccess();

        $this->validateData($request->all(),[
            'lecturer_id' => 'required|numeric|exists:lecturer,id',
            'user_id' => 'required|numeric|exists:users,id'
        ]);

        $lecturer = \App\Models\Lecturer::findOrFail($request->input('lecturer_id'));

        $user = \App\Models\User::findOrFail($request->input('user_id'));

        if($user) {
            //Attach user to lecturer profile
            $lecturer->user()->associate($user);
            $lecturer->save();

            //Give user appropriate roles
            $roleService = app('App\Services\Role');
            $roleService->addUserRole($this->user,$user->id,"lecturer");
        } else {
            return redirect()->back()->withErrors([
                'User Profile doesn\'t exist on the system'
            ]);
        }

        return redirect()
            ->back()
            ->with([
                'messages' => 'User profile was successfully linked to lecturer.'
            ]);
    }
}