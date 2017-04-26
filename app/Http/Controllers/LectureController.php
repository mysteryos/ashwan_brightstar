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

    public function getList()
    {
        //Set Page Title
        $this->data['pageTitle'] = 'Lecture - List';

        //Set Data
        $this->data['lecture_list'] = \App\Models\Lecture::orderBy('updated_at','DESC')->get();

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

        //Set Page Title
        $this->data['pageTitle'] = 'Lecture - Create';

        //Permissions
        $this->data['can_create_lecture'] = true;

        //Assets
        $this->addJqueryValidate();

        $this->addJs('/js/el/lecture.create.js');
        return $this->renderView('lecture.create');

    }


    public function postCreate(Request $request)
    {


        //Validate Data from request
        $this->validateData($request->all(),[
            'name' => 'required|max:255',
            'description' => 'required|max:255',

        ]);

        //Create New Lecture
        $lecture = new \App\Models\Lecture();
        //Fill in information from request
        $lecture->fill($request->all());
        //Set creator user id to user currently logged in
        $lecture->creator_user_id = $this->user->id;
        //Save to database
        $lecture->save();
    }







}