<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 08:17
 */

namespace app\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;


class AssignmentController extends Controller
{
    use VendorLibraries;

    protected $policy = '\App\Policies\Controllers\AssignmentControllerPolicy';

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
        $this->data['pageTitle'] = 'Assignment - List';

        //Set Data
        $this->data['assignment_list'] = \App\Models\Assignment::with('lecture')->orderBy('updated_at','DESC')->get();

        //Permissions
        $this->data['can_create_assignment'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/assignment.list.js');
        $this->addCss('/css/el/assignment.list.css');

        return $this->renderView('assignment.list');
    }

    public function getCreate()
    {

        //Set Page Title
        $this->data['pageTitle'] = 'Assignment- Create';

        //Permissions
        $this->data['can_create_assignment'] = true;

        //Lecturer List
        $this->data['lecture_list'] = \App\Models\Lecture::orderBy('name','ASC')->get();
        //Assets
        $this->addJqueryValidate();
        $this->addMoment();
        $this->addBootstrapDatetimePicker();

        $this->addJs('/js/el/assignment.create.js');
        return $this->renderView('assignment.create');

    }


    public function postCreate(Request $request)
    {

        //Validate Data from request
        $this->validateData($request->all(),[
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'submission_date' => 'required|date_format:Y-m-d|after:tomorrow',
            'lecture_id' => 'required|exists:lecture,id'
        ]);

        //Create New Assignment
        $assignment = new \App\Models\Assignment();
        //Fill in information from request
        $assignment->fill($request->all());
        //Set creator user id to user currently logged in
        $assignment->creator_user_id = $this->user->id;

        //Set Lecture
        $assignment->lecture_id = $request->get('lecture_id');

        //Save to database
        $assignment->save();
    }


}