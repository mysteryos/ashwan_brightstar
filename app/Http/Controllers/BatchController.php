<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 07:45
 */

namespace app\Http\Controllers;

use App\Exceptions\HttpExceptionWithError;
use App\Traits\VendorLibraries;
use Illuminate\Http\Request;


class BatchController extends Controller
{
    use VendorLibraries;

    protected $policy = '\App\Policies\Controllers\BatchControllerPolicy';


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
        $this->data['pageTitle'] = 'Batch - List';

        //Set Data
        $this->data['batch_list'] = \App\Models\Batch::with('course')->orderBy('updated_at','DESC')->get();

        //Permissions
        $this->data['can_create_batch'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/batch.list.js');
        $this->addCss('/css/el/batch.list.css');

        return $this->renderView('batch.list');
    }

    public function getCreate()
    {
        //Verify User Access
        $this->verifyAccess();



        //Set Page Title
        $this->data['pageTitle'] = 'Batch - Create';

        //Permissions
        $this->data['can_create_batch'] = true;

        //Course List
        $this->data['course_list'] =  \App\Models\Course::orderBy('name','ASC')->get();

        //Lecturer List
        $this->data['lecturer_list'] =  \App\Models\Lecturer::orderBy('last_name','ASC')->orderBy('first_name','ASC')->get();

        //Assets
        $this->addJqueryValidate();
        $this->addMoment();
        $this->addBootstrapDatetimePicker();

        $this->addJs('/js/el/batch.create.js');
        return $this->renderView('batch.create');


    }

    public function postCreate(Request $request)
    {
        //Verify User Access
        $this->verifyAccess();

        //Validate Data from request
        $this->validateData($request->all(),[
            'name' => 'required|max:255',
            'start_date' => 'required|date_format:Y-m-d',
            'course_id' => 'required|exists:course,id',
            'lecturer_id' => 'required|exists:lecturer,id'
        ]);

        //Validate Date
        if(Carbon::createFromFormat('Y-m-d',$request->input('start_date'))->diffIndays(Carbon::now(),false) >=0) {
            return redirect()->back()->withInput()->withErrors([
                'Start date must be greater than today'
            ]);
        }

        //Create New Batch
        $batch = new \App\Models\Batch();
        //Fill in information from request
        $batch->fill($request->all());
        //Set creator user id to user currently logged in
        $batch->creator_user_id = $this->user->id;

        //Set Lecturer Id
        $batch->lecturer_id = $request->get('lecturer_id');

        //Set Course Id
        $batch->course_id = $request->get('course_id');
        //Save to database
        $batch->save();

        return redirect()->action('BatchController@getView',[$batch->id]);

    }

    /**
     * POST: Update Batch
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
            'id' => 'required|exists:batch,id',
            'name' => 'required|max:255',
            'start_date' => 'required|date_format:Y-m-d',
            'course_id' => 'required|exists:course,id',
            'lecturer_id' => 'required|exists:lecturer,id'
        ]);

        $batch = \App\Models\Batch::findOrFail($request->get('id'));

        //Fill in information from request
        $batch->fill($request->all());

        //Save to database
        $batch->save();

        return redirect()->action('BatchController@getView',[$batch->id]);
    }

    /**
     * GET: View Batch
     *
     * @param int $batch_id
     * @return \Illuminate\View\View
     */
    public function getView($batch_id)
    {
        $batch = \App\Models\Batch::with('lecturer','course')->findOrFail((int)$batch_id);

        //Verify User Access
        $this->verifyAccess($batch_id);

        //Set Page Title
        $this->data['pageTitle'] = 'Batch - View - '.$batch->name;

        $this->data['batch'] = $batch;

        //Course List
        $this->data['course_list'] =  \App\Models\Course::orderBy('name','ASC')->get();

        //Lecturer List
        $this->data['lecturer_list'] =  \App\Models\Lecturer::orderBy('last_name','ASC')->orderBy('first_name','ASC')->get();

        /*
         * Assets
         */
        $this->addJqueryValidate();
        $this->addMoment();
        $this->addBootstrapDatetimePicker();

        $this->addJs('/js/el/batch.view.js');
        $this->addCss('/css/el/batch.view.css');

        return $this->renderView('batch.view');
    }

    /**
     * View: Student list in batch
     *
     * @param $batch_id
     * @return \Illuminate\View\View
     */
    public function getViewStudent($batch_id)
    {
        $batch = \App\Models\Batch::with('student')->findOrFail((int)$batch_id);

        //Verify User Access
        $this->verifyAccess($batch_id);

        //Set Page Title
        $this->data['pageTitle'] = 'Batch - View - Students - '.$batch->name;

        $this->data['batch'] = $batch;

        $this->data['hasBatchUpdateAccess'] = $this->hasAccess('batch.update');
        $this->data['hasBatchDeleteAccess'] = $this->hasAccess('batch.delete');

        //Student (Not in batch) List
        $studentIds = $batch->student->map(function($row) {
            return $row->id;
        });

        $this->data['student_list'] = \App\Models\Student::whereNotIn('id',$studentIds)
                                        ->orderBy('last_name','ASC')
                                        ->orderBy('first_name','ASC')
                                        ->get();

        $this->addJs('/js/el/batch.view_student.js');

        return $this->renderView('batch.view-student');
    }

    /**
     * POST: Add student to batch
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postCreateStudent(Request $request)
    {
        $batch = \App\Models\Batch::with('student')->findOrFail(\Crypt::decrypt($request->get('id')));

        //Verify User Access
        $this->verifyAccess((int)$batch->id);

        $student = \App\Models\Student::findOrFail(\Crypt::decrypt($request->get('student_id')));

        $studentIds = $batch->student->map(function($row) {
            return $row->id;
        });

        //Check if student is already in the batch
        if(in_array($student->id, $studentIds->toArray())) {
            return redirect()->back()->withErrors("Student with ID: {$student->id} is already in the batch");
        }

        $batch->student()->save($student);
        $batch->touch();

        return redirect()->back()->with([
            'messages' => "Student with ID: {$student->id} was successfully added to the batch"
        ]);
    }

    /**
     * POST: Delete student from batch
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postDeleteStudent(Request $request)
    {
        $batch = \App\Models\Batch::with('student')->findOrFail((int)$request->get('id'));

        //Verify User Access
        $this->verifyAccess((int)$batch->id);

        $student = \App\Models\Student::findOrFail((int)$request->get('student_id'));

        $studentIds = $batch->student->map(function($row) {
            return $row->id;
        });

        //Check if student is not in the batch
        if(!in_array($student->id, $studentIds->toArray())) {
            return redirect()->back()->withErrors("Student with ID: {$student->id} is not in the batch");
        }

        $batch->student()->detach($student->id);
        $batch->touch();

        return redirect()->back()->with([
            'messages' => "Student with ID: {$student->id} was successfully deleted from the batch"
        ]);
    }

}