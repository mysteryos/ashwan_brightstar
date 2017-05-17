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

    /**
     * GET: List of students
     *
     * @return \Illuminate\View\View
     */
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

    /**
     * GET: Create Student Profile
     *
     * @return \Illuminate\View\View
     */
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

    /**
     * POST: Create Student
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

        $student = \App\Models\Student::findOrFail((int)$request->input('id'));

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

    /**
     * GET: List of batch student is enrolled in
     *
     * @param $student_id
     * @return \Illuminate\View\View
     */
    public function getViewBatch($student_id)
    {
        $student = \App\Models\Student::with('batch')->findOrFail((int)$student_id);

        //Verify User Access
        $this->verifyAccess($student->id);

        //Set Page Title
        $this->data['pageTitle'] = 'Student - View Batch - '.$student->name;

        $this->data['student'] = $student;

        $this->data['hasStudentUpdateAccess'] = $this->hasAccess('student.update');
        $this->data['hasStudentDeleteAccess'] = $this->hasAccess('student.delete');

        $batchIds = $student->batch->map(function($row) {
            return $row->id;
        });

        $this->data['batch_list'] = \App\Models\Batch::whereNotIn('id',$batchIds)->get();

        /*
         * Assets
         */

        $this->addJs('/js/el/student.view_batch.js');

        return $this->renderView('student.view-batch');
    }

    /**
     * Post: Link Batch To Student
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postCreateBatch(Request $request)
    {
        $student = \App\Models\Student::with('batch')->findOrFail(\Crypt::decrypt($request->get('id')));

        //Verify User Access
        $this->verifyAccess((int)$student->id);

        $batch = \App\Models\Batch::findOrFail(\Crypt::decrypt($request->get('batch_id')));

        $batchIds = $student->batch->map(function($row) {
            return $row->id;
        });

        //Check if student is already in the batch
        if(in_array($batch->id, $batchIds->toArray())) {
            return redirect()->back()->withErrors("Batch with ID: {$batch->id} is already linked to student");
        }

        //DB: Link student to batch
        $student->batch()->save($batch);
        $student->touch();

        return redirect()->back()->with([
            'messages' => "Batch with ID: {$batch->id} was successfully linked to student"
        ]);
    }

    /**
     * POST: Unlink batch from student
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postDeleteBatch(Request $request)
    {
        $student = \App\Models\Student::with('batch')->findOrFail((int)$request->get('id'));

        //Verify User Access
        $this->verifyAccess((int)$student->id);

        $batch = \App\Models\Batch::findOrFail((int)$request->get('batch_id'));

        $batchIds = $student->batch->map(function($row) {
            return $row->id;
        });

        //Check if student is not in the batch
        if(!in_array($batch->id, $batchIds->toArray())) {
            return redirect()->back()->withErrors("Batch with ID: {$batch->id} is not linked to student.");
        }

        //DB: Remove batch from student
        $student->batch()->detach($batch->id);
        $student->touch();

        return redirect()->back()->with([
            'messages' => "Batch with ID: {$batch->id} was successfully unlinked from student"
        ]);
    }
}