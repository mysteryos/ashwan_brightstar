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
    }

    /**
     * GET: List of lectures
     *
     * @return \Illuminate\View\View
     */
    public function getList()
    {
        //Verify User Access
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Lecture - List';

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
        $this->data['hasCreateAccess'] = $this->hasAccess('lecture.create');

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/lecture.list.js');
        $this->addCss('/css/el/lecture.list.css');

        return $this->renderView('lecture.list');
    }

    /**
     * GET: Create Lecture
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        //Verify User Access
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Lecture - Create';

        //Course List
        $this->data['course_list'] = \App\Models\Course::orderBy('name', 'ASC')->get();

        //Assets
        $this->addJqueryValidate();
        $this->addSummerNote();

        $this->addJs('/js/el/lecture.create.js');

        return $this->renderView('lecture.create');
    }

    /**
     * POST: Create Lecture
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
            'name' => 'required|max:255',
            'description' => 'required',
            'course_id' => 'required|exists:course,id,deleted_at,NULL',
        ]);

        //Create New Lecture
        $lecture = new \App\Models\Lecture();
        //Fill in information from request
        $lecture->fill($request->all());
        //Set creator to user currently logged in
        $lecture->creator()->associate($this->user);
        //Save to database
        $lecture->save();

        return redirect()->action('LectureController@getView',[$lecture->id]);
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
            'name' => 'required|max:255',
            'description' => 'required',
            'course_id' => 'required|exists:course,id,deleted_at,NULL',
        ]);

        $lecture = \App\Models\Lecture::findOrFail((int)$request->get('id'));

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
        $lecture = \App\Models\Lecture::with('course','quiz')->findOrFail((int)$lecture_id);

        //Verify User Access
        $this->verifyAccess($lecture);

        //Set Page Title
        $this->data['pageTitle'] = 'Lecture - View - '.$lecture->name;

        $this->data['lecture'] = $lecture;

        $this->data['hasUpdateAccess'] = $this->hasAccess('lecture.update');
        $this->data['hasDeleteAccess'] = $this->hasAccess('lecture.delete');

        if($this->data['hasUpdateAccess']) {
            $this->data['course_list'] = \App\Models\Course::orderBy('name','ASC')->get();
        }

        /*
         * Assets
         */
        $this->addJqueryValidate();
        $this->addSummerNote();

        $this->addJs('/js/el/lecture.view.js');
        $this->addCss('/css/el/lecture.view.css');

        return $this->renderView('lecture.view');
    }

    /**
     * POST: Delete Lecture
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete(Request $request)
    {
        $this->verifyAccess();

        $lecture = \App\Models\Lecture::findOrFail(\Crypt::decrypt($request->input('id')));

        $lecture->delete();

        return redirect()->action('LectureController@getList')->with([
            'messages' => "Lecture ID: {$lecture->id} has been successfully delete"
        ]);
    }

}