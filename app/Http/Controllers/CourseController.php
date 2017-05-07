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

    }

    public function getView()
    {

    }

}