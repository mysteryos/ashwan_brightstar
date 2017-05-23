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
        //Verify User Access
        $this->verifyAccess();

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

        //Course List
        $this->data['course_list'] =  \App\Models\Batch::orderBy('name','ASC')->get();

        //Lecturer List
        $this->data['lecture_list'] =  \App\Models\Lecture::orderBy('name','ASC')->orderBy('name','ASC')->get();

        //Assets
        $this->addJqueryValidate();
        $this->addMoment();
        $this->addBootstrapDatetimePicker();

        $this->addJs('/js/el/course.create.js');
        return $this->renderView('course.create');


    }

    public function postCreate(Request $request)
    {
        //Verify User Access
        $this->verifyAccess();



        //Validate Data from request
        $this->validateData($request->all(),[
            'course_id' => 'required|max:5',
            'name' => 'required|max:255',
            'duration_months' => 'required',
            'description' => 'required',

        ]);

        //Create New Course
        $course = new \App\Models\Course();
        //Fill in information from request
        $course->fill($request->all());
        //Set creator user id to user currently logged in
        $course->creator_user_id = $this->user->id;

        //Set Course Id
        $course->lecture_id = $request->get('lecture_id');

        //Set Course Id
        $course->course_id = $request->get('course_id');
        //Save to database
        $course->save();


    }

    public function postUpdate(Request $request)
    {
        //Verify User Access
        $this->verifyAccess();

        //Validate Data from request
        $this->validateData($request->all(),[
            'course_id' => 'required|max:5',
            'name' => 'required|max:255',
            'duration_months' => 'required',
            'description' => 'required',
        ]);

        $course = \App\Models\Course::findOrFail($request->get('course_id'));

        //Fill in information from request
        $course->fill($request->all());

        //Save to database
        $course->save();

        return redirect()->action('CourseController@getView',[$course->id]);
    }


    public function getView($course_id)
    {
        //Verify User Access
        $this->verifyAccess();




        $course = \App\Models\Course::findOrFail((int)$course_id);

        //Verify User Access
        $this->verifyAccess($course);

        //Set Page Title
        $this->data['pageTitle'] = 'Course - View - '.$course->name;

        $this->data['course'] = $course;

        /*
         * Assets
         */
        $this->addJqueryValidate();

        $this->addJs('/js/el/course.view.js');
        $this->addCss('/css/el/course.view.css');

        return $this->renderView('course.view');
    }

    public function getViewStudent()
    {

    }


}