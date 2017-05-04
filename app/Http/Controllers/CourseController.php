<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 08:03
 */

namespace app\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    use VendorLibraries;

    protected $policy = '\App\Policies\Controllers\CourseControllerPolicy';

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
        $this->data['pageTitle'] = 'Course - List';

        //Set Data
        $this->data['course_list'] = \App\Models\Course::orderBy('updated_at','DESC')->get();

        //Permissions
        $this->data['can_create_course'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/course.list.js');
        $this->addCss('/css/el/course.list.css');

        return $this->renderView('course.list');
    }

    public function getCreate()
    {
        //Verify User Access
        $this->verifyAccess();


        //Set Page Title
        $this->data['pageTitle'] = 'Course - Create';

        //Permissions
        $this->data['can_create_course'] = true;

        //Assets
        $this->addJqueryValidate();

        $this->addJs('/js/el/course.create.js');
        return $this->renderView('course.create');


    }
    public function postCreate(Request $request)
    {

        //Verify User Access
        $this->verifyAccess();


        //Validate Data from request
        $this->validateData($request->all(),[
            'name' => 'required|max:255',
            'duration_month' => 'required|max:12',
            'description' => 'description|max:254',

        ]);

        //Create New Course
        $course = new \App\Models\Course();
        //Fill in information from request
        $course->fill($request->all());
        //Set creator user id to user currently logged in
        $course->creator_user_id = $this->user->id;
        //Save to database
        $course->save();
    }



}