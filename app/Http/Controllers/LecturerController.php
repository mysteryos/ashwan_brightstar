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
        $lecturer->creator_user_id = $this->user->id;
        //Save to database
        $lecturer->save();
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
            'first_name' => 'required|max:255|alpha',
            'last_name' => 'required|max:255|alpha',
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

        /*
         * Assets
         */
        $this->addJqueryValidate();

        $this->addJs('/js/el/lecturer.view.js');
        $this->addCss('/css/el/lecturer.view.css');

        return $this->renderView('lecturer.view');
    }
}