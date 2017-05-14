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
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;


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
        //Verify User Access
        $this->verifyAccess();

        //Set Page Title
        $this->data['pageTitle'] = 'Assignment- Create';

        //Permissions
        $this->data['can_create_assignment'] = true;

        //Assignment List
        $this->data['assignment_list'] = \App\Models\Assignment::orderBy('name','ASC')->get();
        //Assets
        $this->addJqueryValidate();
        $this->addMoment();
        $this->addBootstrapDatetimePicker();

        $this->addJs('/js/el/assignment.create.js');
        return $this->renderView('assignment.create');

    }


    public function postCreate(Request $request)
    {
        //Verify User Access
        $this->verifyAccess();

        //Validate Data from request
        $this->validateData($request->all(),[
            'id' => 'required|max:5|alpha',
            'name' => 'required|max:255|alpha',
            'description' => 'description|max:254',
            'lecture_id' => 'numeric|max:5|alpha',
            'submission_date' => 'timestamp'
        ]);

        //Create New Assignment
        $assignment = new \App\Models\Assignment();
        //Fill in information from request
        $assignment->fill($request->all());
        //Set creator user id to user currently logged in
        $assignment->creator_user_id = $this->user->id;
        //Save to database
        $assignment->save();
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
            'id' => 'required|max:5|alpha',
            'name' => 'required|max:255|alpha',
            'description' => 'description|max:254',
            'lecture_id' => 'numeric|max:5|alpha',
            'submission_date' => 'timestamp'
        ]);

        $assignment = \App\Models\Assignment::findOrFail($request->get('id'));

        //Fill in information from request
        $assignment->fill($request->all());

        //Save to database
        $assignment->save();

        return redirect()->action('AssignmentController@getView',[$assignment->id]);
    }

    public function postUpload(Request $request)
    {
        $this->verifyAccess();


        //@TODO: Block by file mime types
        $this->validateData($request->all(), [
            'id' => 'exists:assignment,id'
        ]);

        $file = $request->file('file');

        if($file->isValid()) {
            $assignment = \App\Models\Assignment::findOrFail($request->get('id'));

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
                    \Storage::put(
                        "assignment_{$assignment->id}/$fileName.{$file->guessExtension()}",
                        file_get_contents($file->getRealPath())
                    );



                } else {
                    throw new AccessDeniedException("Only students can upload submissions");
                }
            }
        } else {
            return redirect()->back()->withErrors(['The uploaded file is not valid. Please try again.']);
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
        $assignment = \App\Models\Assignment::findOrFail((int)$assignment_id);

        //Verify User Access
        $this->verifyAccess($assignment_id);

        //Set Page Title
        $this->data['pageTitle'] = 'Assignment - View - '.$assignment->name;

        $this->data['assignment'] = $assignment;

        /*
         * Assets
         */
        $this->addJqueryValidate();

        $this->addJs('/js/el/assignment.view.js');
        $this->addCss('/css/el/assignment.view.css');

        return $this->renderView('assignment.view');
    }

}