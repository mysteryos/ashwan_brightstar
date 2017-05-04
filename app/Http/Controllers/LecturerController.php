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

    public function postCreate(Request $request)
    {
        //Verify User Access
        $this->verifyAccess();

        //Validate Data from request
        $this->validateData($request->all(),[
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
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





}