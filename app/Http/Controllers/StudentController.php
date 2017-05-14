<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20/04/2017
 * Time: 09:17
 */

namespace App\Http\Controllers;

use App\Traits\VendorLibraries;
use Illuminate\Http\Request;
class StudentController extends Controller
{
    use VendorLibraries;

    protected $policy = '\App\Policies\Controllers\StudentControllerPolicy';

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
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Student - List';

        //Set Data
        $this->data['student_list'] = \App\Models\Student::orderBy('updated_at','DESC')->get();

        //Permissions
        $this->data['can_create_student'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/student.list.js');
        $this->addCss('/css/el/student.list.css');

        return $this->renderView('student.list');
    }

    public function getCreate()
    {
        //Verify User Access
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Student - Create';

        //Permissions
        $this->data['can_create_student'] = $this->user->hasAccess('student.create');

        //Assets
        $this->addJqueryValidate();

        $this->addJs('/js/el/student.create.js');
        return $this->renderView('student.create');
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

        //Create New Student
        $student = new \App\Models\Student();
        //Fill in information from request
        $student->fill($request->all());
        //Set creator user id to user currently logged in
        $student->creator_user_id = $this->user->id;
        //Save to database
        $student->save();

        return redirect()->action('StudentController@getView',[$student->id]);
    }

    /**
     * POST: Update Student Profile
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
            'id' => 'required|exists:student,id',
            'first_name' => 'required|max:255|alpha',
            'last_name' => 'required|max:255|alpha',
            'email' => 'email|max:254',
            'mobile_number' => 'numeric|digits_between:4,15'
        ]);

        $student = \App\Models\Student::findOrFail($request->get('id'));

        //Fill in information from request
        $student->fill($request->all());

        //Save to database
        $student->save();

        return redirect()->action('StudentController@getView',[$student->id]);
    }

    /**
     * GET: View Student Profile
     *
     * @param int $student_id
     * @return \Illuminate\View\View
     */
    public function getView($student_id)
    {
        $student = \App\Models\Student::findOrFail((int)$student_id);

        //Verify User Access
        $this->verifyAccess($student->id);

        //Set Page Title
        $this->data['pageTitle'] = 'Student - View - '.$student->name;

        $this->data['student'] = $student;

        /*
         * Assets
         */
        $this->addJqueryValidate();

        $this->addJs('/js/el/student.view.js');
        $this->addCss('/css/el/student.view.css');

        return $this->renderView('student.view');
    }

}