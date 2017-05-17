<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2017
 * Time: 08:17
 */

namespace app\Http\Controllers;

use App\Exceptions\HttpExceptionWithError;
use App\Traits\VendorLibraries;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use \Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $this->data['isStudent'] = $this->studentService->isStudent($this->user);
        //Set Data
        if($this->data['isStudent']) {
            $assignmentList = \App\Models\Assignment::with('lecture','submissions')
                                                ->whereHas('lecture', function($q) {
                                                    return $q->whereHas('course', function($q) {
                                                        return $q->whereHas('batch', function($q) {
                                                            return $q->whereHas('student', function($q) {
                                                                return $q->whereHas('user', function($q) {
                                                                    return $q->where('id','=',$this->user->id);
                                                                });
                                                            });
                                                        });
                                                    });
                                                })
                                                ->orderBy('updated_at','DESC')
                                                ->get();
            $this->user->load('student');
            $student = $this->user->student;
            $this->data['assignment_list'] = $assignmentList->map(function($row) use ($student) {
                $row->isSubmitted = count($row->submissions->filter(function($row) use ($student)  {
                    return $row->student_id === $student->id;
                })) > 0;
                return $row;
            });
        } else {
            //Admin or lecturer
            $this->data['assignment_list'] = \App\Models\Assignment::with('lecture')->orderBy('updated_at','DESC')->get();
        }


        //Permissions
        $this->data['can_create_assignment'] = true;

        //Assets
        $this->addjQueryBootgrid();
        $this->addJs('/js/el/assignment.list.js');
        $this->addCss('/css/el/assignment.list.css');

        return $this->renderView('assignment.list');
    }

    /**
     * GET: Create Assignment
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        //Verify User Access
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Assignment- Create';

        //Permissions
        $this->data['can_create_assignment'] = true;

        //Assignment List
        $this->data['lecture_list'] = \App\Models\Lecture::orderBy('name','ASC')->get();

        //Assets
        $this->addJqueryValidate();
        $this->addMoment();
        $this->addBootstrapDatetimePicker();
        $this->addSummerNote();

        $this->addJs('/js/el/assignment.create.js');
        return $this->renderView('assignment.create');

    }

    /**
     * POST: Create Assignment
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        //Verify User Access
        $this->verifyAccess();

        //Validate Data from request
        $this->validateData($request->all(),[
            'name' => 'required|max:255',
            'description' => 'required',
            'lecture_id' => 'required|exists:lecture,id,deleted_at,NULL',
            'submission_date' => 'required|date_format:Y-m-d'
        ]);

        //Validate Date
        if(Carbon::createFromFormat('Y-m-d',$request->input('submission_date'))->diffIndays(Carbon::now(),false) >=0) {
            return redirect()->back()->withInput()->withErrors([
                'Submission date must be greater than today'
            ]);
        }

        //Create New Assignment
        $assignment = new \App\Models\Assignment();
        //Fill in information from request
        $assignment->fill($request->all());
        //Add lecture
        $lecture = \App\Models\Lecture::findOrFail($request->input('lecture_id'));
        $assignment->lecture()->associate($lecture);
        //Set creator user id to user currently logged in
        $assignment->creator()->associate($this->user);
        //Save to database
        $assignment->save();

        return redirect()->action('AssignmentController@getView',$assignment->id);
    }

    /**
     * POST: Update Assignment
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
            'lecture_id' => 'required|exists:lecture,id,deleted_at,NULL',
            'submission_date' => 'required|date_format:Y-m-d'
        ]);

        //Validate Date
        if(Carbon::createFromFormat('Y-m-d',$request->input('submission_date'))->diffIndays(Carbon::now(),false) >=0) {
            return redirect()->back()->withInput()->withErrors([
                'Submission date must be greater than today'
            ]);
        }

        //Get Info From DB
        $assignment = \App\Models\Assignment::findOrFail($request->get('id'));

        //Fill in information from request
        $assignment->fill($request->all());

        //Add lecture
        $lecture = \App\Models\Lecture::findOrFail($request->input('lecture_id'));
        $assignment->lecture()->associate($lecture);

        //Save to database
        $assignment->save();

        return redirect()->action('AssignmentController@getView',[$assignment->id]);
    }

    public function postUpload(Request $request)
    {
        $assignment = \App\Models\Assignment::findOrFail($request->get('id'));

        $this->verifyAccess($assignment->id);

        $file = $request->file('file');

        if($file->isValid()) {

            //If assignment is still active, allow submission
            if($assignment->isActive()) {

                //Get Student Profile
                $student = $this->user->student;
                if($student) {

                    /*
                     * Save file to disk
                     */
                    $fileName = time();
                    //Create Directory
                    $directory = \Storage::makeDirectory('assignment_'.$assignment->id);
                    //Save file to directory
                    $path = "assignment_{$assignment->id}/$fileName.{$file->guessExtension()}";
                    if(\Storage::put(
                        $path,
                        file_get_contents($file->getRealPath())
                    )) {
                        //save File info to DB
                        $file = new \App\Models\File([
                            'name' => $file->getClientOriginalName(),
                            'extension' => $file->guessExtension(),
                            'mime' => $file->getMimeType(),
                            'path' => $path,
                        ]);
                        $file->creator()->associate($this->user);
                        $file->save();

                        //Add file to assignment, by student
                        $assignmentStudent = new \App\Models\AssignmentStudents();
                        $assignmentStudent->creator()->associate($this->user);
                        $assignmentStudent->assignment()->associate($assignment);
                        $assignmentStudent->student()->associate($student);
                        $assignmentStudent->file()->associate($file);

                        $assignmentStudent->save();

                        return redirect()->back()->with([
                            'messages' => 'Submission of assignment has been successfully received'
                        ]);
                    } else {
                        throw new HttpExceptionWithError(500,['Unable to save file to server. Please try again.']);
                    }

                } else {
                    throw new AccessDeniedException("Only students can upload submissions");
                }
            }
        } else {
            return redirect()->back()->withErrors(['The uploaded file is not valid. Please try again.']);
        }

    }

    /**
     * GET: File in submission to assignment
     *
     * @param int $file_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getFile($file_id)
    {
        $file = \App\Models\File::findOrFail($file_id);

        $this->verifyAccess($file->id);

        $exists = \Storage::has($file->path);

        if($exists) {
            $content = \Storage::get($file->path);
            //Remove white space to prevent files from getting corrupted - ref: http://stackoverflow.com/questions/39329299/laravel-file-downloaded-from-storage-folder-gets-corrupted
            ob_end_clean();
            return response($content, 200, [
                'Content-Type' => $file->mime,
                'Content-Disposition' => 'attachment; filename="'.$file->name.'"',
            ]);
        } else {
            throw new NotFoundHttpException("File ID: {$file->id} not found on the system");
        }
    }

    /**
     * GET: View Assignment
     *
     * @param int $assignment_id
     * @return \Illuminate\View\View
     */
    public function getView($assignment_id)
    {
        $assignment = \App\Models\Assignment::with('lecture')->findOrFail((int)$assignment_id);

        //Verify User Access
        $this->verifyAccess($assignment_id);

        //Set Page Title
        $this->data['pageTitle'] = 'Assignment - View - '.$assignment->name;

        $this->data['assignment'] = $assignment;

        $this->data['isStudent'] = $this->studentService->isStudent($this->user);
        $this->data['hasSubmitted'] = false;

        if($this->data['isStudent']) {
            //Check if already submitted assignment
            $this->user->load('student');
            $this->data['hasSubmitted'] = \App\Models\AssignmentStudents::where('student_id','=',$this->user->student->id)
                                            ->where('assignment_id','=',$assignment->id)
                                            ->count() > 0;
            if($this->data['hasSubmitted']) {
                $studentSubmission = \App\Models\AssignmentStudents::where('student_id','=',$this->user->student->id)
                                    ->where('assignment_id','=',$assignment->id)
                                    ->with('file')
                                    ->first();
                if($studentSubmission->file) {
                    $this->data['studentSubmission'] = $studentSubmission->file;
                } else {
                    $this->data['studentSubmission'] = false;
                }
            }
        }

        //Permissions
        $this->data['hasUpdateAccess'] = $this->hasAccess('assignment.update') || $this->lecturerService->isLecturer($this->user);
        $this->data['hasDeleteAccess'] = $this->hasAccess('assignment.delete') || $this->lecturerService->isLecturer($this->user);

        if($this->data['hasUpdateAccess']) {
            $this->data['lectureList'] = \App\Models\Lecture::orderBy('name','ASC')
                                            ->get();
        }

        /*
         * Assets
         */
        $this->addJqueryValidate();
        $this->addMoment();
        $this->addBootstrapDatetimePicker();
        $this->addFileInput();
        $this->addSummerNote();
        $this->addJs('/js/el/assignment.view.js');

        return $this->renderView('assignment.view');
    }

    /**
     * GET: View Submission
     *
     * @param $assignment_id
     * @return \Illuminate\View\View
     */
    public function getViewSubmission($assignment_id)
    {
        $assignment = \App\Models\Assignment::with('submissions','submissions.file','submissions.student')->findOrFail((int)$assignment_id);

        //Verify User Access
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Assignment - View Submissions - '.$assignment->name;

        $this->data['assignment'] = $assignment;

        $this->data['hasDeleteAccess'] = $this->hasAccess('assignment.delete') || $this->lecturerService->isLecturer($this->user);

        $this->addJs('/js/es/assignment.view_submission.js');

        return $this->renderView('assignment.view-submission');
    }

    /**
     * POST: Delete Assignment
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete(Request $request)
    {
        $assignment = \App\Models\Assignment::findOrFail(\Crypt::decrypt($request->input('id')));

        //Verify User Access
        $this->verifyAccess();

        $assignment->delete();

        return redirect()->action('AssignmentController@getList')->with([
            'messages' => "Assignment ID: {$assignment->id} has been successfully deleted"
        ]);
    }

    /**
     * POST: Delete Submission
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteSubmission(Request $request)
    {
        $assignment = \App\Models\Assignment::findOrFail(\Crypt::decrypt($request->input('id')));

        //Verify User Access
        $this->verifyAccess();

        $assignment_student = \App\Models\AssignmentStudents::findOrFail(\Crypt::decrypt($request->input('submission_id')));

        $assignment->submissions()->detach($assignment_student);

        return redirect()->back()->with([
            'messages' => "Submission ID: {$assignment_student->id} has been successfully deleted"
        ]);
    }

}