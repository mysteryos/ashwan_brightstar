<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24/04/2017
 * Time: 22:23
 */

namespace App\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;


class LectureController extends Controller
{
    use VendorLibraries;

    protected $policy = '\App\Policies\Controllers\LectureControllerPolicy';


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

        $this->studentService = app('App\Services\Student');
    }

    public function getList()
    {
        //Verify User Access
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Lecture - List';

        //Set Data

        //If user is a student
        if($this->studentService->isStudent($this->user)) {
            $studentProfile = \App\Models\Student::where('user_id','=',$this->user->id)->first();

            $this->data['lecture_list'] = \App\Models\Lecture::orderBy('updated_at', 'DESC')
                                        ->with('course')
                                        ->whereHas('course',function($q) use($studentProfile){
                                            return $q->whereHas('batch', function($q) use($studentProfile) {
                                                return $q->whereHas('student', function($q) use ($studentProfile) {
                                                   return $q->where('student_id','=',$studentProfile->id);
                                                });
                                            });
                                        })
                                        ->get();
        } else {
            //Is a lecturer or admin
            $this->data['lecture_list'] = \App\Models\Lecture::orderBy('updated_at', 'DESC')->with('course')->get();
        }


        //Permissions
        $this->data['can_create_lecture'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/lecture.list.js');
        $this->addCss('/css/el/lecture.list.css');

        return $this->renderView('lecture.list');
    }

    public function getCreate()
    {
        //Verify User Access
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Lecture - Create';

        //Permissions
        $this->data['can_create_lecture'] = true;

        //Course List
        $this->data['course_list'] = \App\Models\Course::orderBy('name', 'ASC')->get();

        //Assets
        $this->addJqueryValidate();

        $this->addJs('/js/el/lecture.create.js');
        return $this->renderView('lecture.create');

    }


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
     * POST: Update Lecture
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
            'id' => 'required|max:5|alpha',
            'name' => 'required|max:255|alpha',
            'description' => 'description|max:254',
            'course_id' => 'required|max:5|alpha',
        ]);

        $lecture = \App\Models\Lecture::findOrFail($request->get('id'));

        //Fill in information from request
        $lecture->fill($request->all());

        //Save to database
        $lecture->save();

        return redirect()->action('LectureController@getView',[$lecture->id]);
    }

    /**
     * GET: View Lecture
     *
     * @param int $lecture_id
     * @return \Illuminate\View\View
     */
    public function getView($lecture_id)
    {
        $lecture = \App\Models\Lecture::with('course')->findOrFail((int)$lecture_id);

        //Verify User Access
        $this->verifyAccess($lecture);

        //If user is a student
        if($this->studentService->isStudent($this->user)) {
            $studentProfile = \App\Models\Student::where('user_id','=',$this->user->id)->first();

            $this->data['lecture_list'] = \App\Models\Lecture::orderBy('updated_at', 'DESC')
                ->with('course')
                ->whereHas('course',function($q) use($studentProfile){
                    return $q->whereHas('batch', function($q) use($studentProfile) {
                        return $q->whereHas('student', function($q) use ($studentProfile) {
                            return $q->where('student_id','=',$studentProfile->id);
                        });
                    });
                })
                ->get();
        } else {
            //Is a lecturer or admin
            $this->data['lecture_list'] = \App\Models\Lecture::orderBy('updated_at', 'DESC')->with('course')->get();
        }

        //Set Page Title
        $this->data['pageTitle'] = 'Lecture - View - '.$lecture->name;

        $this->data['lecture'] = $lecture;

        /*
         * Assets
         */
        $this->addJqueryValidate();

        $this->addJs('/js/el/lecture.view.js');
        $this->addCss('/css/el/lecture.view.css');

        return $this->renderView('lecture.view');
    }

}